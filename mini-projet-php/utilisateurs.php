<?php
session_start();

if(!$_SESSION['connect_admin']){
  header("Location: login.php");
}
?>


<?php
include "connexion.php";
$sql = "SELECT * FROM `utilisateur`";
$query = $db_con->prepare($sql);
$query->execute();
$row = $query->rowCount();
$data = $query->fetchAll();
$total_utilisateurs = count($data);
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
              <div class="glyphicon glyphicon-user"></div> Nombre total des utilisatuers <span class="badge pull-right">
                <?php echo $total_utilisateurs; ?>
              </span>
            </div>
            <hr>
            <div style="margin-bottom: 10px;" class="col-md">

              <div class="input-group mb-3">               
                  <a href="ajout_utilisateur.php" class="btn btn-success " style="margin: 10px 0; ">Ajouter un utilisateur</a>
              </div>
            </div>
            <div class="panel panel-default">


              <table class="table table-hover table-responsive">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col">Profil</th>

                    <th scope="col">Control</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $i = 1;
                  foreach ($data as $utilisateur) {
                  ?>
                    <tr>
                      <td> <?php echo  $i++; ?> </td>
                      <td><?php echo $utilisateur["login"]  ?></td>
                      <td> <?php echo $utilisateur["profil"] == 1 ? "Chef de scolarité" : "Agent" ?> </td>



                      <td>
                        <a href='edit.php?edit=user&id=<?php echo $utilisateur["iduser"] ?>' class='btn btn-sm btn-warning'>Modifier</a>

                        <form  method="post">
                          <input type="hidden" name="iduser" value="<?php echo $utilisateur["iduser"] ?>">
                          <input type="submit" name="delete_user" value="Suprimmer" class='btn btn-sm btn-danger'>
                         
                        </form>
                        

                      </td>
                    <?php
                    echo "</tr>";
                  }
                    ?>




                </tbody>
              </table>
              <?php

              if (isset($_POST["delete_user"])) {
                $sql = "DELETE  FROM `utilisateur` WHERE iduser = :id ";
                $query = $db_con->prepare($sql);

                $row = $query->bindParam(":id", $_POST["iduser"], PDO::PARAM_INT);
                $query->execute();
                echo "<script>window.location.href='utilisateurs.php'</script>";
                exit();
              }


              ?>

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