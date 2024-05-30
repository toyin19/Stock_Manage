<?php
include 'connexion.php';

if (
    !empty($_POST['nom'])
    && !empty($_POST['prenom'])
    && !empty($_POST['username'])
    && !empty($_POST['role'])
    && !empty($_POST['telephone'])
    && !empty($_POST['email'])
    && !empty($_POST['mot_passe'])
    
    
){
    $hashed_password = password_hash($_POST['mot_passe'], PASSWORD_DEFAULT);

    $checkIfUserAlreadyExists = $connexion->prepare('SELECT email FROM utilisateur WHERE email = ?');
    $checkIfUserAlreadyExists->execute(array($email));

    if($checkIfUserAlreadyExists->rowCount() == 0){
        
        //Insérer l'utilisateur dans la bdd
        $sql="INSERT INTO utilisateur(nom, prenom, username, `role`, telephone, email, mot_passe) VALUES(?, ?, ?, ?, ?, ?, ?) ";
        $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['username'],
        $_POST['role'],
        $_POST['telephone'],
        $_POST['email'],
        $hashed_password
       
    ));
                        //Rediriger l'utilisateur vers la page d'accueil
                        header('Location: ../vue/utilisateur.php');
    }else {
        $error = "L'utilisateur existe déjà sur le site";
    }
    
}else {
    $_SESSION['messageUti']['text'] ="un champ obligatoire non renseigné";
    $_SESSION['messageUti']['type'] = "danger";
       
}










