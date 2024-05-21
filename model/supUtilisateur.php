<?php
include 'connexion.php';

if(isset($_GET['id']) AND !empty($_GET['id'])){

    $idOfUtilisateur = $_GET['id'];

    $checkIfQuestionExists = $connexion->prepare('SELECT * FROM utilisateur WHERE id = ?');
    $checkIfQuestionExists->execute(array($idOfUtilisateur));

    if($checkIfQuestionExists->rowCount() > 0){


        $delete = $connexion->prepare('DELETE FROM utilisateur WHERE id = ?');
        $delete->execute(array($idOfUtilisateur));

        header('Location:../vue/utilisateur.php'); 
       


    }else{
        $_SESSION['message']['text'] = "Aucune question n'a été trouvée";
        $_SESSION['message']['type'] = "success";
        
       
    }

}else{
    $_SESSION['message']['text'] = "Aucune question n'a été trouvée";
    $_SESSION['message']['type'] = "success";
}