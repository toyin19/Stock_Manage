
<?php

include 'entete.php';



if (!empty($_GET['id'])) {
    $article = getVente($_GET['id']);
}

?>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifVente.php" : "../model/ajoutVente.php" ?>" id="buy-form" method="post">
                <input value="<?= !empty($_GET['id']) ? $article['id'] : "" ?>" type="hidden" name="id" id="id" />
                <div id="products" data-products="<?= htmlspecialchars(json_encode(getArticle())) ?>">
                <div class="checkout-flex">
                    <div class="checkout-flex__article">
                        <label for="id_article"> Article</label>
                        <select onchange="setPrix()" name="id_article" id="id_article">
                            <?php

                            $articles = getArticle();
                            if (!empty($articles) && is_array($articles)) {
                                foreach ($articles as $key => $value) {

                            ?>
                                    <option data-prix="<?= $value['prix_unitaire'] ?>" value="<?= $value['id'] ?>"><?= $value['nom_article'] . " - " . $value['quantite'] . " disponible" ?></option>

                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="checkout-flex__quantity">
                        <label for="quantite">Quantité</label>
                        <div class="quantity-controls">
                            <p id="qty-decrement" class="qty-btn">-</p>
                            <input onkeyup="setPrix()" value="<?= !empty($_GET['id']) ? $article['quantite'] : 0 ?>" type="number" name="quantite" id="quantite" placeholder="Veuillez entrer la quantité" min="1" />
                            <p id="qty-increment" class="qty-btn">+</p>
                        </div>
                    </div>

                </div>
                </div>
                <button type="button" id="addProduct">Ajouter un produit</button>
                <label for="id_client"> Client</label>
                <select name="id_client" id="id_client">
                    <?php

                    $clients = getClient();
                    if (!empty($clients) && is_array($clients)) {
                        foreach ($clients as $key => $value) {

                    ?>
                            <option value="<?= $value['id'] ?>"><?= $value['nom'] . " " . $value['prenom'] ?></option>

                    <?php
                        }
                    }
                    ?>

                </select>

                <label for="prix"> Prix </label>
                <input value="<?= !empty($_GET['id']) ? $article['prix'] : "" ?>" type="number" name="prix" id="prix" placeholder="veuillez entrez le prix" />

                <button type="submit">Valider</button>

                <?php
                
                if (!empty($_SESSION['messageVent']['text'])) {
                ?>

                    <div class="alert <?= ($_SESSION['messageVent']['type']) ?>">
                        <?= ($_SESSION['messageVent']['text']) ?>
                    </div>

                <?php
                }
                ?>

            </form>

        </div>

        <div class="box">
                <table class="mtable">
            <tr>
                <th>ID Vente</th>
                <th>Montant Total</th>
                <th>Client</th>
                <th>Nombre Total de Produits</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            <?php
            $ventes = getAllVente();
            if (!empty($ventes) && is_array($ventes)) {
                foreach ($ventes as $vente) {
                    $articles = json_decode($vente['article'], true);
                    $total = calculateTotal($articles);
                    $totalQuantity = calculateTotalQuantity($articles);
            ?>
                    <tr>
                        <td><?= htmlspecialchars($vente['vente_id']) ?></td>
                        <td><?= number_format($total, 2) ?> fcfa</td>
                        <td><?= htmlspecialchars($vente['client']) ?></td>
                        <td><?= htmlspecialchars($totalQuantity) ?></td>
                        <td><?= date('d/m/y H:i:s', strtotime($vente['date_vente'])) ?></td>
                        <td>
                            <a href="recuVente.php?id=<?= htmlspecialchars($vente['vente_id']) ?>"><i class='bx bx-receipt'></i></a>
                            <a onclick="annuleVente(<?= htmlspecialchars($vente['vente_id']) ?>)" style="color: red;"><i class='bx bx-stop-circle'></i></a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="6">Aucune vente trouvée</td></tr>';
            }
            ?>
                    </table>

         
        </div>

    </div>

    </section>

</div>

<?php
include 'pied.php';
?>
<script>
    function annuleVente(idVente, idArticle, quantite) {
        if (confirm("Voulez vous vraiment annuler cette vente ?")) {
            window.location.href = "../model/annuleVente.php?idVente=" + idVente + "&idArticle=" + idArticle + "&quantite=" + quantite
        }
    }

    function setPrix() {
        var article = document.querySelector('#id_article');
        var quantite = document.querySelector('#quantite');
        var prix = document.querySelector('#prix');

        var prixUnitaire = article.options[article.selectedIndex].getAttribute('data-prix');

        prix.value = Number(quantite.value) * Number(prixUnitaire);
    }
</script>
<script src="../js/vente.js"></script>