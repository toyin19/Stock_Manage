<?php

include_once '../model/function.php';

    if (!isset($_SESSION['username'])) {
       
        header("Location:connexion.php");
        exit; 
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
    <div class="sidebar hidden-print">
        <div class="logo-details">
            <i class="bx bxl-c-plus-plus"></i>
            <span class="logo_name">S-MANAGE</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="dashboard.php" class=" <?php
                  echo  basename($_SERVER['PHP_SELF'])=="dashboard.php"? "active" : "" ?>">
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="article.php" class=" <?php
                  echo  basename($_SERVER['PHP_SELF'])=="article.php"? "active" : "" ?>">
                    <i class="bx bx-box"></i>
                    <span class="links_name">Article</span>
                </a>
            </li>
            <?php
             if(isset($_SESSION['role']) and ($_SESSION['role']=='administrateur') or $_SESSION['role']=='responsable_logistique') {
            ?>
            <li>
                <a href="categorie.php" class=" <?php
                  echo  basename($_SERVER['PHP_SELF'])=="categorie.php"? "active" : "" ?>">
                    <i class="bx bx-category"></i>
                    <span class="links_name">Categorie</span>
                </a>
            </li>
           
            <li>
                <a href="entreStock.php" class=" <?php
                  echo  basename($_SERVER['PHP_SELF'])=="entreStock.php"? "active" : "" ?>">
                    <i class="bx bx-list-ul"></i>
                    <span class="links_name">Entrée</span>
                </a>
            </li>
            <?php
             } 
             ?>

             <?php
             if(isset($_SESSION['role']) and ($_SESSION['role']=='administrateur') or $_SESSION['role']=='vendeur') {
            ?>
            <li>
                <a href="client.php" class=" <?php
                  echo  basename($_SERVER['PHP_SELF'])=="client.php"? "active" : "" ?>">
                    <i class="bx bx-user"></i>
                    <span class="links_name">Client</span>
                </a>
            </li>
            
            <li>
                <a href="vente.php" class=" <?php
                  echo  basename($_SERVER['PHP_SELF'])=="vente.php"? "active" : "" ?>">
                <i class='bx bx-shopping-bag'></i>
                    <span class="links_name">Vente</span>
                </a>
            </li>
            <?php
             } 
             ?>
           
            <?php
             if(isset($_SESSION['role']) and $_SESSION['role']=='administrateur'){
            ?>
            <li>
                <a href="utilisateur.php"class=" <?php
                  echo  basename($_SERVER['PHP_SELF'])=="utilisateur.php"? "active" : "" ?>">
                    <i class="bx bx-user"></i>
                    <span class="links_name">Utilisateur</span>
                </a>
            </li>
            <?php
             } 
             ?>
            <!-- <li>
          <a href="#">
            <i class="bx bx-message" ></i>
            <span class="links_name">Messages</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-heart" ></i>
            <span class="links_name">Favrorites</span>
          </a>
        </li> -->
            <li>
                <a href="#">
                    <i class="bx bx-cog"></i>
                    <span class="links_name">Configuration</span>
                </a>
            </li>
            <li class="log_out">
                <a href="deconnexion.php" class=" <?php
                  echo  basename($_SERVER['PHP_SELF'])=="deconnexion.php"? "active" : "" ?>">
                    <i class="bx bx-log-out"></i>
                    <span class="links_name">Déconnexion</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav class="hidden-print">
            <div class="sidebar-button">
                <i class="bx bx-menu sidebarBtn"></i>
                <span class="dashboard"><?php
                       echo ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF'])));
                       ?>
                </span>
            </div>
            <div class="search-box">
                <input type="text" placeholder="Recherche..." />
                <i class="bx bx-search"></i>
            </div>
            <div class="profile-details">
                <!--<img src="images/profile.jpg" alt="">-->
                <span class="admin_name"><?php echo $_SESSION['username']?></span>
                <i class="bx bx-chevron-down"></i>
            </div>
        </nav>