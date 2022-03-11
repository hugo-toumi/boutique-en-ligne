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
        <a class="navbar-brand" href="admin.php">Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="adminprod.php" target="_blank"> Admin Produit <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>


    <?php require_once('process.php'); ?>

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
        $result = $mysqli->query("SELECT * FROM membre") or die(mysqli_error($mysqli));
        ?>

        <div class="row justify-content-center">

            <table class="table">
                <thead>
                    <tr>
                        <th>id_membre</th>
                        <th>pseudo</th>
                        <th>mdp</th>
                        <th>nom</th>
                        <th>prenom</th>
                        <th>email</th>
                        <th>civilite</th>
                        <th>ville</th>
                        <th>code_postale</th>
                        <th>adresse</th>
                        <th>statut</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>

                <?php

                while ($row = $result->fetch_assoc()) : ?>

                    <tr>
                        <td><?php echo $row['id_membre']; ?></td>
                        <td><?php echo $row['pseudo']; ?></td>
                        <td><?php echo $row['mdp']; ?></td>
                        <td><?php echo $row['nom']; ?></td>
                        <td><?php echo $row['prenom']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['civilite']; ?></td>
                        <td><?php echo $row['ville']; ?></td>
                        <td><?php echo $row['code_postale']; ?></td>
                        <td><?php echo $row['adresse']; ?></td>
                        <td><?php echo $row['statut']; ?></td>
                    

                        <td>
                            <a href="admin.php?edit=<?php echo $row['id_membre']; ?>" class="btn btn-info">Modifier</a>
                            <a href="admin.php?delete=<?php echo $row['id_membre']; ?>" class="btn btn-danger">Supprimer</a>
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
            <form action="process.php" method="POST">
                <input type="hidden" name="id_membre" value="<?php echo $id_membre; ?>">
                <div class="form-group">
                    <label>Pseudo</label>
                    <input type="text" name="pseudo" class="form-control" value="<?php echo $pseudo; ?>" placeholder="Entrez votre pseudo">
                </div>
                <div class="form-group">
                    <label>Mot de Passe</label>
                    <input type="password" name="mdp" class="form-control" value="<?php echo $mdp; ?>" placeholder="Entrez votre pseudo">
                </div>
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" name="nom" class="form-control" value="<?php echo $nom; ?>" placeholder="Entrez votre nom">
                </div>
                <div class="form-group">
                    <label>Prenom</label>
                    <input type="text" name="prenom" value="<?php echo $prenom; ?>" class="form-control" placeholder="Entrez votre prenom">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" value="<?php echo $email; ?>" class="form-control" placeholder="Entrez votre email">
                </div>
                <div class="form-group">
                    <label>Civilite</label>
                    <input type="text" name="civilite" value="<?php echo $civilite; ?>" class="form-control" placeholder="Entrez votre civilite m ou f">
                </div>
                <div class="form-group">
                    <label>ville</label>
                    <input type="text" name="ville" value="<?php echo $ville; ?>" class="form-control" placeholder="Entrez votre ville">
                </div>
                <div class="form-group">
                    <label>Code Postale</label>
                    <input type="text" name="code_postale" value="<?php echo $code_postale; ?>" class="form-control" placeholder="Entrez votre code postale">
                </div>
                <div class="form-group">
                    <label>adresse</label>
                    <input type="text" name="adresse" value="<?php echo $adresse; ?>" class="form-control" placeholder="Entrez votre adresse">
                </div>
                <div class="form-group">
                    <label>statut</label>
                    <input type="text" name="statut" value="<?php echo $statut; ?>" class="form-control">
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


