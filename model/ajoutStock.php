<?php

include_once "function.php";

if (
    !empty($_POST['id_article'])
    && !empty($_POST['id_categorie'])
    && !empty($_POST['quantite'])
    && !empty($_POST['prix'])
    && !empty($_POST['nom_fournisseur'])
    && !empty($_POST['prenom_fournisseur'])
    && !empty($_POST['tel_fournisseur'])
){
    $article = getArticle($_POST['id_article']);
    if (!empty($article) && is_array($article))
    {
         
            $sql="INSERT INTO entre_stock(id_article, id_categorie, quantite, prix, nom_fournisseur, prenom_fournisseur, tel_fournisseur) VALUES(?, ?, ?, ?, ?, ?, ?) ";
            $req = $connexion->prepare($sql);
        
            $req->execute(array(
                $_POST['id_article'],
                $_POST['id_categorie'],
                $_POST['quantite'],
                $_POST['prix'],
                $_POST['nom_fournisseur'],
                $_POST['prenom_fournisseur'],
                $_POST['tel_fournisseur']
            ));
            
            if ($req->rowCount()!=0) {

                $sql= "UPDATE article SET quantite= quantite+? WHERE id=?";
                $req = $connexion->prepare($sql);
            
                $req->execute(array(
                    $_POST['quantite'],
                    $_POST['id_article'],
                ));

                if ($req->rowCount()!=0) {
                $_SESSION['messageStoc']['text'] = "entrée effectuée avec succès";
                $_SESSION['messageStoc']['type'] = "success";
                }else {
                    $_SESSION['messageStoc']['text'] ="une erreur s'est produite";
                    $_SESSION['messageStoc']['type'] = "danger";
                  
                }     
            }else {
                $_SESSION['messageStoc']['text'] ="une erreur s'est produite lors de la l'entrée de l'article";
                $_SESSION['messageStoc']['type'] = "danger"; 
            }
        
    
    }
   
}else {
    $_SESSION['messageStoc']['text'] ="un champ  obligatoire non renseigné";
    $_SESSION['messageStoc']['type'] = "danger";
       
}
header('Location: ../vue/entreStock.php');