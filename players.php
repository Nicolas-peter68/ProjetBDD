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
    <title>Document</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                <li class="nav-item active">
                    <a class="nav-link" href="account.php">Votre Compte<span class="sr-only">(current)</span></a>
                </li>
                <a class="nav-link" href="logout.php">Se déconnecter<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="create.php">Créer un personnage<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="players.php">Vos personnages<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Supprimer un personnage<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <table class="players">
        <thead class="table table-borderless table-dark">
            <tr>
                <th scope="col" class="text-center">Nom</th>
                <th scope="col" class="text-center">Race</th>
            </tr>
            <tbody class="table table-border table-dark">
                
                            <?php
            $sql = "SELECT name, race FROM players WHERE user_id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$_SESSION['auth']->id]);
            while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                print_r('<tr>'.'<th>'.$data['name'] .'</th> <th>' . $data['race'] . '</th></tr>');
            }
            ?>
            
            </tbody>
        </thead>
    </table>
</body>

</html>