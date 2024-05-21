<?php
session_start();
include 'connexion.php';

if (
    !empty($_POST['nom'])
    && !empty($_POST['prenom'])
    && !empty($_POST['telephone'])
    && !empty($_POST['email'])
    && !empty($_POST['mot_passe'])
    
    
){
    $hashed_password = password_hash($_POST['mot_passe'], PASSWORD_DEFAULT);

    $checkIfUserAlreadyExists = $connexion->prepare('SELECT email FROM utilisateur WHERE email = ?');
    $checkIfUserAlreadyExists->execute(array($email));

    if($checkIfUserAlreadyExists->rowCount() == 0){
        
        //Insérer l'utilisateur dans la bdd
        $sql="INSERT INTO utilisateur(nom, prenom, telephone, email, mot_passe) VALUES(?, ?, ?, ?, ?) ";
        $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['telephone'],
        $_POST['email'],
        $hashed_password
       
    ));
                        //Rediriger l'utilisateur vers la page d'accueil
                        header('Location: ../vue/connexion.php');
    }else {
        $error = "L'utilisateur existe déjà sur le site";
    }
    
}else {
    $_SESSION['message']['text'] ="un champ obligatoire non renseigné";
    $_SESSION['message']['type'] = "danger";
       
}










