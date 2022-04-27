<?php

require_once("init.inc.php");
require_once("Model_user.php");
$root = new User();

include 'connect.php';

if (isset($_POST['connexion'])) {

    $email = htmlspecialchars($_POST['email']);
    $mdp = $_POST['mdp'];

    if (empty($email) or empty($mdp)) { {
            $erreur = "Tous les champs doivent être complétés !";
        }
    }

    if (!empty($email) and !empty($mdp)) {

        $user = $root->FindUser($email);
        var_dump($user);

        if($user) {
            $mdp_bdd = $user[0]['mdp'];


            if (password_verify($mdp, $mdp_bdd)) {
                $_SESSION['email'] = $user[0]['email'];
                $_SESSION['mdp'] = $user[0]['mdp'];
                $_SESSION['id_membre'] = $user[0]['id_membre'];

                header('Location: index.php?succes=true');  
            } else {
                $erreur = "Email ou Mot de passe incorrect !";
            }
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

        <?php
            if(isSet($_GET['succes']) && $_GET['succes']) {
        ?>
            <div class="success">Inscription réussie ! Place à la connexion !</div>
        <?php
            } 
        ?>
        

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