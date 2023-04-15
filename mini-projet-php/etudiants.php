<?php
session_start();
include "connexion.php";
if (!$_SESSION['auth'] ) {
  header("Location: login.php");
}

$sql = "SELECT * FROM `etudiant` ";
$query = $db_con->prepare($sql);
$query->execute();
$row = $query->rowCount();
$data = $query->fetchAll();
$total_etudiants = count($data);
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">


  <title>Espace Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    
<?php include "navbar.php";?>

  <div class="container bootstrap snippets bootdey">

    <div class="row">
    <?php include "sidebar.php" ?>

      <div class="col-md-9">

        <a href="#"><strong><i class="glyphicon glyphicon-dashboard"></i> My Dashboard</strong></a>
        <hr>
        <div class="row">



          <div class="col-md">
            <div class="well">
              <div class="glyphicon glyphicon-user"></div> Nombre total des étudiants <span class="badge pull-right">
                <?php echo $total_etudiants; ?>
              </span>
            </div>
            <hr>
            <div style="margin-bottom: 10px;" class="col-md">

              <div class="input-group mb-3">
                <form action="search.php" method="get">
                  <h4>Rechercher</h4>
                  <div style="display: flex;justify-content: space-between; width: 100%;">
                    
                      <input required placeholder="Code Apogee ou Filliere" type="text" name="search" class="form-control">
                      <button type="submit" style="margin-left: 10px;" class="btn-info btn">Search</button>
                

                  </div>
                  <?php if($_SESSION["user"]["profil"] == 1){ ?>
                  <a href="ajout_etudiant.php" class="btn btn-success " style="margin: 10px 0; ">Ajouter un etudiant</a>
                  <?php } ?>
                </form>
              </div>
            </div>
            <div class="panel panel-default">


              <table class="table table-hover table-responsive">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Code Apogee</th>
                    <th scope="col">Date Naissance</th>
                    <th scope="col">Filliere</th>
                    <?php if($_SESSION["user"]["profil"] == 1){ ?>
                    <th scope="col">Control</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $i = 1;
                  foreach ($data as $etudiant) {
                    echo "<tr>";
                    echo "<td>" . $i++ . "</td>";
                    echo "<td>" . $etudiant["nom"] . "</td>";
                    echo "<td>" . $etudiant["prenom"] . "</td>";
                    echo "<td>" . $etudiant["apogee"] . "</td>";
                    echo "<td>" . $etudiant["datenaissance"] . "</td>";
                    echo "<td>" . $etudiant["filiere"] . "</td>";
                  ?>
                    <?php if($_SESSION["user"]["profil"] == 1){ ?>

                    <td>
                      <a href='edit.php?edit=etudiant&id=<?php echo $etudiant["idetud"] ?>' class='btn btn-sm btn-warning'>Modifier</a>
                      <a href='delete.php?del=<?php echo $etudiant["idetud"] ?>' class='btn btn-sm btn-danger'>Suprimmer</a>

                    </td>
                  <?php
                    echo "</tr>";
                    }
                  }
                  ?>




                </tbody>
              </table>
              <?php

              if (isset($_POST["delete_student"])) {
                $sql = "DELETE  FROM `etudiant` WHERE idetud = :id ";
                $query = $db_con->prepare($sql);

                $row = $query->bindParam(":id", $_POST["id"], PDO::PARAM_STR);
                $query->execute();
                echo "<script>  location.reload(); </script>";
                exit();
              }


              ?>

            </div>
          </div>


          <!-- <div class="col-md-5">
            <ul class="nav nav-justified">
              <li><a href="#"><i class="glyphicon glyphicon-cog"></i></a></li>
              <li><a href="#"><i class="glyphicon glyphicon-heart"></i></a></li>
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-comment"></i><span class="count">3</span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">1. Is there a way..</a></li>
                  <li><a href="#">2. Hello, admin. I would..</a></li>
                  <li><a href="#"><strong>All messages</strong></a></li>
                </ul>
              </li>
              <li><a href="#"><i class="glyphicon glyphicon-user"></i></a></li>
              <li><a title="Add Widget" data-toggle="modal" href="#addWidgetModal"><span class="glyphicon glyphicon-plus-sign"></span></a></li>
            </ul>
            <hr>
            <p>
              This is a responsive dashboard-style layout that uses <a href="https://www.getbootstrap.com">Bootstrap
                3</a>. You can use this template as a
              starting point to create something more unique.
            </p>
            <hr>
            <div class="btn-group btn-group-justified">
              <a href="#" class="btn btn-info col-sm-3">
                <i class="glyphicon glyphicon-plus"></i><br>
                Service
              </a>
              <a href="#" class="btn btn-info col-sm-3">
                <i class="glyphicon glyphicon-cloud"></i><br>
                Cloud
              </a>
              <a href="#" class="btn btn-info col-sm-3">
                <i class="glyphicon glyphicon-cog"></i><br>
                Tools
              </a>
              <a href="#" class="btn btn-info col-sm-3">
                <i class="glyphicon glyphicon-question-sign"></i><br>
                Help
              </a>
            </div>
          </div> -->
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