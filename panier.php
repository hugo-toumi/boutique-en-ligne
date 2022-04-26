<?php
require_once("init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//

//--- AJOUT PANIER ---//
if(isset($_POST['ajout_panier'])) 
{   // debug($_POST);
    $resultat = executeRequete("SELECT * FROM produit WHERE id_produit='$_POST[id_produit]'");
    $produit = $resultat->fetch_assoc();
    ajouterProduitDansPanier($produit['titre'],$_POST['id_produit'],$_POST['quantite'],$produit['prix']);
}
//--- VIDER PANIER ---//
if(isset($_GET['action']) && $_GET['action'] == "vider")
{
    unset($_SESSION['panier']);
}
//--- PAIEMENT ---//
if(isset($_POST['payer']))
{
    for($i=0 ;$i < count($_SESSION['panier']['id_produit']) ; $i++) 
    {
        $resultat = executeRequete("SELECT * FROM produit WHERE id_produit=" . $_SESSION['panier']['id_produit'][$i]);
        $produit = $resultat->fetch_assoc();
        if($produit['stock'] < $_SESSION['panier']['quantite'][$i])
        {
            $contenu .= '<hr><div class="erreur">Stock Restant: ' . $produit['stock'] . '</div>';
            $contenu .= '<div class="erreur">Quantité demandée: ' . $_SESSION['panier']['quantite'][$i] . '</div>';
            if($produit['stock'] > 0)
            {
                $contenu .= '<div class="erreur">la quantité de l\'produit ' . $_SESSION['panier']['id_produit'][$i] . ' à été réduite car notre stock était insuffisant, veuillez vérifier vos achats.</div>';
                $_SESSION['panier']['quantite'][$i] = $produit['stock'];
            }
            else
            {
                $contenu .= '<div class="erreur">l\'produit ' . $_SESSION['panier']['id_produit'][$i] . ' à été retiré de votre panier car nous sommes en rupture de stock, veuillez vérifier vos achats.</div>';
                retirerProduitDuPanier($_SESSION['panier']['id_produit'][$i]);
                $i--;
            }
            $erreur = true;
        }
    }
    if(!isset($erreur))
    {
        executeRequete("INSERT INTO commande (id_membre, montant, date_enregistrement) VALUES (" . $_SESSION['id_membre'] . "," . montantTotal() . ", NOW())");
    
        $id_commande = $mysqli->insert_id;
        for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
        {
            executeRequete("INSERT INTO details_commande (id_commande, id_produit, quantite, prix) VALUES ($id_commande, " . $_SESSION['panier']['id_produit'][$i] . "," . $_SESSION['panier']['quantite'][$i] . "," . $_SESSION['panier']['prix'][$i] . ")");
        }
        unset($_SESSION['panier']);
        $contenu .= "<div class='validation'>Merci pour votre commande. votre n° de suivi est le $id_commande</div>";
    }
}
 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="style/panier.css">
    <title>GameLand.fr</title>
</head>
<body>
<?php include("header.php");?>

<div class="cart_section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="cart_container">
                    <div class="cart_title">Votre Panier<small></small></div>
                    <div class="cart_items">
                        <ul class="cart_list">
                            <li class="cart_item clearfix">
                                <div class="cart_item_image"><img src="img/GM.png"alt=""></div>
                                <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                    <div class="cart_item_name cart_info_col">
                                        <div class="cart_item_title"></div>
                                        <div class="cart_item_text"><?php  
                                        echo $contenu;
                                        echo "<table>";
                                        echo "<tr><th>Titre</th><th>Produit</th><th>Quantité</th><th>Prix Unitaire</th></tr>";
                                        if(empty($_SESSION['panier']['id_produit'])) // panier vide
                                        {
                                            echo "<tr><td colspan='5'>Votre panier est vide</td></tr>";
                                        }
                                        else
                                        {
                                            for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++) 
                                            {
                                                echo "<tr>";
                                                echo "<td>" . $_SESSION['panier']['titre'][$i] . "</td>";
                                                echo "<td>" . $_SESSION['panier']['id_produit'][$i] . "</td>";
                                                echo "<td>" . $_SESSION['panier']['quantite'][$i] . "</td>";
                                                echo "<td>" . $_SESSION['panier']['prix'][$i] . "</td>";
                                                echo "</tr>";
                                            }
                                            echo "<tr><th colspan='3'>Total</th><td colspan='2'>" . montantTotal() . " euros</td></tr>";
                                            if(internauteEstConnecte()) 
                                            {
                                                echo '<form method="post" action="">';
                                                echo '<tr><td colspan="5"><input type="submit" name="payer" value="Valider et déclarer le paiement"></td></tr>';
                                                echo '</form>';   
                                            }
                                            else
                                            {
                                                echo '<tr><td colspan="3">Veuillez vous <a href="inscription.php">inscrire</a> ou vous <a href="connexion.php">connecter</a> afin de pouvoir payer</td></tr>';
                                            }
                                            echo "<tr><td colspan='5'><a href='?action=vider'>Vider mon panier</a></td></tr>";
                                        }
                         echo "</table><br>";
                        // echo "<hr>session panier:<br>"; debug($_SESSION);                 
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php");?>
</body>
</html>