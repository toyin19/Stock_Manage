<?php
session_start();
if (!isset($_SESSION['mail'])) {
    header("Location: connexion.php");
  }

$_SESSION = array();
session_destroy();
header("Location:connexion.php");

//exit();
?>
