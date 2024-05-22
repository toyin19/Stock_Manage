<?php
include 'connexion.php';

if (
    !empty($_POST['nom_article'])
    && !empty($_POST['id_categorie'])
    && !empty($_POST['quantite'])
    && !empty($_POST['prix_unitaire'])

    
){
    $sql="INSERT INTO article(nom_article, id_categorie, quantite, prix_unitaire) VALUES(?, ?, ?, ?) ";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['nom_article'],
        $_POST['id_categorie'],
        $_POST['quantite'],
        $_POST['prix_unitaire']
       
    ));
    if ($req->rowCount()!=0) {
        $_SESSION['message']['text'] = "article ajouté avec succès";
        $_SESSION['message']['type'] = "success";
        
    }else {
        $_SESSION['message']['text'] ="une erreur s'est produite";
        $_SESSION['message']['type'] = "danger";
      
    }

    
}else {
    $_SESSION['message']['text'] ="un champ obligatoire non renseigné";
    $_SESSION['message']['type'] = "danger";
       
}
header('Location: ../vue/article.php');