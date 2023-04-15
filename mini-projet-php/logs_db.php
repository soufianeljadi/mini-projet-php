<?php
session_start();
include "connexion.php";
include "eventuser.php";
if (!$_SESSION['connect_admin']) {
  header("Location: login.php");
}
$sql = "SELECT * FROM `eventuser`";
$query = $db_con->prepare($sql);
$query->execute();
$row = $query->rowCount();
$data = $query->fetchAll();

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">


  <title>Logs</title>
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

            <h3 style="font-family: math;
    color: #03A9F4;
    border: 1px solid black;
    padding: 10px;">Les opérations effectuées par les utilisateurs dans la base de donnees </h3>
  
            <div class="panel panel-default">


              <table class="table table-hover table-responsive">
                <thead>
                  <tr>
                    <th scope="col">Date Operation</th>
                    <th scope="col">Utilisateur</th>
                    <th scope="col">adress IP</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $i = 1;
                  foreach ($data as $op) {
                  ?>
                    <tr>
                      <td><?php echo $op["dateevent"]  ?></td>
                     
                      <td> <?php 
                          $sql = "SELECT * from utilisateur where iduser=:iduser";
                          $query = $db_con->prepare($sql);
                          $query->bindParam(':iduser', $op["iduser"], PDO::PARAM_INT);
                          $query->execute();
                          $result  = $query->fetch();
                        echo $result["login"];
                      
                      ?> </td>



                      <td>
                      <?php echo $op["ipadress"]  ?>

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