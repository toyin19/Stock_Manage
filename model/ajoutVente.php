<?php
include_once "function.php";

if (
    !empty($_POST['id_article'])
    && !empty($_POST['id_client'])
    && !empty($_POST['quantite'])
    && !empty($_POST['prix'])
){
    $article = getArticle($_POST['id_article']);
    if (!empty($article) && is_array($article))
    {
        if($_POST['quantite']>$article['quantite']) {

        $_SESSION['messageVent']['text'] ="La quantité à vendre n'est pas disponible";
        $_SESSION['messageVent']['type'] = "danger";

        } else {
            $sql="INSERT INTO vente(id_article, id_client, quantite, prix) VALUES(?, ?, ?, ?) ";
            $req = $connexion->prepare($sql);
        
            $req->execute(array(
                $_POST['id_article'],
                $_POST['id_client'],
                $_POST['quantite'],
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
   
}else {
    $_SESSION['messageVent']['text'] ="un champ  obligatoire non renseigné";
    $_SESSION['messageVent']['type'] = "danger";
       
}
header('Location: ../vue/vente.php');