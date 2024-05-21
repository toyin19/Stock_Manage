<?php
include 'entete.php';
if (!empty($_GET['id'])) {
    $utilisateur = getUtilisateur($_GET['id']);
}

?>


    
<div class="home-content" >
    <div class="overview-boxes" >

        <div class="box"  >
            <form action="<?= !empty($_GET['id']) ? "../model/modifUtilisateur.php" : "../model/ajoutUtilisateur.php" ?>" method="post">

            <label for="nom"> Nom </label>
            <input value="<?= !empty($_GET['id']) ? $utilisateur['nom'] : "" ?>" type="text" name="nom" id="nom" placeholder="veuillez entrez votre nom "/>
            <input value="<?= !empty($_GET['id']) ? $utilisateur['id'] : "" ?>" type="hidden" name="id" id="id"/>

            <label for="prenom"> Prenom </label>
            <input value="<?= !empty($_GET['id']) ? $utilisateur['prenom'] : "" ?>" type="text" name="prenom" id="prenom" placeholder="veuillez entrez votre prenom "/>

            <label for="telephone"> Téléphone </label>
            <input value="<?= !empty($_GET['id']) ? $utilisateur['telephone'] : "" ?>" type="text" name="telephone" id="telephone" placeholder="veuillez entrez votre numero de téléphone "/>

            <label for="adresse">Email </label>
            <input value="<?= !empty($_GET['id']) ? $utilisateur['email'] : "" ?>" type="email" name="email" id="email" placeholder="veuillez entrez  votre email "/>

            <label for="adresse">Mot de passe </label>
            <input value="<?= !empty($_GET['id']) ? $utilisateur['mot_passe'] : "" ?>" type="password" name="mot_passe" id="mot_passe" placeholder="veuillez entrez votre mot_passe de "/>

             <button type="submit">Ajouter</button>

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

        <div class="box">
            <table class="mtable">
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Mot de passe</th>
                    <th>Actions</th>
                </tr>
                <?php 
                
                $utilisateur = getUtilisateur();
                if (!empty($utilisateur) && is_array($utilisateur)){
                    foreach ($utilisateur as $key => $value){
                        ?>  
                <tr>
                    <td><?= $value['nom'] ?></td>
                    <td><?= $value['prenom'] ?></td>
                    <td><?= $value['telephone'] ?></td>
                    <td><?= $value['email'] ?></td>
                    <td><?= $value['mot_passe'] ?></td>
                    <td>
                    <a href="?id=<?= $value['id']?>"><i class='bx bx-edit-alt'></i></a>
                    <a href="../model/supUtilisateur.php?id=<?= $value['id']?>"><i class='bx bx-message-rounded-x'></i></a>
                </td>
                </tr>
                
                <?php
                    }
                }
                ?>
            </table>
        </div>
        
       
    </div>  
</section>       
</div> 


<?php
	include 'pied.php';
?>