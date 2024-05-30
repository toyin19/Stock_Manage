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
        $_SESSION['messageCli']['text'] = "client ajouté avec succès";
        $_SESSION['messageCli']['type'] = "success";
        
    }else {
        $_SESSION['messageCli']['text'] ="une erreur s'est produite";
        $_SESSION['messageCli']['type'] = "danger";
      
    }

    
}else {
    $_SESSION['messageCli']['text'] ="un champ obligatoire non renseigné";
    $_SESSION['messageCli']['type'] = "danger";
       
}
header('Location: ../vue/client.php');