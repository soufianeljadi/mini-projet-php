<?php
session_start();
include "connexion.php";
if (!$_SESSION['connect'] == true) {
  header('Location: gestion.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet">

  <title>Modifier demande</title>
</head>

<body>
  <div class="container">
    <a class="btn btn-success btn-sm" style="margin: 10px ;"> Retourner</a>
    <div>
      <form style="text-align: right; margin: 10px;" action="deconnexion.php" method="post">
        <button style="background-color: #F44336;color: white;padding: 10px;border: none;cursor: pointer;" type="submit">Deconnexion</button>
      </form>
    </div>
    <u>Modifier Ma demande</u>
    <h3>Veuillez sélectionner au maximum 4 modules. Merci</h3>
    <h3>Demande de modules libres <span style="color: red;">(4 modules au maximum)</span></h3>
   
    <form action="edit_modules.php" method="get">

      <div class="selection" style="display: flex;">

        <?php
        $sql = "SELECT modulesdemandees FROM demande WHERE idetud = :idetud";
        $query = $db_con->prepare($sql);

        $query->bindParam(':idetud', $_SESSION["user"]["idetud"], PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0) {
          $row = $query->fetch();
          $selectedOptions = explode("-", $row["modulesdemandees"]);
        } else {
          $selectedOptions = array();
        }
        ?>
        <!-- S4 -->
        <div style="margin-right: 40px;">
          <h2>S4</h2>
          <div>
            <label for="m21">M21:</label>
            <input <?php if (in_array("m21", $selectedOptions)) echo "checked"; ?> type="checkbox" name="m21" id="m21" value="m21">
          </div>
          <div>
            <label for="m22">M22:</label>
            <input <?php if (in_array("m22", $selectedOptions)) echo "checked"; ?> type="checkbox" name="m22" id="m22" value="m22">
          </div>
          <div>
            <label for="m23">M23:</label>
            <input <?php if (in_array("m23", $selectedOptions)) echo "checked"; ?> type="checkbox" name="m23" id="m23" value="m23">
          </div>
          <div>
            <label for="m24">M24:</label>
            <input <?php if (in_array("m24", $selectedOptions)) echo "checked"; ?> type="checkbox" name="m24" id="m24" value="m24">
          </div>
        </div>
        <!-- S6 -->

        <div>
          <h2>S6</h2>
          <div>
            <label for="m29">M29:</label>
            <input <?php if (in_array("m29", $selectedOptions)) echo "checked"; ?> type="checkbox" name="m29" id="m29" value="m29">
          </div>
          <div>
            <label for="m30">M30:</label>
            <input <?php if (in_array("m30", $selectedOptions)) echo "checked"; ?> type="checkbox" name="m30" id="m30" value="m30">
          </div>
          <div>
            <label for="m31">M31:</label>
            <input <?php if (in_array("m31", $selectedOptions)) echo "checked"; ?> type="checkbox" name="m31" id="m31" value="m31">
          </div>
          <div>
            <label for="m32">M32:</label>
            <input <?php if (in_array("m32", $selectedOptions)) echo "checked"; ?> type="checkbox" name="m32" id="m32" value="m32">
          </div>
        </div>
      </div>
      <input type="submit" value="ENregistrer" id="envoyer" class="envoyer-btn">
    </form>
  </div>

</body>

</html>