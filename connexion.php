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

        $requser = $bdd->prepare("SELECT * FROM membre WHERE email = ? AND mdp = ?");
        $requser->execute(array($email, $mdp));

        $userexist = $requser->rowCount();

        if ($userexist == 1) {
            $userinfo = $requser->fetch();

            $_SESSION['email'] = $userinfo['email'];
            $_SESSION['mdp'] = $userinfo['mdp'];
            $_SESSION['id_membre'] = $userinfo['id_membre'];

            header('Location: profil.php');
        } else {
            $erreur = "Mauvais mail ou mot de passe !";
        }
    }
}
?>


<body>

    <?php require_once('header.php'); ?>
    <link rel="stylesheet" href="style/connexion.css">

    <main>


        <h1 class="h1conn">CONNEXION</h1>

        <?php if (isset($erreur)) {
        echo "<div class='erreur'>" . $erreur . "</div";
        } ?>

        <form method="post" action="connexion.php" class="formi">

            <div class="conni">

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