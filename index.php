<body>
<?php
require_once('header.php') ?>
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

            <img src="img/bo2.jpg" alt="Call of Duty Black Ops 2">
            <a href="http://localhost:8888/boutique-en-ligne/fiche_produit.php?id_produit=4"><img src="img/gta5.jpg" alt="Grand Theft Auto V"></a>
            <a href="http://localhost:8888/boutique-en-ligne/fiche_produit.php?id_produit=7"><img src="img/Mario.jpg" alt="Mario Kart 8 Deluxe"></a>
            <img src="img/RD.jpg" alt="Red Dead Dedemption 2">

        </div>

        <div class="jeuxbas">

            <img src="img/Crash.jpg" alt="Crash Bandicoot 4 It's About Time">
            <img src="img/Csgo.png" alt="Counter-Strike Global Offensive">
            <img src="img/Blackops.jpg" alt="Call of Duty Black Ops 2">
            <img src="img/AS.jpg" alt="Assassin Screed Brotherhood">

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

                <img src="img/Fifa.jpg" alt="Fifa 22">
                <img src="img/Call of Vanguard.jpg" alt="Call of Duty Vanguard">
                <img src="img/Forza.jpg" alt="Forza Horizon 5">
                <img src="img/battefield.jpg" alt="Battelfield 2042">

            </div>

            
<!-- ANIMATION CARTE -->

		

</main>


<?php require_once('footer.php') ?>

</body>
</html>


