<?php
include 'connexion.php';

if (
    !empty($_POST['nom'])
    && !empty($_POST['prenom'])
    && !empty($_POST['telephone'])
    && !empty($_POST['email'])
    
    
){
    $sql="INSERT INTO client(nom, prenom, telephone, email) VALUES(?, ?, ?, ?) ";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['telephone'],
        $_POST['email'],
       
    ));
    if ($req->rowCount()!=0) {
        $_SESSION['message']['text'] = "client ajouté avec succès";
        $_SESSION['message']['type'] = "success";
        
    }else {
        $_SESSION['message']['text'] ="une erreur s'est produite";
        $_SESSION['message']['type'] = "danger";
      
    }

    
}else {
    $_SESSION['message']['text'] ="un champ obligatoire non renseigné";
    $_SESSION['message']['type'] = "danger";
       
}
header('Location: ../vue/client.php');