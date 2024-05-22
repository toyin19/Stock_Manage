<?php
	include 'connexion.php';
    
    function getArticle($id = null, $searchDATA = array() ) {

        if(!empty($id))
        {
            $sql = "SELECT nom_article, libelle_categorie, id_categorie, quantite, prix_unitaire, a.id AS id
            FROM article AS a, categorie_article AS c WHERE a.id_categorie=c.id AND a.id=?";

        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($id));

        return $req->fetch();

        }elseif(!empty($searchDATA)){

          $search = "";
          extract($searchDATA);
         if(!empty($nom_article)) $search .= " AND a.nom_article LIKE '%$nom_article%' ";
         if(!empty($id_categorie)) $search .= " AND a.id_categorie = $id_categorie ";
         if(!empty($quantite)) $search .= " AND a.quantite = $quantite ";
         if(!empty($prix_unitaire)) $search .= " AND a.prix_unitaire = $prix_unitaire ";

         $sql = "SELECT nom_article, libelle_categorie, id_categorie, quantite, prix_unitaire, a.id AS id
            FROM article AS a, categorie_article AS c WHERE a.id_categorie=c.id $search";

         $req = $GLOBALS ['connexion']->prepare($sql);
         $req->execute();

         return $req->fetchAll();
        } else {

        
            $sql = "SELECT nom_article, libelle_categorie, id_categorie, quantite, prix_unitaire, a.id AS id
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
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($id));

        return $req->fetch();

        } else {

        
        $sql = "SELECT * FROM fournisseur";
        $req = $GLOBALS ['connexion']->prepare($sql);
        $req->execute();

        return $req->fetchAll();
        }
    }

    function getEntreStock($id=null) {
        if(!empty($id))
        {
            $sql = "SELECT nom_article, nom_fournisseur, prenom_fournisseur, tel_fournisseur, date_entre, libelle_categorie, e.quantite, prix, e.id, a.id AS id_article, c.id AS id_categorie 
            FROM entre_stock AS e, categorie_article AS c, article AS a WHERE e.id_article=a.id AND e.id_categorie=c.id AND e.id=? ";

        $req = $GLOBALS ['connexion']->prepare($sql);
        $req->execute(array($id));

        return $req->fetch();

        } else {

        
            $sql = "SELECT nom_article, nom_fournisseur, prenom_fournisseur, tel_fournisseur, date_entre, libelle_categorie,  e.quantite, e.prix, e.id, a.id AS id_article, c.id AS id_categorie 
            FROM entre_stock AS e, categorie_article AS c, article AS a WHERE e.id_article=a.id AND e.id_categorie=c.id  ";

        $req = $GLOBALS ['connexion']->prepare($sql);
        $req->execute();

        return $req->fetchAll();
        }
    }

    

  

    function getAllEntreStock(){
        $sql= "SELECT COUNT(*) AS nbre FROM entre_stock ";
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

    
    function getUtilisateur($id=null) {
        if(!empty($id))
        {
        $sql = "SELECT * FROM utilisateur WHERE id=?";
        $req = $GLOBALS ['connexion']->prepare($sql);
        $req->execute(array($id));

        return $req->fetch();

        } else {

        
        $sql = "SELECT * FROM utilisateur";
        $req = $GLOBALS ['connexion']->prepare($sql);
        $req->execute();

        return $req->fetchAll();
        }
    }

    



    
