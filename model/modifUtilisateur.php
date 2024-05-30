<?php
include 'connexion.php';

if (
    !empty($_POST['nom'])
    && !empty($_POST['prenom'])
    && !empty($_POST['telephone'])
    && !empty($_POST['email'])
    && !empty($_POST['mot_passe'])
    && !empty($_POST['id'])
){
    $sql= "UPDATE utilisateur SET nom=?, prenom=?, telephone=?, email=?, mot_passe=? WHERE id=?";
    
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['telephone'],
        $_POST['email'],
        $_POST['mot_passe'],
        $_POST['id']
    ));
    if ($req->rowCount()!=0) {
        $_SESSION['messageUti']['text'] = "utilisateur modifier avec succès";
        $_SESSION['messageUti']['type'] = "success";
        
    }else {
        $_SESSION['messageUti']['text'] ="rien n'a été modifier";
        $_SESSION['messageUti']['type'] = "warning";
      
    }

    
}else {
    $_SESSION['messageUti']['text'] ="un champ obligatoire non renseigné";
    $_SESSION['messageUti']['type'] = "danger";
       
}
header('Location: ../vue/utilisateur.php');