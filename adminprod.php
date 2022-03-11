<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Crud membre</title>
</head>

<body>

    

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="adminprod.php">Admin Produit</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="admin.php" target="_blank">Admin <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>


    <?php require_once('process_prod.php'); ?>

    <?php

    if (isset($_SESSION['message'])) : ?>

        <div class="alert alert-<?= $_SESSION['msg_type'] ?>">

            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>

        </div>

    <?php endif ?>

    <div class="container-fluid">
        <?php $mysqli = new mysqli('localhost', 'root', '', 'boutique-en-ligne')or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM produit") or die(mysqli_error($mysqli));
        ?>

        <div class="row justify-content-center">

            <table class="table">
                <thead>
                    <tr>
                        <th>id_produit</th>
                        <th>reference</th>
                        <th>categorie</th>
                        <th>sous_categorie</th>
                        <th>photo</th>
                        <th>titre</th>
                        <th>description</th>
                        <th>taille</th>
                        <th>prix</th>
                        <th>stock</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>

                <?php

                while ($row = $result->fetch_assoc()) : ?>

                    <tr>
                        <td><?php echo $row['id_produit']; ?></td>
                        <td><?php echo $row['reference']; ?></td>
                        <td><?php echo $row['categorie']; ?></td>
                        <td><?php echo $row['sous_categorie']; ?></td>
                        <td><?php echo $row['photo']; ?></td>
                        <td><?php echo $row['titre']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['taille']; ?></td>
                        <td><?php echo $row['prix']; ?></td>
                        <td><?php echo $row['stock']; ?></td>
                    

                        <td>
                            <a href="adminprod.php?edit=<?php echo $row['id_produit']; ?>" class="btn btn-info">Modifier</a>
                            <a href="adminprod.php?delete=<?php echo $row['id_produit']; ?>" class="btn btn-danger">Supprimer</a>
                        </td>

                    </tr>


                <?php endwhile; ?>

            </table>

        </div>

        <?php

        function pre_r($array)
        {
            echo '<pre>';
            print_r($array);
            echo '<pre>';
        }
        ?>
        <div class="row justify-content-center">
            <form action="process_prod.php" method="POST">
                <input type="hidden" name="id_produit" value="<?php echo $id_produit; ?>">
                <div class="form-group">
                    <label>Reference</label>
                    <input type="text" name="reference" class="form-control" value="<?php echo $reference; ?>" placeholder="Entrez votre pseudo">
                </div>
                <div class="form-group">
                    <label>Categorie</label>
                    <input type="text" name="categorie" class="form-control" value="<?php echo $categorie; ?>" placeholder="Entrez votre pseudo">
                </div>

                <div class="form-group">
                    <label>Sous Categorie</label>
                    <input type="text" name="sous_categorie" class="form-control" value="<?php echo $sous_categorie; ?>" placeholder="Entrez votre sous categorie">
                </div>

                <div class="form-group">
                    <label>Photo</label>
                    <input type="text" name="photo" class="form-control" value="<?php echo $photo; ?>" placeholder="Entrez le lien de la photo">
                </div>
        
                <div class="form-group">
                    <label>Titre</label>
                    <input type="text" name="titre" class="form-control" value="<?php echo $titre; ?>" placeholder="Entrez votre nom">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description" value="<?php echo $description; ?>" class="form-control" placeholder="Entrez votre prenom">
                </div>
                <div class="form-group">
                    <label>Taille</label>
                    <input type="text" name="taille" value="<?php echo $taille; ?>" class="form-control" placeholder="Entrez votre email">
                </div>
                <div class="form-group">
                    <label>Prix</label>
                    <input type="text" name="prix" value="<?php echo $prix; ?>" class="form-control" placeholder="Entrez votre civilite m ou f">
                </div>
                <div class="form-group">
                    <label>Stock</label>
                    <input type="text" name="stock" value="<?php echo $stock; ?>" class="form-control" placeholder="Entrez votre ville">
                </div>


                <div class="form-group">
                    <?php
                    if ($update == true) :
                    ?>
                        <button type="submit" class="btn btn-info" name="update">Update</button>
                    <?php else : ?>

                        <button type="submit" class="btn btn-primary" name="save">Save</button>

                    <?php endif; ?>
                </div>
        </div>
        </form>
    </div>
    </div>
</body>
</html>
