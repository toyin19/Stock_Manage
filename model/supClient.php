<?php
include 'connexion.php';

if(isset($_GET['id']) AND !empty($_GET['id'])){

    $idOfClient = $_GET['id'];

    $checkIfQuestionExists = $connexion->prepare('SELECT * FROM client WHERE id = ?');
    $checkIfQuestionExists->execute(array($idOfClient));

    if($checkIfQuestionExists->rowCount() > 0){


        $delete = $connexion->prepare('DELETE FROM client WHERE id = ?');
        $delete->execute(array($idOfClient));

        header('Location:../vue/client.php'); 
       


    }else{
        $_SESSION['messageCli']['text'] = "Aucune question n'a été trouvée";
        $_SESSION['messageCli']['type'] = "success";
        
       
    }

}else{
    $_SESSION['messageCli']['text'] = "Aucune question n'a été trouvée";
    $_SESSION['messageCli']['type'] = "success";
}