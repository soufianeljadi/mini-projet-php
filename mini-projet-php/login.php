<?php
include "connexion.php";
session_start();
if (@$_SESSION['connect_admin'] == true) {
  header('Location: gestion.php');
}
if (@$_SESSION['connect_agent'] == true) {
  header('Location: gestion.php');
}
if (@$_SESSION['connect']) {
  header('Location: myspace.php');
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Authentification Administrateur </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>

<body style="background: url(1200x680_image2.jpg) no-repeat;background-size: cover;height: 90vh;">
  <div class="container my-5">
  <div class="row col-6">
      <?php

      if (isset($_POST['login'])) {
        if ($_POST['email'] != "" || $_POST['password'] != "") {
          $email = trim($_POST['email']);
          
          $password = $_POST['password'];
          $sql = "SELECT * FROM `utilisateur` WHERE `login`=? AND `password`=? ";
          $query = $db_con->prepare($sql);
          $query->execute(array($email, $password));
          $row = $query->rowCount();
          $fetch = $query->fetch();
          $_SESSION["user"] = $fetch;
          if ($row > 0) {

            $_SESSION['user'] = $fetch;
            switch ($fetch["profil"]) {
              case 1:
                $_SESSION['connect_admin'] = true;
                $_SESSION['auth'] = true;
                break;
                
                case 0:
                  $_SESSION['auth'] = true;
                  $_SESSION['connect_agent'] = true;
                break;
            }
            //EVENT USER
            // $sql = "INSERT INTO `eventuser`  (iduser, dateevent, ipadress) VALUES (:iduser, :dateevent, :ipadress)";
            // $query = $db_con->prepare($sql);

            // $query->bindParam(':iduser', $_SESSION['user']["iduser"] , PDO::PARAM_INT);
            // $query->bindParam(':dateevent', date("d-m-Y"), PDO::PARAM_STR);
            // $query->bindParam(':ipadress', $_SERVER['REMOTE_ADDR'], PDO::PARAM_INT);

            // $query->execute();

            header("location: gestion.php");
            // echo "<script>window.location = 'gestion.php'</script>";

          } else {
            echo "<li class='alert alert-danger'>Invalid username or password</li>";
          }
        }
      }
      ?>
    </div>
    <div class="row ">
   
      <div class="col-6 card">
        <h1 class="card-header">Authentification</h1>
        <div class="card-body">
          <form method="POST">
            <a href="index.php" class="btn btn-sm btn-success">back</a>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>

            <button type="submit" class="btn btn-primary" name="login">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>