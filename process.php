<?php

$id_membre = 0;
$update = false;
$pseudo = '';
$mdp = '';
$nom = '';
$prenom = '';
$email= '';
$ville = '';
$code_postale = '';
$adresse = '';
$statut = '';
require('connect.php');

if (isset($_POST['save'])) {
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $ville = $_POST['ville'];
    $code_postale = $_POST['code_postale'];
    $adresse = $_POST['adresse'];
    $statut = $_POST['statut'];

    $mysqli = new mysqli('localhost', 'root', '', 'boutique-en-ligne');
    $mysqli->query("INSERT INTO membre  (id_membre, pseudo, mdp, nom, prenom, email, ville, code_postale, adresse, statut) VALUES('$id_membre', '$pseudo', '$mdp','$nom','$prenom', '$email', '$ville', '$code_postale', '$adresse', '$statut')");

    $_SESSION['message'] = "Le compte est enregistré";
    $_SESSION['msg_type'] = "success";

    header("location: admin.php");
}

if (isset($_GET['delete'])) {
    $id_membre = $_GET['delete'];
    $mysqli = new mysqli('localhost', 'root', '', 'boutique-en-ligne');
    $mysqli->query("DELETE FROM membre WHERE id_membre=$id_membre");

    $_SESSION['message'] = "Le compte est bel et bien supprimé";
    $_SESSION['msg_type'] = "danger";

    header("location: admin.php");
}

if (isset($_GET['edit'])) {
    $id_membre = $_GET['edit'];
    $update = true;
    $mysqli = new mysqli('localhost', 'root', '', 'boutique-en-ligne');
    $result = $mysqli->query("SELECT * FROM membre WHERE id_membre=$id_membre");

    $row = $result->fetch_array();
    $pseudo = $row['pseudo'];
    $mdp = $row['mdp'];
    $nom= $row['nom'];
    $prenom = $row['prenom'];
    $email = $row['email'];
    $ville = $row['ville'];
    $code_postale = $row['code_postale'];
    $adresse = $row['adresse'];
    $statut = $row['statut'];
}


if (isset($_POST['update'])) {
    $id_membre = $_POST['id_membre'];
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];
    $nom= $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $ville = $_POST['ville'];
    $code_postale = $_POST['code_postale'];
    $adresse = $_POST['adresse'];
    $statut = $_POST['statut'];
    $mysqli = new mysqli('localhost', 'root', '', 'boutique-en-ligne');
    $mysqli->query("UPDATE membre SET pseudo='$pseudo', mdp='$mdp', nom='$nom', prenom='$prenom', email= '$email', ville= '$ville', code_postale= '$code_postale', adresse= '$adresse', statut= '$statut' WHERE id_membre=$id_membre");

    $_SESSION['message'] = "Les infos sont belles est bien modifiées";
    $_SESSION['msg_type'] = "warning";

    header('location: admin.php');
}