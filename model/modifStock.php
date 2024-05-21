<?php
include 'connexion.php';

if (
    !empty($_POST['id_article'])
    && !empty($_POST['id_categorie'])
    && !empty($_POST['quantite'])
    && !empty($_POST['prix'])
    && !empty($_POST['nom_fournisseur'])
    && !empty($_POST['prenom_fournisseur'])
    && !empty($_POST['tel_fournisseur'])
    && !empty($_POST['id'])
){
    $sql= "UPDATE entre_stock SET id_article=?, id_categorie=?, quantite=?, prix=?,
     nom_fournisseur=?, prenom_fournisseur=?, tel_fournisseur  WHERE id=?";

    $req = $connexion->prepare($sql);
    $req->execute(array(
        $_POST['id_article'],
        $_POST['id_categorie'],
        $_POST['quantite'],
        $_POST['prix'],
        $_POST['nom_fournisseur'],
        $_POST['prenom_fournisseur'],
        $_POST['tel_fournisseur'],
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
header('Location: ../vue/entreStock.php');