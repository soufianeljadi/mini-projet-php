<?php
include "connexion.php";
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
        <div>
          <?php
          if (isset($_POST["submit"])) {
            $apogee = $_POST["apogee"];
            //verification unique code
            $stmt = $db_con->prepare("SELECT * FROM etudiant WHERE apogee = :apogee");
            $stmt->bindParam(':apogee', $apogee);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
              echo "<li class='alert alert-danger'>Le code Apogee existe déjà. Veuillez en saisir un nouveau.</li>";
            } else {
              $nom = $_POST["nom"];
              $prenom = $_POST["prenom"];
              $datenaissance = $_POST["datenaissance"];
              $filiere = $_POST["filiere"];
              $statut = 1;
              $sql = "INSERT INTO `etudiant`  (nom, prenom, apogee,datenaissance,filiere,statut) VALUES (:nom, :prenom, :apogee,:datenaissance,:filiere,:statut)";
              $query = $db_con->prepare($sql);

              $query->bindParam(':nom', $nom, PDO::PARAM_STR);
              $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
              $query->bindParam(':datenaissance', $datenaissance, PDO::PARAM_STR);
              $query->bindParam(':apogee', $apogee, PDO::PARAM_STR);
              $query->bindParam(':filiere', $filiere, PDO::PARAM_STR);
              $query->bindParam(':statut', $statut, PDO::PARAM_STR);
              $query->execute();
              
              header("Location: etudiants.php");
            }
          }
          ?>
        </div>
        <hr>
        <div class="row">




          <hr>

          <div class="card-body">
            <h2>Ajouter un étudiant</h2>
            <form method="post">
              <div class="row">
                <div class="col-6">
                  <div class="my-2">
                    <label class="form-label">Nom</label>
                    <input required class="form-control" type="text" placeholder="nom" name="nom">
                  </div>
                  <div class="my-2">
                    <label class="form-label">Prenom</label>
                    <input required class="form-control" type="text" placeholder="prenom" name="prenom">
                  </div>
                  <div class="my-2">
                    <label class="form-label">Code Apogee</label>
                    <input required class="form-control" type="text" placeholder="Apogee" name="apogee">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="my-2">
                    <label class="form-label">Date naissance</label>
                    <input required class="form-control" type="date" placeholder="Date naissance" name="datenaissance">
                  </div>
                  <div class="my-2">
                    <label class="form-label">Filliere</label>
                    <input required class="form-control" type="text" placeholder="filliere" name="filiere">
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

  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
  <script type="text/javascript">

  </script>
</body>

</html>