
<?php

include_once '../model/connexion.php';



//Validation du formulaire

    //Vérifier si le user a bien complété tous les champs
    if(!empty($_POST['email']) AND !empty($_POST['mot_passe'])){
        
        //Les données de l'user
        $user_pseudo = htmlspecialchars($_POST['email']);
        $user_password = htmlspecialchars($_POST['mot_passe']);
        
       

        //Vérifier si l'utilisateur existe (si l'email est correct)
        $checkIfUserExists = $connexion->prepare('SELECT * FROM utilisateur WHERE email = ?');
        $checkIfUserExists->execute(array($user_pseudo));

          $userInfo = null;
        if($checkIfUserExists->rowCount() > 0){
            
            //Récupérer les données de l'utilisateur
            $userInfo = $checkIfUserExists->fetch();

            //Vérifier si le mot de passe est correct
            if(password_verify($user_password, $userInfo['mot_passe'])){
                $_SESSION['mail']=$_POST['email'];

                //Rediriger l'utilisateur vers la page d'accueil
                header('Location:dashboard.php');
    
            }else{

                $_SESSION['message']['text'] ="Votre mot de passe est incorrect...";
                $_SESSION['message']['type'] = "danger";
            }

        }else{
            $_SESSION['message']['text'] ="Votre email est incorrect...";
            $_SESSION['message']['type'] = "danger";
        }

    }else{
        $_SESSION['message']['text'] ="Veuillez compléter tous les champs...";
        $_SESSION['message']['type'] = "danger";
    }





?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <title> <?php
        echo ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF'])));
    ?>
    </title>
    <link rel="stylesheet" href="../public/css/style.css" />
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

    
<div class="home-content" style=" background-color: #808080;  background-repeat: no-repeat; background-position: center; background-size: cover; display: flex; justify-content: center; align-items: center; height: 100vh;" >
    <div class="overview-boxes" >
        <div class="box">
            <form   action="" method="post">
          
            <label for="adresse">Email </label>
            <input value="<?= !empty($_GET['id']) ? $utilisateur['email'] : "" ?>" type="email" name="email" id="email" placeholder="veuillez entrez  votre email "/>

            <label for="adresse">Mot de passe </label>
            <input value="<?= !empty($_GET['id']) ? $utilisateur['mot_passe'] : "" ?>" type="password" name="mot_passe" id="mot_passe" placeholder="veuillez entrez votre mot_passe de "/>

             <button type="submit" name="login">Se connecter</button>

                 <?php 

                 if (!empty($_SESSION['message']['text'])) {
                ?>
               <div class="alert <?= ($_SESSION['message']['type']) ?>">
                <?= ($_SESSION['message']['text']) ?>
               </div>

                <?php      
               }
                ?>

            </form>
        </div>        
    </div>         
</div> 

</body>
</html>