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
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <title>Création de personnages</title>
</head>
<?php
if (!empty($_POST)) {
  $valide = array();
  $sql = "INSERT INTO players (user_id, name ,race) VALUES (?,?,?)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$_SESSION['auth']->id, $_POST['name'], $_POST['race']]);
  $valide['name'] = 'Vous avez crée un(e) ' . $_POST['race'] . ' qui s\'appelle : ' . $_POST['name'];
}
?>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Création</a>
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
  <h1>Créez votre personnage</h1>
  <?php if (!empty($valide)) : ?>
    <div class="alert alert-success">
      <?php foreach ($valide as $yes) : ?>
        <p><?= $yes; ?></p>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
  <form action="" method="POST">
    <div class="form-group">
      <label for="nom">Nom</label>
      <input type="text" name="name" class="form-control" id="nom" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
      <label for="race">Race</label>
      <input type="text" name="race" class="form-control" id="race" aria-describedby="emailHelp">
    </div>
    <button type="submit" class="btn btn-primary">Création</button>
  </form>
</body>

</html>