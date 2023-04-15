<?php
session_start();
include "connexion.php";

if (!$_SESSION['auth'] ) {
  header("Location: login.php");
}

$sql = "SELECT * FROM `demande` ";
$query = $db_con->prepare($sql);
$query->execute();
$row = $query->rowCount();
$data = $query->fetchAll();
$nbr_demandes = count($data);
// print_r($data[0]);





if (isset($_POST["eregistrer_reponse"])) {
  $idetud = $_POST["idetud"];
  $iduser = $_POST["iduser"];
  $reponseadmin = $_POST["reponseadmin"];

  $statut = 1;
  $sql = "update demande set iduser=:iduser,reponseadmin=:reponseadmin where idetud=:idetud";

  $query = $db_con->prepare($sql);

  $query->bindParam(':iduser', $iduser, PDO::PARAM_STR);
  $query->bindParam(':idetud', $idetud, PDO::PARAM_INT);
  $query->bindParam(':reponseadmin', $reponseadmin, PDO::PARAM_STR);
  $query->execute();
  echo "<script>window.location = 'demandes.php'</script>";
  exit();
}





?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">


  <title>Les demandes des étudiants </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet">
  <style>
    td {
      border-bottom: 1px solid #2196F3;
    }
  </style>
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



          <div class="col-md">
            <div class="well">
              <div class="	glyphicon glyphicon-list-alt"></div> Nombre total des demandes <span class="badge pull-right">
                <?php echo $nbr_demandes; ?>
              </span>
            </div>
            <hr>

            <div class="panel panel-default">


              <table class="table table-hover table-responsive">
                <thead>
                  <tr style="background: #607d8b78;border: 1px solid #2196F3;">
                    <th scope="col">#</th>
                    <th scope="col">Nom et Prenom</th>
                    <th scope="col">Date du demande </th>
                    <th scope="col">Les modules demandées</th>
                    <th scope="col">Documents</th>

                    <th scope="col">Reponse</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $i = 1;
                  foreach ($data as $demande) {
                    echo "<tr>";
                    echo "<td>" . $i++ . "</td>";
                    $query = $db_con->prepare("SELECT nom , prenom from etudiant where idetud = " . $demande["idetud"] . "");
                    $query->execute();

                    $nom = $query->fetch();
                    echo "<td>" . $nom[0] . "  " . $nom[1] .  "</td>";
                    echo "<td>" . $demande["datedemande"] . "</td>";
                    echo "<td>" . $demande["modulesdemandees"] . "</td>";

                  ?>
                    <td>
                      <div class="" style="margin: 5px 0;">
                        <a href="files_releve_carte/<?php echo $demande["file_releve"]; ?>" download class="btn btn-sm btn-info">
                          <div class="	glyphicon glyphicon-download-alt"></div>
                          Relevés de notes
                        </a>
                      </div>
                      <div class="">
                        <a href="files_releve_carte/<?php echo $demande["file_carte"]; ?>" download class="btn btn-sm btn-success">
                          <div class="	glyphicon glyphicon-download-alt"></div>
                          Carte étudiant
                        </a>
                      </div>
                      </pre>
                    </td>
                    <td>
                      <form method="post">
                        <input type="hidden" name="idetud" value="<?php echo $demande["idetud"] ?>">
                        <input type="hidden" name="iduser" value="<?php echo $_SESSION["user"]["iduser"] ?>">
                        <textarea style="padding: 8px;border: 1px solid #3F51B5;border-radius: 4px;margin-bottom: 4px;" name="reponseadmin" placeholder="ajouter une reponse" cols="30" rows="3"><?php echo $demande["reponseadmin"]; ?></textarea>

                        <input type="submit" name="eregistrer_reponse" class='btn btn-sm btn-danger' value="Enregistrer la reponse" />
                      </form>

                    </td>
                  <?php
                    echo "</tr>";
                  }
                  ?>




                </tbody>
              </table>


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