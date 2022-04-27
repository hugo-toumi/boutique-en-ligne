<body>
<?php
require('init.inc.php');
require('header.php'); ?>
<link rel="stylesheet" href="style/index.css">



<main>


<?php
            if(isSet($_GET['succes']) && $_GET['succes']) {
        ?>
            <div class="success">Vous êtes connecté(e) ! Bonne navigation !</div>
        <?php
            } 
        ?>

        <!-- Carousel -->

    <div class="contenu_carou_auto">
        <div class="caroussel-image">

            <img src="img-carrou/Forbidden-carrou.jpg" alt="Horizon Forbidden West">
            <img src="img-carrou/assassin-carrou.jpeg" alt="Assassin Screed Brotherhood">
            <img src="img-carrou/battle-carrou.jpg" alt="Battlefield 2042">
            <img src="img-carrou/bo2-carrou.jpg" alt="Call of Duty Black Ops 2">
            <img src="img-carrou/crash-carrou.jpg" alt="Crash Bandicoot 4 It's About Time">
            <img src="img-carrou/rd2-carrou.jpg" alt="Red Dead Dedemption 2">
            <img src="img-carrou/Gta5-carrou.jpg" alt="Grand Theft Auto V">
            <img src="img-carrou/mario-carrou.jpg" alt="Mario Kart 8 Deluxe">

        </div>
    </div>


    <h1 class="h1jeux">LES JEUX ICONIQUES</h1>


        <div class="jeuxhaut">

            <a href="http://localhost/Gameland/fiche_produit.php?id_produit=1"><img id="bo2" src="img/bo2.jpg" alt="Call of Duty Black Ops 2"></a>
            <a href="http://localhost/Gameland/fiche_produit.php?id_produit=2"><img id="gta" src="img/gta5.jpg" alt="Grand Theft Auto V"></a>
            <a href="http://localhost/Gameland/fiche_produit.php?id_produit=3"><img id="mario" src="img/Mario.jpg" alt="Mario Kart 8 Deluxe"></a>
            <a href="http://localhost/Gameland/fiche_produit.php?id_produit=4"><img id="red" src="img/RD.jpg" alt="Red Dead Dedemption 2"></a>

        </div>

        <div class="jeuxbas">

            <a href="http://localhost/Gameland/fiche_produit.php?id_produit=5"><img id="crash" src="img/Crash.jpg" alt="Crash Bandicoot 4 It's About Time"></a>
            <a href="http://localhost/Gameland/fiche_produit.php?id_produit=6"><img id="cs" src="img/Csgo.png" alt="Counter-Strike Global Offensive"></a>
            <a href="http://localhost/Gameland/fiche_produit.php?id_produit=7"><img id="callof2" src="img/Blackops.jpg" alt="Call of Duty Black Ops 2"></a>
            <a href="http://localhost/Gameland/fiche_produit.php?id_produit=8"><img id="assassin" src="img/AS.jpg" alt="Assassin Screed Brotherhood"></a>

        </div>


    <h1 class="h1abo">LES CARTES PRÉPAYÉES</h1>

        <div class="abonnements">

            <div class="image">

                <img src="img/ab-psn.jpeg" alt="Carte PSN">
                <img src="img/ab-xboxlive.jpg" alt="Carte XBOX-LIVE">
                <img src="img/ab-steam.png" alt="Carte STEAM">
                <img src="img/ab-nintendo.jpg" alt="Carte NINTENDO">

            </div>

        </div>

            
    <h1 class="h1jdm">LES JEUX DU MOMENTS</h1>

            <div class="lesjdm">

            <a href="http://localhost/Gameland/fiche_produit.php?id_produit=9"><img id="fifa" src="img/Fifa.jpg" alt="Fifa 22"></a>
            <a href="http://localhost/Gameland/fiche_produit.php?id_produit=10"><img id="callof" src="img/Call of Vanguard.jpg" alt="Call of Duty Vanguard"></a>
            <a href="http://localhost/Gameland/fiche_produit.php?id_produit=11"><img id="forza" src="img/Forza.jpg" alt="Forza Horizon 5"></a>
            <a href="http://localhost/Gameland/fiche_produit.php?id_produit=12"><img id="batte" src="img/battefield.jpg" alt="Battelfield 2042"></a>

            </div>

</main>


<?php require_once('footer.php') ?>

</body>
</html>


