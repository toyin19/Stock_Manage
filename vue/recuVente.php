<?php
    include 'entete.php';

    if (!empty($_GET['id'])) {
        $vente = getVente($_GET['id']);
    }

    $totalFacture = 0; // Initialisation du total de la facture à zéro

    if (!empty($vente)) {
        $articles = parseArticlesFromJson(json_decode($vente['article'], true));

        // Calcul du total de la facture
        foreach ($articles as $article) {
            $prixTotal = $article['quantite'] * $article['prix_unitaire'];
            $totalFacture += $prixTotal;
        }
    }

?>

<div class="home-content">
    <button class="hidden-print" id="btnPrint" style="position: relative; left: 45%;"><i class='bx bx-printer'></i>Imprimer</button>

    <div class="page">

        <div class="cote-a-cote">
            <h2>Stock Manage</h2>
            <div>
                <p>Reçu N° #: <?= !empty($vente['id']) ? $vente['id'] : '' ?></p>
                <p>Date: <?= !empty($vente['date_vente']) ? date('d/m/y H:i:s', strtotime($vente['date_vente'])) : '' ?> </p>
            </div>
        </div>

        <br>

        <div class="cote-a-cote" style="width: 50%;">
            <P>Nom:</P>
            <p><?= !empty($vente['nom']) && !empty($vente['prenom']) ? $vente['nom'] . " " . $vente['prenom'] : '' ?></p>
        </div>

        <div class="cote-a-cote" style="width: 50%;">
            <P>Tel:</P>
            <p><?= !empty($vente['telephone']) ? $vente['telephone'] : '' ?></p>
        </div>
        <br>
        <br>

        <table class="mtable">
            <tr>
                <th>Designation</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Prix total</th>
            </tr>
            <?php
            if (!empty($articles)) {
                foreach ($articles as $article) {
                    $prixTotal = $article['quantite'] * $article['prix_unitaire'];
            ?>
                    <tr>
                        <td><?= $article['nom_article'] ?></td>
                        <td><?= $article['quantite'] ?></td>
                        <td><?= $article['prix_unitaire'] ?></td>
                        <td><?= $prixTotal ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>

        <div class="total-facture" style="text-align: right; font-weight: bold;">
         Montant total de la facture: <?= $totalFacture ?> fcfa
        </div>


    </div>

</div>
</section>

</section>
<?php
    include 'pied.php';
?>
<script>
    var btnPrint = document.querySelector('#btnPrint');
    btnPrint.addEventListener("click", () => {
        window.print();
    })
</script>
