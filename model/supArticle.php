<?php
include 'connexion.php';

if(isset($_GET['id']) AND !empty($_GET['id'])){

    $idOfArticle = $_GET['id'];

    $checkIfQuestionExists = $connexion->prepare('SELECT * FROM article WHERE id = ?');
    $checkIfQuestionExists->execute(array($idOfArticle));

    if($checkIfQuestionExists->rowCount() > 0){


        $delete = $connexion->prepare('DELETE FROM article WHERE id = ?');
        $delete->execute(array($idOfArticle));

        header('Location:../vue/article.php'); 
       


    }else{
        $_SESSION['messageArti']['text'] = "Aucune question n'a été trouvée";
        $_SESSION['messageArti']['type'] = "success";
        
       
    }

}else{
    $_SESSION['messageArti']['text'] = "Aucune question n'a été trouvée";
    $_SESSION['messageArti']['type'] = "success";
}