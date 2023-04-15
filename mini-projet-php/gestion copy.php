<?php
session_start();
if (!$_SESSION["connect_admin"]) {
  header('Location: login.php');
}
include "connexion.php";
if ($_SESSION["user"]["profil"] == 1) {








?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Espace Admin</title>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled">Disabled</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
      <h1>Bonjour, Admin!</h1>
      <span>Chef de scolarite</span>
      <?php
      include "database/etudiants.php";
      ?>
    </div>

  </body>

  </html>



























<?php
} else {
?>
  <h1>Bonjour, AGnent!</h1>
  <span>Agent</span>
<?php
}
?>


<div>
  <form action="deconnexion.php" method="post">
    <button style="background-color: #F44336;color: white;padding: 10px;border: none;cursor: pointer;" type="submit">Deconnexion</button>
  </form>
</div>