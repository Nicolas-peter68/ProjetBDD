<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <?php require 'fonctions.php' ?>
    <?php if ($_POST) {
        $errors = array();
        require_once 'db.php';
        if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
            $errors['username'] = "Pseudo invalide";
        } else {
            $req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
            $req->execute([$_POST['username']]);
            $user = $req->fetch();
            if ($user) {
                $errors['username'] = 'Ce pseudo est déjà pris, trouves-en un autre !';
            }
        }

        if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "email invalide";
        } else {
            $req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
            $req->execute([$_POST['email']]);
            $user = $req->fetch();
            if ($user) {
                $errors['email'] = 'Cet email est déjà pris par une autre personne';
            }
        }

        if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
            $errors['password'] = "Votre mot de passe est invalide";
        }
        if (empty($errors)) {

            $req = $pdo->prepare("INSERT INTO users SET username = ?, password = ?,email = ?");
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $req->execute([$_POST['username'], $password, $_POST['email']]);
        }

        debug($errors);
    } ?>

    <h1>Inscription</h1>
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <p>Il reste des champs incomplet:</p>
            <ul>
                <?php foreach ($errors as $erreur) : ?>
                    <li><?= $erreur; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" name="email" class="form-control" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="Pseudo">Votre pseudo</label>
            <input type="text" name="username" class="form-control" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Mot de passe</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Comfirmez votre votre mot de passe</label>
            <input type="password" name="password_confirm" class="form-control" id="exampleInputPassword1">
        </div>

        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
</body>

</html>