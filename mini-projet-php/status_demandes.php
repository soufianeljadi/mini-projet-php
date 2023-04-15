<?php
session_start();
?>


<?php
include "connexion.php";
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


  <?php include "navbar.php"; ?>

  <div class="container bootstrap snippets bootdey">

    <div class="row">
      <?php include "sidebar.php" ?>

      <div class="col-md-9">

        <a href="#"><strong><i class="glyphicon glyphicon-dashboard"></i> My Dashboard</strong></a>
        <hr>
        <div class="row">



          <div class="col-md">
            <?php
            // $file = fopen("cloturer_operation.txt", "r");
            // $res = file_get_contents("cloturer_operation.txt");


            if (isset($_POST['submit'])) {
              $status = $_POST['status'];
              file_put_contents("cloturer_operation.txt", $status);
            }

            // Read the status from the file
            $status = file_get_contents("cloturer_operation.txt");
            ?>
            <p><?php if ($status == "1") {
                  echo "<h3 style='color: green'>L’opération des demandes de modules libres est Ouverte</h3>";
                } else echo "<h3 style='color: red'>L’opération des demandes de modules libres est fermee</h3>";  ?></p>
            <form method="post">

              <input type="radio" name="status" value="1" <?php if ($status == "1") {
                                                            echo "checked";
                                                          } ?>>Active<br>
              <input type="radio" style="margin: 10px 0;" name="status" value="0" <?php if ($status == "0") {
                                                                                    echo "checked";
                                                                                  } ?>>Disactive<br>
              <input type="submit" name="submit" value="Enregistrer">
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