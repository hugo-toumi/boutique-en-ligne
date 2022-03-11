<?php

$id_produit = 0;
$update = false;
$reference = '';
$categorie = '';
$sous_categorie = '';
$photo = '';
$titre = '';
$description = '';
$taille = '';
$prix = '';
$stock = '';
require('connect.php');

if (isset($_POST['save'])) {
    $reference = $_POST['reference'];
    $categorie = $_POST['categorie'];
    $sous_categorie = $_POST['sous_categorie'];
    $photo = $_POST['photo'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $taille = $_POST['taille'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];
    $mysqli = new mysqli('localhost', 'root', '', 'boutique-en-ligne');
    $mysqli->query("INSERT INTO produit (id_produit, reference, categorie, sous_categorie, photo, titre, description, taille, prix, stock) VALUES('$id_produit', '$reference', '$categorie', '$sous_categorie', '$photo','$titre','$description', '$taille', '$prix', '$stock')");

    $_SESSION['message'] = "Le compte est enregistré";
    $_SESSION['msg_type'] = "success";

    header("location: adminprod.php");
}

if (isset($_GET['delete'])) {
    $id_produit = $_GET['delete'];
    $mysqli = new mysqli('localhost', 'root', '', 'boutique-en-ligne');
    $mysqli->query("DELETE FROM produit WHERE id_produit = $id_produit");

    $_SESSION['message'] = "Le compte est bel et bien supprimé";
    $_SESSION['msg_type'] = "danger";

    header("location: adminprod.php");
}

if (isset($_GET['edit'])) {
    $id_produit = $_GET['edit'];
    $update = true;
    $mysqli = new mysqli('localhost', 'root', '', 'boutique-en-ligne');
    $result = $mysqli->query("SELECT * FROM produit WHERE id_produit = $id_produit");

    $row = $result->fetch_array();
    $reference = $row['reference'];
    $categorie = $row['categorie'];
    $sous_categorie = $row['sous_categorie'];
    $photo = $row['photo'];
    $titre = $row['titre'];
    $description = $row['description'];
    $taille = $row['taille'];
    $prix = $row['prix'];
    $stock = $row['stock'];
}


if (isset($_POST['update'])) {
    $id_produit = $_POST['id_produit'];
    $reference = $_POST['reference'];
    $categorie = $_POST['categorie'];
    $sous_categorie = $_POST['sous_categorie'];
    $photo = $_POST['photo'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $taille = $_POST['taille'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];
    $mysqli = new mysqli('localhost', 'root', '', 'boutique-en-ligne');
    $mysqli->query("UPDATE produit SET reference='$reference', categorie='$categorie', sous_categorie='$sous_categorie', photo='$photo', titre='$titre', description='$description', taille= '$taille', prix= '$prix', stock= '$stock' WHERE id_produit=$id_produit");

    $_SESSION['message'] = "Les infos sont belles est bien modifiées";
    $_SESSION['msg_type'] = "warning";

    header('location: adminprod.php');
}

