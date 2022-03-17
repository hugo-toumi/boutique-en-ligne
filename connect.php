<?php    

// Quand je veux passer d'une base de données à l'autre je passe par ce fichier --> "connect.php" 


// // MA BASE PLESK
// $bdd = mysqli_connect('localhost', 'yanis-khiter', 'Yanis13030', 'yanis-khiter_blog'); 
// mysqli_set_charset($bdd , 'utf8');

// // MA BASE LOCALE
// $bdd = mysqli_connect('localhost', 'root', '', 'boutique-en-ligne'); 
// mysqli_set_charset($bdd , 'utf8');
// ?>  



<?php

$bdd = new PDO('mysql:host=localhost;dbname=boutique-en-ligne;charset=utf8', 'root','');

?>