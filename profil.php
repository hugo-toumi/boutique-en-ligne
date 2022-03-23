
<?php

	session_start();
    
    include 'connect.php';
    
	if(isset($_SESSION['id_membre']) AND $_SESSION['id_membre'] > 0) {

	   $getid = intval($_SESSION['id_membre']);

	   $requser = $bdd->prepare('SELECT * FROM membre WHERE id_membre = ?');

	   $requser->execute(array($getid));

	   $userinfo = $requser->fetch();

	?>


<body>

<?php 
require_once('header.php');?>   
<link rel="stylesheet" href="style/profil.css">

<main>

    
<h1 class="h1profil">PROFIL DE <?php echo $userinfo['pseudo']; ?></h1>

    <div class="box-profil">


            <form method="get" action="profil.php" class="profito" >
            
                <div class="info">

                    <label>PRENOM</label>
                    <input type="text" name="prenom" value= <?php echo $userinfo['prenom']; ?> required>

                    <label>NOM</label> 
                    <input type="text" name="nom" value= <?php echo $userinfo['nom']; ?> required>
                
                    <label>PSEUDO</label>
                    <input type="text" name="pseudo" value= <?php echo $userinfo['pseudo']; ?> required>
              
                </div>


                <div class="connexion">

                    <label>EMAIL</label> 
                    <input type="email" name="email" value=<?php echo $userinfo['email']; ?> required>

                    <label>MOT DE PASSE</label> 
                    <input type="password" name="mdp" value=<?php echo $userinfo['mdp']; ?> required>

                    <label>CONFIRMATION MOT DE PASSE</label> 
                    <input type="password" name="mdpconfirm" required>
               
                </div>

                

                <div class="adresse">

                    <label>ADRESSE</label> 
                    <input type="text" name="adresse" value=<?php echo $userinfo['adresse']; ?> required>
                  
                    <label>CODE POSTALE</label> 
                    <input type="text" minlength="5" maxlength="5" name="code_postale" value=<?php echo $userinfo['code_postale']; ?> required>
                
                    <label>VILLE</label> 
                    <input  type="text" name="ville" value=<?php echo $userinfo['ville']; ?> required>
                
                </div>

    </div>
                
                <div id="buttoncon"> <input class="inputinside" name="profil" type="submit"value="Enregistrer"> </div> 

        
            </form>

            <?php $footer = 'style/footer.css';
            require_once('footer.php') ?>


<body>
</html>


<?php   
	}
	?>