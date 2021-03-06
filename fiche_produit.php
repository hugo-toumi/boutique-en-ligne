<?php

require_once("init.inc.php");
require('header.php');

if(isset($_GET['id_produit']))  { $resultat = executeRequete("SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]'"); }
if($resultat->num_rows <= 0) { header("location:boutique.php"); exit(); }
 

$h1 = "";
$contenu1 = "";
$image= "";
$description = "";
$prix ="";
$quantite= "";
$panier= "";
$select= "";
$option="";
$stock="";




$produit = $resultat->fetch_assoc();
$h1 .= "<h1 class='titre-jeu'>$produit[titre]</h1><br>";

?>

        <?php
            $contenu1 .= "<h3 class='console'> $produit[categorie]<h3>";
            $contenu1 .= "<h3 class='souscat'>$produit[sous_categorie]</h3>";
            $contenu1 .= "<h3 class='giga'>$produit[taille]</h3>";
      
            $image .= "<img class='imagegta'src='$produit[photo]'>";
            $description .= "<h3 class ='description'>  $produit[description]</h3><br>";

            $prix .= "<h3 class ='prix'> Prix : $produit[prix] €</h3><br>";

    
            if($produit['stock'] > 0)
            {
                $stock .= "<i>Nombre d'produit(s) disponible : $produit[stock] </i><br><br>";
                $contenu .= '<form method="post" action="panier.php">';
                    $contenu .= "<input type='hidden' name='id_produit' value='$produit[id_produit]'>";
                    $quantite .= '<label for="quantite">Quantité : </label>';
                    $contenu .= '<select id="quantite" name="quantite">';
                        for($i = 1; $i <= $produit['stock'] && $i <= 5; $i++)
                        {
                            $contenu .= "<option>$i</option>";
                        }
                    $contenu .= '</select>';
                    $contenu .= '<input type="submit" class="panier" name="ajout_panier" value="Ajouter au panier">';
                $contenu .= '</form>';
            }
            else
            {
                $contenu .= 'Rupture de stock !';
            }
            $contenu .= "<br><a href='boutique.php?categorie=" . $produit['categorie'] . "'>Retour vers la séléction de " . $produit['categorie'] . "</a>";


//--------------------------------- AFFICHAGE HTML ---------------------------------//

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche produit</title>
    <link rel="stylesheet" href="style/fiche_produit.css">
</head>
<body>
    
<!-- JEUX ICONIQUE -->

        <?php echo $h1 ;?>

        <div class="trois">
            <?php echo $contenu1 ;?>
        </div>

        <div class="imgdescri">
            <?php  echo $image ; echo $description ; ?>
        </div>

        <div class="prix">
            <?php echo $prix ;?>
        </div>

        <div class="quantite-select-option">
            <?php echo $quantite ; echo $select ; echo $option ; ?>
        </div>

        
        <div class="stock">
            <?php echo $stock ;?>
        </div>

<!-- JEUX DU MOMENTS -->


</body>
</html>

<?php 
echo $contenu;
require('footer.php');
?>