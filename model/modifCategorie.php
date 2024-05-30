<?php
include 'connexion.php';

if (
    !empty($_POST['libelle_categorie'])
    && !empty($_POST['id'])
){
    $sql= "UPDATE categorie_article SET libelle_categorie=? WHERE id=?";
    
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['libelle_categorie'],
        $_POST['id']
    ));
    if ($req->rowCount()!=0) {
        $_SESSION['messageCate']['text'] = "categorie modifier avec succès";
        $_SESSION['messageCate']['type'] = "success";
        
    }else {
        $_SESSION['messageCate']['text'] ="rien n'a été modifier";
        $_SESSION['messageCate']['type'] = "warning";
      
    }

    
}else {
    $_SESSION['messageCate']['text'] ="un champ  obligatoire non renseigné";
    $_SESSION['messageCate']['type'] = "danger";
       
}
header('Location: ../vue/categorie.php');