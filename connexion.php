<?php require_once("init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(isset($_GET['action']) && $_GET['action'] == "deconnexion")
{
    session_destroy();
}
if(internauteEstConnecte())
{
    header("location:profil.php");
}
if($_POST)
{
    // $contenu .=  "pseudo : " . $_POST['pseudo'] . "<br>mdp : " .  $_POST['mdp'] . "";
    $resultat = executeRequete("SELECT * FROM membre WHERE pseudo='$_POST[pseudo]'");
    if($resultat->num_rows != 0)
    {
        // $contenu .=  '<div style="background:green">pseudo connu!</div>';
        $membre = $resultat->fetch_assoc();
        if($membre['mdp'] == $_POST['mdp'])
        {
            //$contenu .= '<div class="validation">mdp connu!</div>';
            foreach($membre as $indice => $element)
            {
                if($indice != 'mdp')
                {
                    $_SESSION['id_membre'][$indice] = $element;
                }
            }
            header("location:profil.php");
        }
        else
        {
            $contenu .= '<div class="erreur">Erreur de MDP</div>';
        }       
    }
    else
    {
        $contenu .= '<div class="erreur">Erreur de pseudo</div>';
    }
}
//--------------------------------- AFFICHAGE HTML ---------------------------------//
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

            <label>Pseudo</label>
            <input type="pseudo" name="pseudo" placeholder='Entrez votre Pseudo'>

            <label>MOT DE PASSE </label>
            <input type="password" name="mdp" placeholder='*****'>
        </div>

        <div id="buttoncon"> <input class="inputinside" type="submit" name="connexion" value="Se connecter"> </div>


    </form>

</main>

<?php require_once('footer.php') ?>


<body>