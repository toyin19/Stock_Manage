<?php
include_once "function.php";
if (
    !empty($_POST['produits'])
    && !empty($_POST['id_client'])
    && !empty($_POST['prix'])
){
    $articles=json_decode($_POST['produits']);
    $good_quantity=true;
    foreach($articles as $article){
        $db_article = getArticle($_POST['id_article']);
        if (!empty($db_article) && is_array($db_article))
        {
            
            if($article->quantite>$db_article['quantite']) {
                
            $_SESSION['messageVent']['text'] ="La quantité à vendre n'est pas disponible";
            $_SESSION['messageVent']['type'] = "danger";
                $good_quantity=false;
                header('Location: ../vue/vente.php');
                exit;

            }
        }
        }
        if($good_quantity){
            
                $sql="INSERT INTO vente(article,id_article, id_client, prix) VALUES(?, ?, ?,?) ";
                $req = $connexion->prepare($sql);
            
                $req->execute(array(
                    json_encode($_POST['produits']),
                    null,
                    $_POST['id_client'],
                    $_POST['prix']
                ));
                 if ($req->rowCount()!=0) {
    
                     $sql= "UPDATE article SET quantite= quantite-? WHERE id=?";
                     $req = $connexion->prepare($sql);
                
                     $req->execute(array(
                         $_POST['quantite'],
                         $_POST['id_article'],
                     ));
    
                     if ($req->rowCount()!=0) {
                    $_SESSION['messageVent']['text'] = "vente effectuée avec succès";
                     $_SESSION['messageVent']['type'] = "success";
                     }else {
                        $_SESSION['messageVent']['text'] ="Impossible d'effectuer cette vente";
                         $_SESSION['messageVent']['type'] = "danger";
                      
                     }     
                 }else {
                     $_SESSION['messageVent']['text'] ="une erreur s'est produite lors de la vente";
                     $_SESSION['messageVent']['type'] = "danger"; 
                 }
            
        }
    }
else {
    $_SESSION['messageVent']['text'] ="un champ  obligatoire non renseigné";
    $_SESSION['messageVent']['type'] = "danger";

}
header('Location: ../vue/vente.php');