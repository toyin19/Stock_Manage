<?php
include_once '../model/function.php'
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

    
<div class="home-content" style=" background-color: #808080; background-repeat: no-repeat; background-position: center; background-size: cover; display: flex; justify-content: center; align-items: center; height: 100vh;" >
    <div class="overview-boxes" >

        <div class="box">
            <form   action="<?= !empty($_GET['id']) ? "../model/modifUtilisateur.php" : "../model/inscription.php" ?>" method="post">

            <label for="nom"> Nom </label>
            <input value="<?= !empty($_GET['id']) ? $utilisateur['nom'] : "" ?>" type="text" name="nom" id="nom" placeholder="veuillez entrez votre nom "/>
            <input value="<?= !empty($_GET['id']) ? $utilisateur['id'] : "" ?>" type="hidden" name="id" id="id"/>

            <label for="prenom"> Prenom </label>
            <input value="<?= !empty($_GET['id']) ? $utilisateur['prenom'] : "" ?>" type="text" name="prenom" id="prenom" placeholder="veuillez entrez votre prenom "/>

            <label for="prenom"> Username </label>
            <input value="<?= !empty($_GET['id']) ? $utilisateur['username'] : "" ?>" type="text" name="username" id="username" placeholder="veuillez entrez votre username "/>

            <label for="telephone"> Téléphone </label>
            <input value="<?= !empty($_GET['id']) ? $utilisateur['telephone'] : "" ?>" type="text" name="telephone" id="telephone" placeholder="veuillez entrez votre numero de téléphone "/>

            <label for="adresse">Email </label>
            <input value="<?= !empty($_GET['id']) ? $utilisateur['email'] : "" ?>" type="email" name="email" id="email" placeholder="veuillez entrez  votre email "/>

            <label for="adresse">Mot de passe </label>
            <input value="<?= !empty($_GET['id']) ? $utilisateur['mot_passe'] : "" ?>" type="password" name="mot_passe" id="mot_passe" placeholder="veuillez entrez votre mot_passe de "/>

             <button type="submit">S'inscrire</button>

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