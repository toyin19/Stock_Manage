<?php 
	include 'connexion.php';
    
    function getArticle($id = null) {
        if(!empty($id))
        {
        $sql = "SELECT nom_article, libelle_categorie, quantite, prix_unitaire, date_fabrication, date_expiration, id_categorie, images, a.id AS id 
        FROM article AS a, categorie_article AS c WHERE a.id_categorie=c.id AND a.id=?";
        $req = $GLOBALS ['connexion']->prepare($sql);
        $req->execute(array($id));

        return $req->fetch();

        } else {

            $sql = "SELECT nom_article, libelle_categorie, quantite, prix_unitaire, date_fabrication, date_expiration, id_categorie, images, a.id AS id
            FROM article AS a, categorie_article AS c WHERE a.id_categorie=c.id";
        $req = $GLOBALS ['connexion']->prepare($sql);
        $req->execute();

        return $req->fetchAll();
        }
    }


    function getClient($id=null) {
        if(!empty($id))
        {
        $sql = "SELECT * FROM client WHERE id=?";
        $req = $GLOBALS ['connexion']->prepare($sql);
        $req->execute(array($id));

        return $req->fetch();

        } else {

        
        $sql = "SELECT * FROM client";
        $req = $GLOBALS ['connexion']->prepare($sql);
        $req->execute();

        return $req->fetchAll();
        }
    }

    function getVente($id=null) {
        if(!empty($id))
        {
            $sql = "SELECT nom_article, nom, prenom, v.quantite, prix, date_vente, v.id, prix_unitaire, adresse, telephone 
            FROM vente AS v, client AS c, article AS a WHERE v.id_article=a.id AND v.id_client=c.id AND v.id=? AND etat=?";

        $req = $GLOBALS ['connexion']->prepare($sql);
        $req->execute(array($id,1));

        return $req->fetch();

        } else {

        
        $sql = "SELECT nom_article, nom, prenom, v.quantite, prix, date_vente, v.id, a.id AS idArticle
        FROM vente AS v, client AS c, article AS a WHERE v.id_article=a.id AND v.id_client=c.id AND etat=?";

        $req = $GLOBALS ['connexion']->prepare($sql);
        $req->execute(array(1));

        return $req->fetchAll();
        }
    }

    function getFournisseur($id=null) {
        if(!empty($id))
        {
        $sql = "SELECT * FROM fournisseur WHERE id=?";
        $req = $GLOBALS ['connexion']->prepare($sql);
        $req->execute(array($id));

        return $req->fetch();

        } else {

        
        $sql = "SELECT * FROM fournisseur";
        $req = $GLOBALS ['connexion']->prepare($sql);
        $req->execute();

        return $req->fetchAll();
        }
    }

    function getCommande($id=null) {
        if(!empty($id))
        {
            $sql = "SELECT nom_article, nom, prenom, c.quantite, prix, date_commande, c.id, prix_unitaire, adresse, telephone 
            FROM commande AS c, fournisseur AS f, article AS a WHERE c.id_article=a.id AND c.id_fournisseur=f.id AND c.id=?";

        $req = $GLOBALS ['connexion']->prepare($sql);
        $req->execute(array($id));

        return $req->fetch();

        } else {

        
        $sql = "SELECT nom_article, nom, prenom, c.quantite, prix, date_commande, c.id, a.id AS idArticle
        FROM commande AS c, fournisseur AS f, article AS a WHERE c.id_article=a.id AND c.id_fournisseur=f.id";

        $req = $GLOBALS ['connexion']->prepare($sql);
        $req->execute();

        return $req->fetchAll();
        }
    }

    function getAllCommande(){
        $sql= "SELECT COUNT(*) AS nbre FROM commande ";
        $req = $GLOBALS ['connexion']->prepare($sql);
        $req->execute();

        return $req->fetch();
    }

    function getAllVente(){
        $sql= "SELECT COUNT(*) AS nbre FROM vente ";
        $req = $GLOBALS ['connexion']->prepare($sql);
        $req->execute();

        return $req->fetch();
    }

    function getAllArticle(){
        $sql= "SELECT COUNT(*) AS nbre FROM article ";
        $req = $GLOBALS ['connexion']->prepare($sql);
        $req->execute();

        return $req->fetch();
    }
    
    function getLastVente() {

        $sql = "SELECT nom_article, nom, prenom, v.quantite, prix, date_vente, v.id, prix_unitaire, adresse, telephone 
            FROM vente AS v, client AS c, article AS a WHERE v.id_article=a.id AND v.id_client=c.id 
            ORDER BY date_vente DESC Limit 10";


        $req = $GLOBALS ['connexion']->prepare($sql);
        $req->execute();

        return $req->fetchAll();
        
    }

    function getMostVente() {

        $sql = "SELECT nom_article, SUM(prix) AS prix 
            FROM vente AS v, client AS c, article AS a WHERE v.id_article=a.id AND v.id_client=c.id 
            GROUP BY a.id
            ORDER BY SUM(prix) DESC Limit 10";


        $req = $GLOBALS ['connexion']->prepare($sql);
        $req->execute();

        return $req->fetchAll();
        
    }
    function getCategorie($id=null) {
        if(!empty($id))
        {
        $sql = "SELECT * FROM categorie_article WHERE id=?";
        $req = $GLOBALS ['connexion']->prepare($sql);
        $req->execute(array($id));

        return $req->fetch();

        } else {

        
        $sql = "SELECT * FROM categorie_article";
        $req = $GLOBALS ['connexion']->prepare($sql);
        $req->execute();

        return $req->fetchAll();
        }
    }



    
