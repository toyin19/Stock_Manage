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
                
            $_SESSION['message']['text'] ="La quantité à vendre n'est pas disponible";
            $_SESSION['message']['type'] = "danger";
                // $good_quantity=false;
            }
        }
        }
        if($good_quantity){
            
                $sql="INSERT INTO vente(article,id_article, id_client, prix) VALUES(?, ?, ?,?) ";
                $req = $connexion->prepare($sql);
            
                $req->execute(array(
                    json_encode($_POST['produits']),
                    9, 
                    $_POST['id_client'],
                    $_POST['prix']
                ));
                // if ($req->rowCount()!=0) {
    
                //     $sql= "UPDATE article SET quantite= quantite-? WHERE id=?";
                //     $req = $connexion->prepare($sql);
                
                //     $req->execute(array(
                //         $_POST['quantite'],
                //         $_POST['id_article'],
                //     ));
    
                //     if ($req->rowCount()!=0) {
                //     $_SESSION['message']['text'] = "vente effectuée avec succès";
                //     $_SESSION['message']['type'] = "success";
                //     }else {
                //         $_SESSION['message']['text'] ="Impossible d'effectuer cette vente";
                //         $_SESSION['message']['type'] = "danger";
                      
                //     }     
                // }else {
                //     $_SESSION['message']['text'] ="une erreur s'est produite lors de la vente";
                //     $_SESSION['message']['type'] = "danger"; 
                // }
            
        }
    }
else {
    $_SESSION['message']['text'] ="un champ  obligatoire non renseigné";
    $_SESSION['message']['type'] = "danger";

}
header('Location: ../vue/vente.php');