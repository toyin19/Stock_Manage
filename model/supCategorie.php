<?php
include 'connexion.php';

if(isset($_GET['id']) AND !empty($_GET['id'])){

    $idOfCategorie = $_GET['id'];

    $checkIfQuestionExists = $connexion->prepare('SELECT * FROM categorie_article WHERE id = ?');
    $checkIfQuestionExists->execute(array($idOfCategorie));

    if($checkIfQuestionExists->rowCount() > 0){


        $delete = $connexion->prepare('DELETE FROM categorie_article WHERE id = ?');
        $delete->execute(array($idOfCategorie));

        header('Location:../vue/categorie.php'); 
       


    }else{
        $_SESSION['messageCate']['text'] = "Aucune question n'a été trouvée";
        $_SESSION['messageCate']['type'] = "success";
        
       
    }

}else{
    $_SESSION['messageCate']['text'] = "Aucune question n'a été trouvée";
    $_SESSION['messageCate']['type'] = "success";
}