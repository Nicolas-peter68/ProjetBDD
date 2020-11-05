<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <?php
    if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {
        require_once 'db.php';
        require_once 'fonctions.php';
        //session_start();
        $req = $pdo->prepare('SELECT * FROM users WHERE username = :username OR email = :username');
        $req->execute(['username' => $_POST['username']]);
        $user = $req->fetch();
        debug($_SESSION);
        //debug(password_verify($_POST['password'],$user->password));


        if (password_verify($_POST['password'], $user->password)) {
            $_SESSION['auth'] = $user;
            $_SESSION['flash']['success'] = 'Vous êtes connecté';
            header('Location: account.php');
            exit();
        } else {
            $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrect';
        }
    } ?>
    <h1>Connectez-vous</h1>
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