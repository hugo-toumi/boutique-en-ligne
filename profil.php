<?php

session_start();

include 'connect.php';


// * Recuperation des données/infos dans la bdd avec lesquels l'user c'est inscrit et connecté  (echo dans le form)

if (isset($_SESSION['id_membre']) and $_SESSION['id_membre'] > 0) {

    $getid = intval($_SESSION['id_membre']);

    $requser = $bdd->prepare('SELECT * FROM membre WHERE id_membre = ?');

    $requser->execute(array($getid));

    $userinfo = $requser->fetch();
?>


    <!-- UPDATE PROFIL !! -->

    <?php

    if (isset($_POST['profil'])) {

        $pseudo = htmlspecialchars(trim($_POST['pseudo']));
        $pseudo_origine = htmlspecialchars(trim($_POST['pseudo_origine']));

        $email = htmlspecialchars(trim($_POST['email']));
        $email_origine = htmlspecialchars(trim($_POST['email_origine']));

        $prenom = htmlspecialchars(trim(ucwords(strtolower($_POST['prenom']))));
        $nom = htmlspecialchars(trim(ucwords(strtolower($_POST['nom']))));
        $ville = htmlspecialchars(trim($_POST['ville']));
        $code_postale = htmlspecialchars(trim($_POST['code_postale']));
        $mdp = htmlspecialchars(trim($_POST['mdp']));
        $mdpconfirm = htmlspecialchars(trim($_POST['mdpconfirm']));
        $adresse = htmlspecialchars(trim($_POST['adresse']));
        $statut = 1;
        $id = $_SESSION['id_membre'];

        $valid = (bool) true;


        //  EMAIL

        $reqmail = $bdd->prepare("SELECT * FROM membre WHERE email =:email");
        $reqmail->setFetchMode(PDO::FETCH_ASSOC);
        $reqmail->execute(['email' => $email]);

        $resultmail = $reqmail->fetch();

        if (empty($email)) {
            $valid = false;
            $err_email = "Renseignez l'email.";
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $valid = false;
            $err_email = "Votre email n'est pas au bon format";
            $email = "";
        } elseif ($resultmail) {
            if($email == $email_origine) {
                $valid = true;
            } else {
                $valid = false;
                $err_email = "Cette adresse mail est déjà utilisée.";
                $email ="";
            }
        }

   
    
        //  MOT DE PASSE

        if (empty($mdp)) {
            $valid = false;
            $err_mdp = "Renseignez votre mot de passe.";
        } elseif (strlen($mdp) < 8) {
            $valid = false;
            $err_mdp = "Le mot de passe doit être de 8 caractères minimum.";
            $mdp = "";
        } elseif (empty($mdpconfirm)) {
            $valid = false;
            $err_mdpconfirm = "Confirmez votre mot de passe.";
        } elseif ($mdp !== $mdpconfirm) {
            $valid = false;
            $err_mdpconfirm = "Les mots de passes ne sont pas identiques !";
            $mdpconfirm = "";
        }


        //  PSEUDO

        $reqpseudo = $bdd->prepare("SELECT * FROM membre WHERE pseudo =:pseudo");
        $reqpseudo->setFetchMode(PDO::FETCH_ASSOC);
        $reqpseudo->execute(['pseudo' => $pseudo]);

        $resultpseudo = $reqpseudo->fetch();

        if (empty($pseudo)) {
            $valid = false;
            $err_pseudo = "Renseignez votre pseudo.";
        } elseif ($resultpseudo) {
            if($pseudo == $pseudo_origine) {
                $valid = true;
            } else {
                $valid = false;
                $err_pseudo = "Ce pseudo est déjà utilisé.";
                $pseudo ="";
            }
        }



        // PRENOM

        if (empty($prenom)) {
            $valid = false;
            $err_prenom = "Renseignez votre prénom.";
        } elseif (!preg_match("#^[a-zA-Z]+$#", $prenom)) {
            $valid = false;
            $err_prenom = "Votre prénom ne doit pas contenir de chiffres ou de caractères spéciaux.";
            $prenom = "";
        }


        //  NOM

        if (empty($nom)) {
            $valid = false;
            $err_nom = "Renseignez votre nom.";
        } elseif (!preg_match("#^[a-zA-Z]+$#", $nom)) {
            $valid = false;
            $err_nom = "Votre nom ne doit pas contenir de chiffres ou de caractères spéciaux.";
            $nom = "";
        }


        // VILLE

        if (empty($ville)) {
            $valid = false;
            $err_ville = "Renseignez votre ville.";
        } elseif (!preg_match("#^[a-zA-Z]+$#", $ville)) {
            $valid = false;
            $err_ville = "Votre ville ne doit pas contenir de chiffres ou de caractères spéciaux.";
            $ville = "";
        }


        // CODE POSTALE

        if (empty($code_postale)) {
            $valid = false;
            $err_code_postale = "Renseignez votre code postal.";
        } elseif (!preg_match("~^[0-9]{5}$~", $code_postale)) {
            $valid = false;
            $code_postale = '';
            $err_code_postale = "Le code postal n'est pas au bon format";
        }


        // ADRESSE

        if (empty($adresse)) {
            $valid = false;
            $err_adresse = "Renseignez votre adresse..";
        }



        if ($valid == true) {

            $req = $bdd->prepare("UPDATE `membre` SET `pseudo`= :pseudo,`mdp`= :mdp,`nom`= :nom,`prenom`= :prenom,`email`= :email,`ville`= :ville,`code_postale`= :code_p,`adresse`= :adresse,`statut`= 1 WHERE id_membre = :id");
            $req->bindValue(':pseudo', $pseudo);
            $req->bindValue(':mdp', $mdp);
            $req->bindValue(':nom', $nom);
            $req->bindValue(':prenom', $prenom);
            $req->bindValue(':email', $email);
            $req->bindValue(':ville', $ville);
            $req->bindValue(':code_p', $code_postale);
            $req->bindValue(':adresse', $adresse);
            $req->bindValue(':id', $id);
            $req->execute();


            header('Location: index.php');
        }
    }

    ?>


    <body>

        <?php
        require_once('header.php'); ?>
        <link rel="stylesheet" href="style/profil.css">

        <main>


            <h1 class="h1profil">Bienvenue sur ton profil : <?php echo $userinfo['pseudo']; ?></h1>

            <div class="box-profil">


                <form method="post" action="profil.php" class="profito">

                    <div class="info">

                        <label>PRENOM</label>
                        <?php if (isset($err_prenom)) {echo "<div class='err_form'> $err_prenom<div>";} ?>
                        <input type="text" name="prenom" value=<?php echo $userinfo['prenom']; ?> required>

                        <label>NOM</label>
                        <?php if (isset($err_nom)) {echo "<div class='err_form'> $err_nom<div>";} ?>
                        <input type="text" name="nom" value=<?php echo $userinfo['nom']; ?> required>

                        <label>PSEUDO</label>
                        <?php if (isset($err_pseudo)) {echo "<div class='err_form'> $err_pseudo<div>";} ?>
                        <input type="text" name="pseudo" value=<?php echo $userinfo['pseudo']; ?> required>
                        <input type="hidden" name="pseudo_origine" value=<?php echo $userinfo['pseudo']; ?> >
                    </div>


                    <div class="connexion">

                        <label>EMAIL</label>
                        <?php if (isset($err_email)) {echo "<div class='err_form'> $err_email<div>";} ?>
                        <input type="email" name="email" value=<?php echo $userinfo['email']; ?> required>
                        <input type="hidden" name="email_origine" value=<?php echo $userinfo['email']; ?> >

                        <label>MOT DE PASSE</label>
                        <?php if (isset($err_mdp)) {echo "<div class='err_form'> $err_mdp<div>";} ?>
                        <input type="password" name="mdp" value=<?php echo $userinfo['mdp']; ?> required>

                        <label>CONFIRMATION MOT DE PASSE</label>
                        <?php if (isset($err_mdpconfirm)) {echo "<div class='err_form'> $err_mdpconfirm<div>";} ?>
                        <input type="password" name="mdpconfirm" value=<?php echo $userinfo['mdp']; ?> required>

                    </div>



                    <div class="adresse">

                        <label>ADRESSE</label>
                        <?php if (isset($err_adresse)) {echo "<div class='err_form'> $err_adresse<div>";} ?>
                        <input type="text" name="adresse" value=<?php echo $userinfo['adresse']; ?> required>

                        <label>CODE POSTALE</label>
                        <?php if (isset($err_code_postale)) {echo "<div class='err_form'> $err_code_postale<div>";} ?>
                        <input type="text" minlength="5" maxlength="5" name="code_postale" value=<?php echo $userinfo['code_postale']; ?> required>

                        <label>VILLE</label>
                        <?php if (isset($err_ville)) {echo "<div class='err_form'> $err_ville<div>";} ?>
                        <input type="text" name="ville" value=<?php echo $userinfo['ville']; ?> required>

                    </div>

            </div>

            <div id="buttoncon"> <input class="inputinside" name="profil" type="submit" value="Enregistrer"> </div>


            </form>

            <?php $footer = 'style/footer.css';
            require_once('footer.php') ?>


            <body>

                </html>

            <?php
        }
            ?>