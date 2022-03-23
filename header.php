
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameLand.fr</title>
    <link rel="stylesheet" href="style/header.css">

    <script src="https://kit.fontawesome.com/736e958a4d.js" crossorigin="anonymous"></script>
</head>

<body>
                    <!-- HEADER LOGO GAUCHE + FONCTIONNALITE DROITE -->
    <header>

    <a href="index.php"> <img  class="logo" src="img/GM.png" alt="Logo Gameland"></a>

        

                    <!-- BARRE DE RECHERCHE -->


        <div class="searchBox">

            <input class="searchInput"  placeholder="Recherche ...">
            
                <button class="searchButton" href="#">
                <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                
        </div>

     

                        <!-- Quand je suis connecté -->
                

               <?php if(isset($_SESSION['id_membre'])):?> 

                        <li class="lidroite"><i class="fa-solid fa-right-from-bracket" style="color:red"></i> <!-- Icon DECONNEXION-->
                        <a class="deco" href="deconnexion.php">DÉCONNEXION</a></li>

                <div class="connect">

                        <ul>

                            <li class="lidroite"><i class="fa-solid fa-user" style="color:#0DA5E6"></i>  <!-- Icon USER-->
                            <a href="profil.php">MON PROFIL</a></li>

                            <li class="lidroite"><i class="fa-solid fa-feather-pointed" style="color:#0DA5E6"></i> <!-- Icon PLUME-->
                            <a href="histoire.php">NOTRE HISTOIRE</a></li>

                            <li class="lidroite"><i class="fa-solid fa-cart-shopping" style="color:#0DA5E6"></i> <!-- Icon PANIER-->
                            <a href="panier.php">PANIER</a></li>


                        </ul>

                </div>


                <?php else :?>
            

                        // ! Quand je ne suis pas connecté

                <div class="noconnect">

                        <ul>

                            <li class="lidroite"><i class="fa-solid fa-user" style="color:#0DA5E6"></i>  <!-- Icon USER-->
                            <a href="inscription.php">INSCRIPTION | </a><a href="connexion.php">CONNEXION</a></li>

                            <li class="lidroite"><i class="fa-solid fa-feather-pointed" style="color:#0DA5E6"></i> <!-- Icon PLUME-->
                            <a href="histoire.php">NOTRE HISTOIRE</a></li>

                            <li class="lidroite"><i class="fa-solid fa-cart-shopping" style="color:#0DA5E6"></i> <!-- Icon PANIER-->
                            <a href="panier.php">PANIER</a></li>

                        </ul>

                </div>


                <?php endif ?>

    </header>


    <nav class="navcons">
            <div class="consoles"> 
               
                <p class="pcons">Playstation</p><img class="imageconsole" src="https://img.icons8.com/color/48/000000/play-station.png"/> <!-- Icon PLAYSTATION-->
                
                <p class="pcons">Xbox</p><img class="imageconsole" src="https://img.icons8.com/fluency/48/000000/xbox.png"/><!-- Icon XBOX-->

                <p class="pcons">PC</p><img class="imageconsole" src="https://img.icons8.com/external-xnimrodx-lineal-color-xnimrodx/64/000000/external-pc-computer-xnimrodx-lineal-color-xnimrodx.png"/><!-- Icon PC-->
            
                <p class="pcons">Nintendo</p><img class="imageconsole" src="https://img.icons8.com/fluency/48/000000/nintendo-switch.png"/><!-- Icon NINTENDO -->

            </div>
        </nav>

</body>
</html>



<!-- PHP PARTIE DROITE HEADER -->

    <!-- <?php
 
        if(isset(  $_SESSION['userconnect'])) {
            echo '<li><a href="deconnexion.php">Déconnexion</a></li>';
            echo ' <li><a href="histoire.php">Notre histoire</a></li>';
            echo '<li><a href="panier.php">Panier</a></li>';
            


        } else {
            echo '<li><a href="inscription.php">Inscription</a></li>';
            echo '<li><a href="connexion.php">Connexion</a></li>';
            echo '<li><a href="histoire.php">Notre Histoire</a></li>';
            echo '<li><a href="panier.php">Panier</a></li>';
        }

    ?> -->





	











