<?php
include 'connexion.php';

if (
    !empty($_POST['id_article'])
    && !empty($_POST['id_categorie'])
    && isset($_POST['quantite']) // Utilise isset() car la quantité peut être 0
    && !empty($_POST['prix'])
    && !empty($_POST['nom_fournisseur'])
    && !empty($_POST['prenom_fournisseur'])
    && !empty($_POST['tel_fournisseur'])
    && !empty($_POST['id'])
){
    // Obtenir la quantité actuelle de l'article
    $sqlGetQuantity = "SELECT quantite FROM entre_stock WHERE id = ?";
    $stmtGetQuantity = $connexion->prepare($sqlGetQuantity);
    $stmtGetQuantity->execute([$_POST['id']]);
    $oldQuantity = $stmtGetQuantity->fetchColumn();

    // Calculer la différence de quantité
    $quantityDifference = $_POST['quantite'] - $oldQuantity;

    // Mettre à jour la quantité de l'article
    $sqlUpdateQuantity = "UPDATE article SET quantite = quantite + ? WHERE id = ?";
    $stmtUpdateQuantity = $connexion->prepare($sqlUpdateQuantity);
    $stmtUpdateQuantity->execute([$quantityDifference, $_POST['id_article']]);

    // Mettre à jour l'entrée dans la table entre_stock
    $sql = "UPDATE entre_stock SET id_article = ?, id_categorie = ?, quantite = ?, prix = ?,
     nom_fournisseur = ?, prenom_fournisseur = ?, tel_fournisseur = ? WHERE id = ?";

    $req = $connexion->prepare($sql);
    $req->execute([
        $_POST['id_article'],
        $_POST['id_categorie'],
        $_POST['quantite'],
        $_POST['prix'],
        $_POST['nom_fournisseur'],
        $_POST['prenom_fournisseur'],
        $_POST['tel_fournisseur'],
        $_POST['id']
    ]);
  
    if ($req->rowCount() != 0) {
        $_SESSION['message']['text'] = "entrée modifié avec succès";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = "Rien n'a été modifié";
        $_SESSION['message']['type'] = "warning";
    }
} else {
    $_SESSION['message']['text'] = "Un champ obligatoire n'est pas renseigné";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/entreStock.php');