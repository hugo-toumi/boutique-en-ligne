<?php
require("init.inc.php");
require('header.php');





//--- AFFICHAGE DES CATEGORIES ---//

// $categories_des_produits = executeRequete("SELECT DISTINCT categorie FROM produit");
// $contenu .= '<div class="boutique-gauche">';
// $contenu .= "<ul>";
// while($cat = $categories_des_produits->fetch_assoc())
// {
//     $contenu .= "<li><a href='?categorie=" . $cat['categorie'] . "'>" . $cat['categorie'] . "</a></li>";
// }
// $contenu .= "</ul>";
// $contenu .= "</div>";


    

//--- AFFICHAGE DES PRODUITS ---//


if(isset($_GET['categorie']))
{
    $donnees = executeRequete("select id_produit,reference,categorie,sous_categorie,photo,titre,description,prix,stock from produit where categorie='$_GET[categorie]'");  
    while($produit = $donnees->fetch_assoc())
    {
      
        $contenu .= "<h2>$produit[titre]</h2>";
        $contenu .= "<a href=\"fiche_produit.php?id_produit=$produit[id_produit]\"><img src=\"$produit[photo]\" =\"130\" height=\"100\"></a>";
        $contenu .= "<p>$produit[prix] €</p>";
        $contenu .= '<a href="fiche_produit.php?id_produit=' . $produit['id_produit'] . '">Voir la fiche</a>';
 
    }
}


?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique</title>
    <link rel="stylesheet" href="style/boutique.css">
</head>
<body>

<?php echo $contenu;?>

    <div class="icons">

  

        <a href="?categorie=Playstation"><img id="play" src="https://img.icons8.com/color/160/000000/play-station.png" alt="Playstation"/></a>
        <a href="?categorie=Xbox"><img id="xbox" src="https://img.icons8.com/fluency/160/000000/xbox.png" alt="Xbox"/></a>
        <a href="?categorie=Pc"><img id="pc" src="https://img.icons8.com/external-xnimrodx-lineal-color-xnimrodx/160/000000/external-pc-computer-xnimrodx-lineal-color-xnimrodx.png" alt="PC"/></a>
        <a href="?categorie=Nintendo"><img id="nintendo" src="https://img.icons8.com/fluency/160/000000/nintendo-switch.png" alt="Nintendo"/></a>
        
    </div>


    
</body>
</html>


<?php
require('footer.php');
?>