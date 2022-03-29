<?php

include 'connect.php' ;


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


    // EMAIL

    $reqmail = $bdd->prepare("SELECT * FROM membre WHERE email =:email");
    $reqmail->setFetchMode(PDO::FETCH_ASSOC);
    $reqmail->execute(['email'=>$email]);

    $resultmail = $reqmail->fetch();

    if (empty($email)) {
        $valid=false;
        $err_email = "Renseignez l'email.";
    }

    elseif(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $valid=false;
        $err_email = "Votre email n'est pas au bon format";
        $email="";
    }

    elseif ($resultmail) {
        $valid = false;
        $err_email = "Cette adresse mail est déjà utilisée.";
        $email ="";
    }


    // PRENOM

    if (empty($prenom)) {
        $valid = false;
        $err_prenom = "Renseignez votre prénom.";
    }

    elseif (!preg_match("#^[a-zA-Z]+$#", $prenom)) {
        $valid = false;
        $err_prenom ="Votre prénom ne doit pas contenir de chiffres ou de caractères spéciaux.";
        $prenom ="";
    }


     // NOM

    if (empty($nom)) {
        $valid = false;
        $err_nom = "Renseignez votre nom.";
    }

    elseif (!preg_match("#^[a-zA-Z]+$#", $nom)) {
        $valid = false;
        $err_nom = "Votre nom ne doit pas contenir de chiffres ou de caractères spéciaux.";
        $nom ="";
    }


    // ! MOT DE PASSE

    if (empty($mdp)) {
        $valid = false;
        $err_mdp = "Renseignez votre mot de passe.";
    } elseif (strlen($mdp)<8) {
        $valid = false;
        $err_mdp = "Le mot de passe doit être de 8 caractères minimum.";
        $mdp="";
    } elseif (empty($mdpconfirm)) {
        $valid = false;
        $err_mdpconfirm = "Confirmez votre mot de passe.";
    } elseif ($mdp !== $mdpconfirm) {
        $valid = false;
        $err_mdpconfirm = "Les mots de passe ne sont pas identiques.";
        $mdpconfirm ="";
    } else {
        $mdp = password_hash($mdp, PASSWORD_DEFAULT);
    }

    // PSEUDO

    if (empty($pseudo)) {
        $valid = false;
        $err_pseudo = "Renseignez votre pseudo.";
    }


    // VILLE

    if (empty($ville)) {
        $valid = false;
        $err_ville ="Renseignez votre ville.";
    }

    elseif (!preg_match("#^[a-zA-Z]+$#", $ville)) {
        $valid = false;
        $err_ville = "Votre ville ne doit pas contenir de chiffres ou de caractères spéciaux.";
        $ville ="";
    }


    // CODE POSTALE

    if (empty($code_postale)) {
        $valid = false;
        $err_code_postale ="Renseignez votre code postal.";
    }

    elseif (!preg_match ("~^[0-9]{5}$~",$code_postale)) {
        $valid = false;
        $code_postale ='';
        $err_code_postale = "Le code postal n'est pas au bon format.";
    }


    // ADRESSE

    if (empty($adresse)) {
        $valid = false;
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

        header('Location: connexion.php?succes=true');   
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
                    <?php if (isset($err_prenom)) {echo "<div class='error'> $err_prenom</div>";}?>
                    <input type="text" name="prenom" placeholder='Adam' required>

                    <label>NOM</label> 
                    <?php if (isset($err_nom)) {echo "<div class='error'> $err_nom</div>";}?>
                    <input type="text" name="nom" placeholder='James' required>
                
                    <label>PSEUDO</label>
                    <?php if (isset($err_pseudo)) {echo "<div class='error'> $err_pseudo</div>";}?>
                    <input type="text" name="pseudo" placeholder='_Gustavo_' required>
              
                </div>


                <div class="connexion">

                    <label>EMAIL</label>
                    <?php if (isset($err_email)) {echo "<div class='error'> $err_email</div>";}?> 
                    <input type="email" name="email" placeholder='Adam@gmail.com' required>

                    <label>MOT DE PASSE</label> 
                    <?php if (isset($err_mdp)) {echo "<div class='error'> $err_mdp</div>";}?>
                    <input type="password" name="mdp" placeholder='*****' required>

                    <label>CONFIRMATION MOT DE PASSE</label> 
                    <?php if (isset($err_mdpconfirm)) {echo "<div class='error'> $err_mdpconfirm</div>";}?>
                    <input type="password" name="mdpconfirm" placeholder='*****' required>
               
                </div>


                <div class="adresse">

                    <label>ADRESSE</label>
                    <?php if (isset($err_adresse)) {echo "<div class='error'> $err_adresse</div>";}?> 
                    <input type="text" name="adresse" placeholder='36 rue des orfèvres' required>
                  
                    <label>CODE POSTALE</label> 
                    <?php if (isset($err_code_postale)) {echo "<div class='error'> $err_code_postale</div>";}?>
                    <input type="text" minlength="5" maxlength="5" name="code_postale" placeholder='75001' required>
                
                    <label>VILLE</label> 
                    <?php if (isset($err_ville)) {echo "<div class='error'> $err_ville</div>";}?>
                    <input  type="text" name="ville" placeholder='Paris' required>
                
                </div>

    </div>

                <div id="buttoncon"> <input class="inputinside" name="suscribe" type="submit" value="S'inscrire"> </div> 

            </form>

</main>

<?php require_once('footer.php') ?>

<body>
</html>