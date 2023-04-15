<?php
session_start();
include "connexion.php";
if (!$_SESSION["connect"]) {
  header('Location: index.php');
}


$sql = "SELECT * FROM `demande` WHERE idetud = :id";
$query = $db_con->prepare($sql);
$query->bindParam(':id', $_SESSION["user"]["idetud"], PDO::PARAM_INT);
$query->execute();

$row = $query->rowCount();



?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Espace Etudiant</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet">


</head>

<body class="container">
  <div class="container">
    <div>
      <form style="text-align: right; margin: 10px;" action="deconnexion.php" method="post">
        <button style="background-color: #F44336;color: white;padding: 10px;border: none;cursor: pointer;" type="submit">Deconnexion</button>
      </form>
    </div>
    <?php
          $error = isset($_GET['error']) ? $_GET['error'] : '';

          if (!empty($error)) {
            echo "<li style='background-color: #F48336;color: white;padding: 10px;border: none;width:fit-content'>" . $error . "</li>";
          }
          ?>
    <?php

    echo "<h1>Bonjour " . $_SESSION['user']["nom"]  . " " .  $_SESSION['user']["prenom"]  .  "</h1>";

    $status_demandes = file_get_contents("cloturer_operation.txt");
    if ($status_demandes == 0) {
      echo "<div style='background-color: #2196f3;
    color: white;
    width: fit-content;
    font-size: 22px;
    padding: 10px 15px;
    border-radius: 5px;' class='cloturer'>l'opération des demandes de modules libres est cloturee </div>";


    ?>


    <?php  } else { ?>
      <div>
        <?php if ($row > 0) {
          $data = $query->fetchAll(PDO::FETCH_ASSOC);
        ?>

          <h3>Mes Demandes</h3>

          <table class="table table-hover table-responsive">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">les modules demandées</th>
                <th scope="col">Date demande</th>
                <th scope="col">Reponses</th>
                <th scope="col">Mes documents</th>
                <th scope="col">Control</th>
              </tr>
            </thead>
            <tbody>

              <?php
              foreach ($data as $demande) {
              ?>
                <tr>
                  <td>-</td>
                  <td><?php echo  $demande["modulesdemandees"] ?>
                    <div>
                      <a href='edit_demande.php'>Modifier Les modules <span class="glyphicon glyphicon-edit"></span></a>
                    </div>

                  </td>
                  <td><?php echo $demande["datedemande"] ?></td>
                  <td style="color: #ff5198;"><?php echo isset($demande["reponseadmin"]) ? $demande["reponseadmin"] : "--Acune reponse--";  ?></td>
                  <td>
                    <?php if (isset($demande["file_releve"])) {
                    ?>
                      <div class="" style="margin: 5px 0;display: flex;justify-content: space-between;width: 150px;">
                        <a href="files_releve_carte/<?php echo $demande["file_releve"]; ?>" download>
                          <div class="	glyphicon glyphicon-download-alt"></div>
                          Relevé de notes
                        </a>
                        <a href="delete_document.php?del=releve" class="text-danger ">
                          <div class="glyphicon glyphicon-trash"></div>
                        </a>
                      <?php } else { ?>
                        <div>
                          <form action="update_documents.php" method="post" enctype="multipart/form-data">
                            <label for="releve">(Acune releve)</label>
                            <input type="file" name="releve_note" accept=".pdf">
                            <input type="submit" value="save" name="save_releve">
                          </form>
                        </div>
                      <?php } ?>


                      </div>
                      <div class="" style="margin: 5px 0;display: flex;justify-content: space-between;width: 150px;">
                        <?php if (isset($demande["file_carte"])) {
                        ?>
                          <a href="files_releve_carte/<?php echo $demande["file_carte"]; ?>" download>
                            <div class="	glyphicon glyphicon-download-alt"></div>
                            Carte étudiant
                          </a>
                          <a href="delete_document.php?del=carte" class="text-danger ">
                            <div class="glyphicon glyphicon-trash"></div>
                          </a>
                        <?php } else { ?>
                          <div>
                            <form action="update_documents.php" method="post" enctype="multipart/form-data">
                              <label for="carte">(Acune carte etudiant )</label>
                              <input type="file" name="carte_etudiant" id="carte" accept=".jpg,.jpeg,.png">
                              <input type="submit" name="save_carte" value="save">
                            </form>
                          </div>
                        <?php } ?>

                      </div>
                  </td>
                  <td>

                    <form method="post">
                      <input type="hidden" name="iddemande" value="<?php echo $demande["iddemande"] ?>">
                      <input type="submit" name="delete_demande" class='btn btn-sm btn-danger' value="Supprimer La demande" />
                    </form>
                  </td>
                </tr>
              <?php } ?>





            </tbody>
            <?php

            if (isset($_POST["delete_demande"])) {
              $sql = "DELETE  FROM `demande` WHERE iddemande= :id ";
              $query = $db_con->prepare($sql);
              $row = $query->bindParam(":id", $_POST["iddemande"], PDO::PARAM_INT);
              $query->execute();
              echo "<script>window.location.href='myspace.php'</script>";
              exit();
            }


            ?>
          </table>




        <?php } else { ?>
        
          <h3>Veuillez sélectionner au maximum 4 modules. Merci</h3>
          
          <h3>Demande de modules libres <span style="color: red;">(4 modules au maximum)</span></h3>
      </div>

  </div>
  <form action="selection.php" method="get">
    <input type="hidden" name="etudiant_nom" value="<?php echo $_SESSION['user']["nom"] ?>">
    <input type="hidden" name="etudiant_prenom" value="<?php echo $_SESSION['user']["prenom"] ?>">
    <input type="hidden" name="etudiant_apogee" value="<?php echo $_SESSION['user']["apogee"] ?>">
    <div class="selection" style="display: flex;">
      <!-- S4 -->
      <div style="margin-right: 40px;">
        <h2>S4</h2>
        <div>
          <label for="m21">M21:</label>
          <input type="checkbox" name="m21" id="m21" value="m21">
        </div>
        <div>
          <label for="m22">M22:</label>
          <input type="checkbox" name="m22" id="m22" value="m22">
        </div>
        <div>
          <label for="m23">M23:</label>
          <input type="checkbox" name="m23" id="m23" value="m23">
        </div>
        <div>
          <label for="m24">M24:</label>
          <input type="checkbox" name="m24" id="m24" value="m24">
        </div>
      </div>
      <!-- S6 -->

      <div>
        <h2>S6</h2>
        <div>
          <label for="m29">M29:</label>
          <input type="checkbox" name="m29" id="m29" value="m29">
        </div>
        <div>
          <label for="m30">M30:</label>
          <input type="checkbox" name="m30" id="m30" value="m30">
        </div>
        <div>
          <label for="m31">M31:</label>
          <input type="checkbox" name="m31" id="m31" value="m31">
        </div>
        <div>
          <label for="m32">M32:</label>
          <input type="checkbox" name="m32" id="m32" value="m32">
        </div>
      </div>
    </div>
    <input type="submit" value="Etape suivant" id="envoyer" class="envoyer-btn">
  </form>
  </div>
  <!-- </div> -->
<?php } ?>

<script src="script.js"></script>
</body>

</html>
<?php } ?>