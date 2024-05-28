
<?php

	include 'entete.php';
    if (!empty($_GET['id'])) {
        $article = getArticle($_GET['id']);
    }

   
?>

<div class="home-content">
    <div class="overview-boxes">
        
         <div  class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifArticle.php" : "../model/ajoutArticle.php" ?>" method="post">
            <label for="id_article"> Nom de l'article</label>
            <input value="<?= !empty($_GET['id']) ? $article['nom_article'] : "" ?>" type="text" name="nom_article" id="nom_article" placeholder="veuillez entrez le nom de l'article"/>
            <input value="<?= !empty($_GET['id']) ? $article['id'] : "" ?>" type="hidden" name="id" id="id"/>
            <label for="id_categorie"> Catégorie</label>
            <select  name="id_categorie" id="id_categorie">
            <option value="">--choisir une catégorie--</option>
            <?php
                  
                  $categories = getCategorie();
                   if (!empty($categories) && is_array($categories)) {
                    foreach ($categories as $key => $value){

            ?>
            <option <?= !empty($_GET['id']) && $article['id_categorie'] == $value['id'] ? "selected" : "" ?>  value="<?= $value['id']?>"><?= $value['libelle_categorie'] ?></option>

             <?php    
              }
              }
              ?>
            </select>
            

            <label for="quantite"> Quantite</label>
            <input value="<?= !empty($_GET['id']) ? $article['quantite'] : "" ?>" type="number" name="quantite" id="quantite" placeholder="veuillez entrez la quantité" />

            <label for="prix"> Prix unitaire </label>
            <input value="<?= !empty($_GET['id']) ? $article['prix_unitaire'] : "" ?>" type="number" name="prix_unitaire" id="prix_unitaire" placeholder="veuillez entrez le prix"  />


             <button type="submit">Valider</button>

                 <?php 
                  
                 if (!empty($_SESSION['message']['text'])) {
                ?>

                <div class="alert <?= ($_SESSION['message']['type']) ?>">
                <?= ($_SESSION['message']['text']) ?>
            </div>
               
                <?php      
               }
                ?>
             
            </form>
              
        </div>

        <div style="display:block" class="box">
            <form action="" method="GET">

            <table class="mtable">
                <tr>
                    <th>Nom article</th>
                    <th>Catégorie</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                </tr>
                <tr>
                    <td> 
                        <input  type="text" name="nom_article" id="nom_article" placeholder="veuillez entrez le nom de l'article" />
                    </td>
                    <td>
                    <select  name="id_categorie" id="id_categorie">
                    <option value="">--choisir une catégorie--</option>
                        <?php
                  
                         $categories = getCategorie();
                        if (!empty($categories) && is_array($categories)) {
                        foreach ($categories as $key => $value){

                        ?>
                         <option <?= !empty($_GET['id']) && $article['id_categorie'] == $value['id'] ? "selected" : "" ?>  value="<?= $value['id']?>"><?= $value['libelle_categorie'] ?></option>

                        <?php    
                        }
                        }
                        ?>
                    </select>
                    </td>
        
                    <td>
                    <input type="number" name="quantite" id="quantite" placeholder="veuillez entrez la quantité" />
                    </td>

                    <td>
                    <input  type="number" name="prix_unitaire" id="prix_unitaire" placeholder="veuillez entrez le prix"  /> 
                    </td>

                </tr>               
            </table>
             <br>
            <button type="submit">Valider</button>

            </form>

            <br>
       
            <table class="mtable">
                <tr>
                    <th>Nom article</th>
                    <th>Catégorie</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Actions</th>
                </tr>
                <?php 

                if(!empty($_GET))
                {
                    $articles= getArticle(null, $_GET);
                }  else {
                    $articles= getArticle(); 
                }
                
                if (!empty($articles) && is_array($articles)){
                    foreach ($articles as $key => $value){
                        ?>  
                <tr>
                    <td><?= $value['nom_article'] ?></td>
                    <td><?= $value['libelle_categorie'] ?></td>
                    <td><?= $value['quantite'] ?></td>
                    <td><?= $value['prix_unitaire'] ?></td>
                    <td>
                        <a href="?id=<?= $value['id']?>"><i class='bx bx-edit-alt'></i></a>
                        <a href="../model/supArticle.php?id=<?= $value['id']?>"><i class='bx bx-message-rounded-x'></i></a>
                    </td>

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