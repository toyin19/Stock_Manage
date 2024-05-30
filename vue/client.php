
<?php
if (isset($_SESSION['role']) && $_SESSION['role']!='administrateur' && $_SESSION['role']!='vendeur') {
    header("Location:dashboard.php");
    exit; 
}
	include 'entete.php';
    if (!empty($_GET['id'])) {
        $client = getClient($_GET['id']);
    }

?>

<div class="home-content">
    <div class="overview-boxes">
    <?php
             if(isset($_SESSION['role']) and $_SESSION['role']=='vendeur') {
            ?>
         <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifClient.php" : "../model/ajoutClient.php" ?>" method="post">
            <label for="nom"> Nom </label>
            <input value="<?= !empty($_GET['id']) ? $client['nom'] : "" ?>" type="text" name="nom" id="nom" placeholder="veuillez entrez le nom du client"/>
            <input value="<?= !empty($_GET['id']) ? $client['id'] : "" ?>" type="hidden" name="id" id="id"/>

            <label for="prenom"> Prenom </label>
            <input value="<?= !empty($_GET['id']) ? $client['prenom'] : "" ?>" type="text" name="prenom" id="prenom" placeholder="veuillez entrez le prenom du client"/>

            <label for="telephone"> Téléphone </label>
            <input value="<?= !empty($_GET['id']) ? $client['telephone'] : "" ?>" type="text" name="telephone" id="telephone" placeholder="veuillez entrez le numero de téléphone du client"/>

            <label for="adresse">Email </label>
            <input value="<?= !empty($_GET['id']) ? $client['email'] : "" ?>" type="email" name="email" id="email" placeholder="veuillez entrez l'email du client"/>

             <button type="submit">Valider</button>

                 <?php 

                 if (!empty($_SESSION['messageCli']['text'])) {
                ?>
                <div class="alert <?= ($_SESSION['messageCli']['type']) ?>">
                <?= ($_SESSION['messageCli']['text']) ?>
            </div>

                <?php      
               }
                ?>

            </form>
              
         </div>
          <?php
                }
                ?>


         <div class="box">
            <table class="mtable">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <?php
             if(isset($_SESSION['role']) and $_SESSION['role']=='vendeur') {
            ?>
                    <th>Actions</th>
                    <?php
                }
                ?>
                </tr>
                <?php 
                
                $clients = getClient();
                if (!empty($clients) && is_array($clients)){
                    foreach ($clients as $key => $value){
                        ?>  
                <tr>
                    <td><?= $value['id'] ?></td>
                    <td><?= $value['nom'] ?></td>
                    <td><?= $value['prenom'] ?></td>
                    <td><?= $value['telephone'] ?></td>
                    <td><?= $value['email'] ?></td>
                    <?php
             if(isset($_SESSION['role']) and $_SESSION['role']=='vendeur') {
            ?>
                    <td>
                        <a href="?id=<?= $value['id']?>"><i class='bx bx-edit-alt'></i></a>
                    </td>
                    <?php
                }
                ?>
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