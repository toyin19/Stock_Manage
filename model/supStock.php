<?php
include 'connexion.php';

if(isset($_GET['id']) AND !empty($_GET['id'])){

    $idOfEntre = $_GET['id'];

    $checkIfQuestionExists = $connexion->prepare('SELECT * FROM entre_stock WHERE id = ?');
    $checkIfQuestionExists->execute(array($idOfEntre));

    if($checkIfQuestionExists->rowCount() > 0){


        $delete = $connexion->prepare('DELETE FROM entre_stock WHERE id = ?');
        $delete->execute(array($idOfEntre));

        header('Location:../vue/entreStock.php'); 
       


    }else{
        $_SESSION['message']['text'] = "Aucune question n'a été trouvée";
        $_SESSION['message']['type'] = "success";
        
       
    }

}else{
    $_SESSION['message']['text'] = "Aucune question n'a été trouvée";
    $_SESSION['message']['type'] = "success";
}