<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Se connecter</title>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Se connecter</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">S'inscrire<span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>
    <?php
    $errors =array();
    if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {
        require_once 'db.php';
        require_once 'fonctions.php';

        $req = $pdo->prepare('SELECT * FROM users WHERE username = :username OR email = :username');
        $req->execute(['username' => $_POST['username']]);
        $user = $req->fetch();
        if (password_verify($_POST['password'], $user->password)) {
            $_SESSION['auth'] = $user;
            $_SESSION['flash']['success'] = 'Vous êtes connecté';
            header('Location: account.php');
            exit();
        } else {
            //$_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrect';
            $errors['password'] =" Identifiant ou mot de passe invalide";
        }
    } ?>
    <h1>Connectez-vous</h1>
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">   
            <ul>
                <?php foreach ($errors as $erreur) : ?>
                    <li><?= $erreur; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="" method="POST">
        <div class="form-row">
            <div class="col">
                <input type="text" name="username" class="form-control" placeholder="Pseudo ou email">
            </div>
            <div class="col">
                <input type="password" name="password" class="form-control" placeholder="Mot de passe">
            </div>
        </div>
        <button type="submit" name="login" class="btn btn-success">Se connecter</button>
    </form>
</body>

</html>