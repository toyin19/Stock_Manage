<?php
include 'connexion.php';

if (
    !empty($_POST['nom_article'])
    && !empty($_POST['id_categorie'])
    && !empty($_POST['quantite'])
    && !empty($_POST['prix_unitaire'])
    && !empty($_POST['id'])
){
    $sql= "UPDATE article SET nom_article=?, id_categorie=?, quantite=?, prix_unitaire=?  WHERE id=?";

    $req = $connexion->prepare($sql);
    $req->execute(array(
        $_POST['nom_article'],
        $_POST['id_categorie'],
        $_POST['quantite'],
        $_POST['prix_unitaire'],
        $_POST['id']
    ));
  
    if ($req->rowCount()!=0) {
        $_SESSION['messageArti']['text'] = "article modifier avec succès";
        $_SESSION['messageArti']['type'] = "success";
        
    }else {
        $_SESSION['messageArti']['text'] ="rien n'a été modifier";
        $_SESSION['messageArti']['type'] = "warning";
      
    }

    
}else {
    $_SESSION['messageArti']['text'] ="un champ  obligatoire non renseigné";
    $_SESSION['messageArti']['type'] = "danger";
       
}
header('Location: ../vue/article.php');