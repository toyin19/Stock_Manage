
<?php
	include 'entete.php';
    
    if (isset($_SESSION['role']) && $_SESSION['role']!='administrateur' && $_SESSION['role']!='responsable_logistique') {
        header("Location:dashboard.php");
        exit; 
    }

    if (!empty($_GET['id'])) {
        $entreStock = getEntreStock($_GET['id']);
    }

?>

<div class="home-content">
    <div class="overview-boxes">
    <?php
             if(isset($_SESSION['role']) and $_SESSION['role']=='responsable_logistique') {
            ?>
         <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifStock.php" : "../model/ajoutStock.php" ?>" method="post">
            <input value="<?= !empty($_GET['id']) ? $entreStock['id'] : "" ?>" type="hidden" name="id" id="id"/>
           
            <label for="id_article"> Article</label>
            <select onchange="setPrix()" name="id_article" id="id_article">
            <?php
                  
                  $articles = getArticle();
                   if (!empty($articles) && is_array($articles)) {
                    foreach ($articles as $key => $value){
            ?>

            <option <?= !empty($_GET['id']) && $entreStock['id_article'] == $value['id'] ? "selected" : "" ?>   value="<?= $value['id']?>"><?= $value['nom_article']." - ".$value['quantite']." disponible"  ?></option>

             <?php    
              }
              }
              ?>
            </select>

            
            <label for="id_categorie">Catégorie</label>
            <select onchange="setPrix()" name="id_categorie" id="id_categorie">
            <?php
                  
                  $categories = getCategorie();
                   if (!empty($categories) && is_array($categories)) {
                    foreach ($categories as $key => $value){
            ?>

            <option <?= !empty($_GET['id']) && $entreStock['id_categorie'] == $value['id'] ? "selected" : "" ?> value="<?= $value['id']?>"><?= $value['libelle_categorie'] ?></option>

             <?php    
              }
              }
              ?>
            </select>
            <label for="quantite"> Quantite</label>
            <input  value="<?= !empty($_GET['id']) ? $entreStock['quantite'] : "" ?>" type="number" name="quantite" id="quantite" placeholder="veuillez entrez la quantité"   />

            <label for="prix"> Prix </label>
            <input value="<?= !empty($_GET['id']) ? $entreStock['prix'] : "" ?>" type="number" name="prix" id="prix" placeholder="veuillez entrez le prix"  />
            <label for="id_fournisseur"> Nom</label>
            <input  value="<?= !empty($_GET['id']) ? $entreStock['nom_fournisseur'] : "" ?>" type="text" name="nom_fournisseur" id="nom_fournisseur" placeholder="veuillez entrez le nom du fournisseur "   />
            <label for="id_fournisseur"> Prenom</label>
            <input  value="<?= !empty($_GET['id'] ) ? $entreStock['prenom_fournisseur'] : "" ?>" type="text" name="prenom_fournisseur" id="prenom_fournisseur" placeholder="veuillez entrez le nom du fournisseur "   />
            <label for="id_fournisseur"> Tel</label>
            <input  value="<?= !empty($_GET['id']) ? $entreStock['tel_fournisseur'] : "" ?>" type="text" name="tel_fournisseur" id="tel_fournisseur" placeholder="veuillez entrez le nom du fournisseur "   />
                

             <button type="submit">Valider</button>

                 <?php 

                 if (!empty($_SESSION['messageStoc']['text'])) {
                ?>
                <div class="alert <?= ($_SESSION['messageStoc']['type']) ?>">
                <?= ($_SESSION['messageStoc']['text']) ?>
            </div>

                <?php      
               }
                ?>

            </form>
              
         </div> 
         <?php
                }
                ?>

         <div class="box">
            <table class="mtable">
                <tr>
                    <th>Article</th>
                    <th>Catégorie</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Nom </th>
                    <th>Prenom </th>
                    <th>Tel </th>
                    <th>Date d'entre</th>
                    <?php
             if(isset($_SESSION['role']) and $_SESSION['role']=='responsable_logistique') {
                 ?>
                    <th>Actions</th>     
                    <?php      
               }
                ?>           
                </tr>
                <?php 
                
                $entreStocks = getEntreStock();
                if (!empty($entreStocks) && is_array($entreStocks)){
                    foreach ($entreStocks as $key => $value){
                        
                        ?>  
                <tr>
                    <td><?= $value['nom_article'] ?></td>
                    <td><?= $value['libelle_categorie'] ?></td>
                    <td><?= $value['quantite'] ?></td>
                    <td><?= $value['prix'] ?></td>
                    <td><?= $value['nom_fournisseur'] ?></td>
                    <td><?= $value['prenom_fournisseur'] ?></td>
                    <td><?= $value['tel_fournisseur'] ?></td>
                    <td><?= date('d/m/y H:i:s', strtotime($value['date_entre'])) ?></td>
                    <?php
             if(isset($_SESSION['role']) and $_SESSION['role']=='responsable_logistique') {
                 ?>
                    <td>
                        <a href="?id=<?= $value['id']?>"><i class='bx bx-edit-alt'></i></a>
                    </td>
                    <?php      
               }
                ?> 

                </tr>
                <?php
                    }
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
        if(confirm["Voulez vous vraiment annuler cette vente ?"]) {
            window.location.href = "../model/annuleVente.php?idVente="+idVente+"&idArticle="+idArticle+"&quantite="+quantite
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