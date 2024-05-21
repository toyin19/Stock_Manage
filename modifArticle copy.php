<?php
include 'connexion.php';

if (
    !empty($_POST['nom_article'])
    && !empty($_POST['id_categorie'])
    && !empty($_POST['quantite'])
    && !empty($_POST['prix_unitaire'])
    && !empty($_POST['date_fabrication'])
    && !empty($_POST['date_expiration'])
    && !empty($_POST['id'])
    && !empty($_FILES['images'])
){
    $sql= "UPDATE article SET nom_article=?, id_categorie=?, quantite=?, prix_unitaire=?, 
    date_fabrication=?, date_expiration=?, images=?  WHERE id=?";

    $req = $connexion->prepare($sql);
    $req->execute(array(
        $_POST['nom_article'],
        $_POST['id_categorie'],
        $_POST['quantite'],
        $_POST['prix_unitaire'],
        $_POST['date_fabrication'],
        $_POST['date_expiration'],
        $_POST['id'],
        $destination
    ));
  
    if ($req->rowCount()!=0) {
        $_SESSION['message']['text'] = "article modifier avec succès";
        $_SESSION['message']['type'] = "success";
        
    }else {
        $_SESSION['message']['text'] ="une erreur s'est produite lors de l'ajout de l'article";
        $_SESSION['message']['type'] = "warning";
      
    }

    
}else {
    $_SESSION['message']['text'] ="un champ  obligatoire non renseigné";
    $_SESSION['message']['type'] = "danger";
       
}
header('Location: ../vue/article.php');

if ($user) {
  
    switch ($user->role) {
        case 'admin1':
            header("Location: admin_page.php");
            exit();
            break;
        case 'admin2':
            header("Location: moderator_page.php");
            exit();
            break;
        case 'admin2':
            header("Location: user_page.php");
            exit();
            break;
        default:
            // Redirection par défaut si le rôle de l'utilisateur n'est pas reconnu
            header("Location: default_page.php");
            exit();
            break;
    }
} else {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: connexion.php");
    exit();
}

