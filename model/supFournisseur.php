<?php
include 'connexion.php';

if(isset($_GET['id']) AND !empty($_GET['id'])){

    $idOfFournisseur = $_GET['id'];

    $checkIfQuestionExists = $connexion->prepare('SELECT * FROM fournisseur WHERE id = ?');
    $checkIfQuestionExists->execute(array($idOfFournisseur));

    if($checkIfQuestionExists->rowCount() > 0){


        $delete = $connexion->prepare('DELETE FROM fournisseur WHERE id = ?');
        $delete->execute(array($idOfFournisseur));

        header('Location:../vue/fournisseur.php'); 
       


    }else{
        $_SESSION['message']['text'] = "Aucune question n'a été trouvée";
        $_SESSION['message']['type'] = "success";
        
       
    }

}else{
    $_SESSION['message']['text'] = "Aucune question n'a été trouvée";
    $_SESSION['message']['type'] = "success";
}