<?php

session_start();

include 'connect.php';

if (isset($_POST['connexion'])) {

    $email = htmlspecialchars($_POST['email']);
    $mdp = $_POST['mdp']; 

        if (empty($email) or empty($mdp)) { {
                $erreur = "Tous les champs doivent être complétés !";
            }
        }

        if (!empty($email) and !empty($mdp)) {

            $requser = $bdd->prepare("SELECT id_membre, email, mdp FROM membre WHERE email =:email");
            $requser->setFetchMode(PDO::FETCH_ASSOC);
            $requser->execute(['email' => $email]);
     
            $user = $requser->fetch();
            
            $email_bdd = $user['email'];
            $mdp_bdd = $user['mdp'];


            if (password_verify($mdp,$mdp_bdd)) {
                $_SESSION['email'] = $user['email'];
                $_SESSION['mdp'] = $user['mdp'];
                $_SESSION['id_membre'] = $user['id_membre'];

                header('Location: profil.php');

            } else {
                $erreur = "Email ou Mot de passe incorrect !";
            
            }
        }
    }

?>


<body>

    <?php require_once('header.php'); ?>
    <link rel="stylesheet" href="style/connexion.css">

    <main>


        <h1 class="h1conn">CONNEXION</h1>

        <form method="post" action="" class="formi">


            <div class="conni">
                
                <?php if (isset($erreur)) {
                    echo "<div class='error'>" . $erreur . "</div>";
                } ?>

                <label>EMAIL</label>
                <input type="email" name="email" placeholder='Arthur@gmail.com'>

                <label>MOT DE PASSE </label>
                <input type="password" name="mdp" placeholder='*****'>
            </div>

            <div id="buttoncon"> <input class="inputinside" type="submit" name="connexion" value="Se connecter"> </div>


        </form>

    </main>

    <?php require_once('footer.php') ?>


    <body>

        </html>