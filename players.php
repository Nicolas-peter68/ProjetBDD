<?php
require_once 'fonctions.php';
require_once 'db.php';
session_start();
logged_only(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <title>Vos personnages</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Liste</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                
                <li class="nav-item active">
                    <a class="nav-link" href="account.php">Votre Compte<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                <a class="nav-link" href="logout.php">Se déconnecter<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="create.php">Créer un personnage<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="players.php">Vos personnages<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="delete.php">Supprimer un personnage<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="edit.php">Renommer un personnage<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <table class="table table-bordered table-dark">
        <thead>
            <tr>
                <th scope="col" class="text-center">Nom</th>
                <th scope="col" class="text-center">Race</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT name, race FROM players WHERE user_id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$_SESSION['auth']->id]);
            while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                print_r('<tr>' . '<td class="text-center">' . $data['name'] . '</td> <td class="text-center">' . $data['race'] . '</td></tr>');
            }
            ?>
        </tbody>
       
    </table>
</body>

</html>