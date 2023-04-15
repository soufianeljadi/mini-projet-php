<?php
session_start();
include "eventuser.php";
if (!$_SESSION['connect_admin']) {
  header("Location: login.php");
}

include  'connexion.php';

$id = intval($_GET['id']);
switch ($_GET["edit"]) {
  case 'etudiant':
    $sql = "SELECT *from etudiant where idetud=:id";
    $query = $db_con->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    $result  = $query->fetch();
    break;
    case 'user':
      $sql = "SELECT * from utilisateur where iduser=:id";
      $query = $db_con->prepare($sql);
      $query->bindParam(':id', $id, PDO::PARAM_STR);
      $query->execute();
    $result  = $query->fetch();
    break;
}



$cnt = 1;
// if ($query->rowCount() > 0) {
//   print_r($result);
// }



if (isset($_POST['modifier'])) {
  switch ($_GET["edit"]) {
    case 'etudiant':

      $id = intval($_GET['id']);

      $nom = $_POST['nom'];
      $prenom = $_POST['prenom'];
      $apogee = $_POST['apogee'];
      $filiere = $_POST['filiere'];
      if (!isset($_POST["datenaissance"])) {
        $datenaissance = $result["datenaissance"];
      } else {
        $datenaissance = $_POST["datenaissance"];
      }
      // Query for Updation
      $sql = "update etudiant set nom=:nom,prenom=:prenom,apogee=:apogee,datenaissance=:datenaissance,filiere=:filiere where idetud=:id";
      //Prepare Query for Execution
      $query = $db_con->prepare($sql);
      // Bind the parameters
      $query->bindParam(':nom', $nom, PDO::PARAM_STR);
      $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
      $query->bindParam(':apogee', $apogee, PDO::PARAM_STR);
      $query->bindParam(':datenaissance', $datenaissance, PDO::PARAM_STR);
      $query->bindParam(':filiere', $filiere, PDO::PARAM_STR);
      $query->bindParam(':id', $id, PDO::PARAM_INT);


      $query->execute();

      echo "<script>alert('Record Updated successfully');</script>";
      // Code for redirection
      echo "<script>window.location.href='etudiants.php'</script>";
      break;

    case 'user':
      $id = intval($_GET['id']);

      $login = $_POST['login'];
      $password = $_POST['password'];
      $profil = $_POST['profil'];

      // Query for Updation
      $sql = "UPDATE utilisateur SET login=:login,password=:password,profil=:profil WHERE iduser=:id";
      //Prepare Query for Execution
      $query = $db_con->prepare($sql);
      // Bind the parameters
      $query->bindParam(':login', $login, PDO::PARAM_STR);
      $query->bindParam(':password', $password, PDO::PARAM_STR);
      $query->bindParam(':profil', $profil, PDO::PARAM_STR);
      $query->bindParam(':id', $id, PDO::PARAM_INT);

      $query->execute();
      eventuser();

      echo "<script>alert('Record Updated successfully');</script>";
      // Code for redirection
      echo "<script>window.location.href='utilisateurs.php'</script>";



      break;
  }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">


  <title>Modifier <?php echo $_GET["edit"] == "etudiant" ? "Etudiant" : "utilisateur"; ?></title>

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
        <div class="row" >
          <div class="container">
          
            <?php if ($_GET["edit"] == "etudiant") { ?>
              <div class="card">
                <div class="card-header">
                  <h3>Modifier les données d'un étudiant</h3>

                </div>
                <div class="card-body">
                  <form method="post">
                    <div class="row" style="width: 400px;">
                      <div class="col-6">
                        <div class="my-2">
                          <label class="form-label">Nom</label>
                          <input class="form-control" type="text" placeholder="nom" name="nom" value="<?php echo $result["nom"] ?>">
                        </div>
                        <div class="my-2">
                          <label class="form-label">Prenom</label>
                          <input class="form-control" type="text" placeholder="prenom" name="prenom" value="<?php echo $result["prenom"] ?>">
                        </div>
                        <div class="my-2">
                          <label class="form-label">Code Apogee</label>
                          <input class="form-control" type="text" placeholder="Apogee" name="apogee" value="<?php echo $result["apogee"] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row" style="width: 400px;">
                      <div class="col-6">
                        <div class="my-2">
                          <label class="form-label">Date naissance</label>
                          <input class="form-control" type="date" placeholder="Date naissance" name="datenaissance" value="<?php echo $result["datenaissance"] ?>">
                        </div>
                        <div class="my-2" style="margin-bottom: 10px;">
                          <label class="form-label">Filliere</label>
                          <input class="form-control" type="text" placeholder="filliere" name="filiere" value="<?php echo $result["filiere"] ?>">
                        </div>
                      </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Modifier" name="modifier">


                  </form>

                </div>
              </div>
            <?php } else { ?>
              <div class="card">
                <div class="card-header">
                  <h1>Modifier les donnees d'un utilisateur</h1>

                </div>
                <div class="card-body">
                  <form method="post">
                    <div class="row" style="width: 400px;">
                      <div class="col-6">
                        <div class="my-2">
                          <label class="form-label">Login</label>
                          <input class="form-control" type="email" placeholder="login" name="login" value="<?php echo $result["login"] ?>">
                        </div>

                      </div>
                      <div class="col-6">
                        <div style="margin: 10px 0 ; ">
                          <label class="form-label">Mot de pass</label>
                          <input class="form-control" type="text" placeholder="password" name="password" value="<?php echo $result["password"] ?>">
                        </div>


                      </div>
                      <div class="col-6">
                        <div class="my-2">
                          <label class="form-label">Profil</label>
                          <select name="profil">
                            <option <?php echo $result["profil"] == 1 ? "selected" : " "; ?> value="1">Chef de scolarité </option>
                            <option <?php echo $result["profil"] == 0 ? "selected" : " "; ?> value="0">Agent</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Modifier" name="modifier">


                  </form>

                </div>
              </div>
            <?php } ?>
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