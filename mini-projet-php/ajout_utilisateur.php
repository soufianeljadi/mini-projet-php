<?php
include "connexion.php";
include "eventuser.php";
session_start();
if (!$_SESSION['connect_admin']) {
  header("Location: login.php");
}



?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">


  <title>Ajouter un étudiant </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
  <?php include "navbar.php"; ?>


  <div class="container bootstrap snippets bootdey">

    <div class="row">
      <?php include "sidebar.php" ?>

      <div class="col-md-9">

        <a href="#"><strong><i class="glyphicon glyphicon-dashboard"></i> My Dashboard</strong></a>
        <hr>
        <div class="row">
          <div class="container">
            <div class="card">
              <?php
              if (isset($_POST["submit"])) {

                $login = $_POST["login"];
                $password = $_POST["password"];
                $profil = $_POST["profil"];

                $statut = 1;
                $stmt = $db_con->prepare("SELECT * FROM Utilisateur WHERE login = :login");
                $stmt->bindParam(':login', $login);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                  echo "<li style='width: fit-content' class='alert alert-danger'>L'utilisateur  existe déjà. Veuillez en saisir un nouveau.</li>";
                } else {
                  $sql = "INSERT INTO `Utilisateur`  (login, password, profil,statut) VALUES (:login, :password, :profil,:statut)";
                  $query = $db_con->prepare($sql);

                  $query->bindParam(':login', $login, PDO::PARAM_STR);
                  $query->bindParam(':password', $password, PDO::PARAM_STR);
                  $query->bindParam(':profil', $profil, PDO::PARAM_STR);
                  $query->bindParam(':statut', $statut, PDO::PARAM_STR);
                  $query->execute();
                  eventuser();
                  header("Location: utilisateurs.php");
                }
              }
              ?>
              <div class="card-header">
                <h1>Ajouter un utilisateur</h1>
              </div>
              <div class="card-body" style="width: 400px;">
                <form method="post">
                  <div class="row">
                    <div class="col-6">
                      <div class="my-2">
                        <label class="form-label">Login</label>
                        <input required class="form-control" type="email" placeholder="login" name="login">
                      </div>
                      <div class="my-2" style="margin: 10px 0;">
                        <label class="form-label">Password</label>
                        <input required class="form-control" type="password" placeholder="password" name="password">
                      </div>
                      <div class="my-2">
                        <label class="form-label">Profil</label>
                        <select required name="profil">
                          <option disabled>SELECT----</option>
                          <option value="1">Chef de scolarité </option>
                          <option value="0">Agent</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <input type="submit" class="btn btn-primary" value="Ajouter" name="submit">


                </form>

              </div>
            </div>
          </div>
        </div>



      </div>
    </div>
  </div>

  </div>

  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
  <script type="text/javascript">

  </script>
</body>

</html>