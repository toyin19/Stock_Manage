<?php
include 'connexion.php';

if (
    !empty($_POST['libelle_categorie'])
){
    $sql="INSERT INTO categorie_article(libelle_categorie) VALUES(?) ";
    $req = $connexion->prepare($sql);

    $req->execute(array(
       
        $_POST['libelle_categorie']
        
    ));
    if ($req->rowCount()!=0) {
        $_SESSION['messageCate']['text'] = "categorie ajouté avec succès";
        $_SESSION['messageCate']['type'] = "success";
        
    }else {
        $_SESSION['messageCate']['text'] ="une erreur s'est produite";
        $_SESSION['messageCate']['type'] = "danger";
      
    }

    
}else {
    $_SESSION['messageCate']['text'] ="un champ  obligatoire non renseigné";
    $_SESSION['messageCate']['type'] = "danger";
       
}
header('Location: ../vue/categorie.php');