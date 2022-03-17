<?php

include 'connect.php' ;

$message = '';

if (isset($_POST['suscribe'])) {

    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
    $email = htmlspecialchars(trim($_POST['email']));
    $prenom = htmlspecialchars(trim(ucwords(strtolower($_POST['prenom']))));
    $nom = htmlspecialchars(trim(ucwords(strtolower($_POST['nom']))));
    $ville = htmlspecialchars(trim($_POST['ville']));
    $code_postale = htmlspecialchars(trim($_POST['code_postale']));
    $mdpconfirm = htmlspecialchars(trim($_POST['mdpconfirm']));
    $adresse = htmlspecialchars(trim($_POST['adresse']));
    $statut = 1;
    $mdp = htmlspecialchars(trim($_POST['mdp']));


    $valid = (boolean) true;

    // CHECK EMAIL ----------

    $reqmail = $bdd->prepare("SELECT * FROM membre WHERE email =:email");
    $reqmail->setFetchMode(PDO::FETCH_ASSOC);
    $reqmail->execute(['email'=>$email]);

    $resultmail = $reqmail->fetch();

    if (empty($email)) {
        $valid=false;
        $err_email = "Renseignez l'email.";
        echo $err_email;
    }

    elseif(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $valid=false;
        $err_email = "Votre email n'est pas au bon format";
        $email="";
        echo $err_email;
    }

    elseif ($resultmail) {
        $valid = false;
        $err_email = "Cette adresse mail est déjà utilisée.";
        $email ="";
        echo $err_email;
    }


    // CHECK PRENOM/NOM ------

    if (empty($prenom)) {
        $valid = false;
        $err_prenom = "Renseignez votre prénom.";
        echo $err_prenom;
    }

    elseif (!preg_match("#^[a-zA-Z]+$#", $prenom)) {
        $valid = false;
        $err_prenom ="Votre prénom ne doit pas contenir de chiffres ou de caractères spéciaux.";
        $prenom ="";
        echo $err_prenom;
    }

    if (empty($nom)) {
        $valid = false;
        $err_nom = "Renseignez votre nom.";
        echo $err_nom;
    }

    elseif (!preg_match("#^[a-zA-Z]+$#", $nom)) {
        $valid = false;
        $err_nom = "Votre nom ne doit pas contenir de chiffres ou de caractères spéciaux.";
        $nom ="";
        echo $err_nom;
    }

    // check mdp  ------

    if (empty($mdp)) {
        $valid = false;
        $err_mdp = "Renseignez votre mot de passe.";
        echo $err_mdp;
    }

    elseif (strlen($mdp)<8) {
        $valid = false;
        $err_mdp = "Le mot de passe doit être de 8 caractères minimum.";
        $mdp="";
        echo $err_mdp;
    }

    elseif (empty($mdpconfirm)) {
        $valid = false;
        $err_mdpconfirm = "Confirmez votre mot de passe.";
        echo $err_mdpconfirm;
    }

    elseif ($mdp !== $mdpconfirm) {
        $valid = false;
        $err_mdpconfirm = "Les mots de passe ne correspondent pas.";
        $mdpconfirm ="";
        echo $err_mdpconfirm;
    }

    // check pseudo

    if (empty($pseudo)) {
        $valid = false;
        $err_pseudo = "Renseignez votre pseudo.";
        echo $err_pseudo;
    }


    // check ville

    if (empty($ville)) {
        $valid = false;
        $err_ville ="Renseignez votre ville.";
        echo $err_ville;
    }

    elseif (!preg_match("#^[a-zA-Z]+$#", $ville)) {
        $valid = false;
        $err_ville = "Votre ville ne doit pas contenir de chiffres ou de caractères spéciaux.";
        $ville ="";
        echo $err_ville;
    }

    // check codepostal

    if (empty($code_postale)) {
        $valid = false;
        $err_code_postale ="Renseignez votre code postal.";
        echo $err_code_postale;
    }

    elseif (!preg_match ("~^[0-9]{5}$~",$code_postale)) {
        $valid = false;
        $code_postale ='';
        $err_code_postale = "Le code postal n'est pas au bon format";
        echo $err_code_postale;
    }

    // check adresse

    if (empty($adresse)) {
        $valid = false;
        $err_adresse ="Renseignez votre adresse..";
        echo $err_adresse;
    }


    if ($valid==true) {

        $data = [
            'pseudo'=>$pseudo,
            'mdp'=>$mdp,
            'nom'=>$nom,
            'prenom'=>$prenom,
            'email'=>$email,
            'ville'=>$ville,
            'code_postale'=>$code_postale,
            'adresse'=>$adresse,
            'statut'=>$statut,

        ];
        
        $query = " INSERT INTO membre (pseudo, mdp, nom, prenom, email, ville, code_postale, adresse, statut) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :ville, :code_postale, :adresse, :statut)";
        $insert = $bdd->prepare($query);
        $insert->execute($data);

        header('Location: connexion.php');

        
    }
}


?>   


<body>

<?php 
require_once('header.php');?>   
<link rel="stylesheet" href="style/inscription.css">

<main>

<h1 class="h1inscri">INSCRIPTION</h1>

    <div class="box-inscri">

            <form method ="post" action = "inscription.php" class="formito" >
            
                <div class="info">

                    <label>PRENOM</label>
                    <input type="text" name="prenom" placeholder='Adam' required>

                    <label>NOM</label> 
                    <input type="text" name="nom" placeholder='James' required>
                
                    <label>PSEUDO</label>
                    <input type="text" name="pseudo" placeholder='_Gustavo_' required>
              
                </div>


                <div class="connexion">

                    <label>EMAIL</label> 
                    <input type="email" name="email" placeholder='Adam@gmail.com' required>

                    <label>MOT DE PASSE</label> 
                    <input type="password" name="mdp" placeholder='*****' required>

                    <label>CONFIRMATION MOT DE PASSE</label> 
                    <input type="password" name="mdpconfirm" placeholder='*****' required>
               
                </div>


                <div class="adresse">

                    <label>ADRESSE</label> 
                    <input type="text" name="adresse" placeholder='36 rue des orfèvres' required>
                  
                    <label>CODE POSTALE</label> 
                    <input type="text" minlength="5" maxlength="5" name="code_postale" placeholder='75001' required>
                
                    <label>VILLE</label> 
                    <input  type="text" name="ville" placeholder='Paris' required>
                
                </div>

    </div>

            
                
                <div id="buttoncon"> <input class="inputinside" name="suscribe" type="submit" value="S'inscrire"> </div> 


                <div class="message">
                        <?php
                        echo "<p class='msg'>". $message. '</p>' ;
                        ?>
                        </div>

            </form>

</main>

<?php require_once('footer.php') ?>

<body>
</html>

