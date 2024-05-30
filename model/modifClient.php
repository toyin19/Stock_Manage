<?php
include 'connexion.php';

if (
    !empty($_POST['nom'])
    && !empty($_POST['prenom'])
    && !empty($_POST['telephone'])
    && !empty($_POST['email'])
    && !empty($_POST['id'])
){
    $sql= "UPDATE client SET nom=?, prenom=?, telephone=?, email=? WHERE id=?";
    
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['telephone'],
        $_POST['email'],
        $_POST['id']
    ));
    if ($req->rowCount()!=0) {
        $_SESSION['messageCli']['text'] = "client modifier avec succès";
        $_SESSION['messageCli']['type'] = "success";
        
    }else {
        $_SESSION['messageCli']['text'] ="rien n'a été modifier";
        $_SESSION['messageCli']['type'] = "warning";
      
    }

    
}else {
    $_SESSION['messageCli']['text'] ="un champ obligatoire non renseigné";
    $_SESSION['messageCli']['type'] = "danger";
       
}
header('Location: ../vue/client.php');