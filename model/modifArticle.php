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
        $_SESSION['message']['text'] = "article modifier avec succès";
        $_SESSION['message']['type'] = "success";
        
    }else {
        $_SESSION['message']['text'] ="rien n'a été modifier";
        $_SESSION['message']['type'] = "warning";
      
    }

    
}else {
    $_SESSION['message']['text'] ="un champ  obligatoire non renseigné";
    $_SESSION['message']['type'] = "danger";
       
}
header('Location: ../vue/article.php');