<?php
include "connexion.php";

session_start();
if(@$_SESSION['connect_admin']){
  header('Location: gestion.php');

}
if(@$_SESSION['connect_agent']){
  header('Location: gestion.php');

}
if (@$_SESSION['connect'] == true) {
  header('Location: myspace.php');
}






?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="style.css"> -->
</head>

<body>
  <!-- Section: Design Block -->
  <section class="background-radial-gradient overflow-hidden" style="min-height: 100vh">
    <style>
      .background-radial-gradient {
        background-color: hsl(218, 41%, 15%);
        background-image: radial-gradient(650px circle at 0% 0%,
            hsl(218, 41%, 35%) 15%,
            hsl(218, 41%, 30%) 35%,
            hsl(218, 41%, 20%) 75%,
            hsl(218, 41%, 19%) 80%,
            transparent 100%),
          radial-gradient(1250px circle at 100% 100%,
            hsl(218, 41%, 45%) 15%,
            hsl(218, 41%, 30%) 35%,
            hsl(218, 41%, 20%) 75%,
            hsl(218, 41%, 19%) 80%,
            transparent 100%);
      }

      #radius-shape-1 {
        height: 220px;
        width: 220px;
        top: -60px;
        left: -130px;
        background: radial-gradient(#44006b, #ad1fff);
        overflow: hidden;
      }

      #radius-shape-2 {
        border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
        bottom: -60px;
        right: -110px;
        width: 300px;
        height: 300px;
        background: radial-gradient(#44006b, #ad1fff);
        overflow: hidden;
      }

      .bg-glass {
        background-color: hsla(0, 0%, 100%, 0.9) !important;
        backdrop-filter: saturate(200%) blur(25px);
      }
    </style>

    <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
      <div class="row gx-lg-5 align-items-center mb-5">
        <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
          <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
            Espace <br />
            <span style="color: hsl(218, 81%, 75%)">Étudiant</span>
          </h1>

        </div>

        <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
          <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
          <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>
            <div>
              <?php 
              if (isset($_POST['login'])) {
                if ($_POST['datenaissance'] != null || $_POST['apogee'] != "") {
                  $datenaissance = $_POST['datenaissance'];
                  $apogee = $_POST['apogee'];
                  $sql = "SELECT * FROM `etudiant` WHERE `datenaissance`=? AND `apogee`=? ";
                  $query = $db_con->prepare($sql);
                  $query->execute(array($datenaissance, $apogee));
                  $row = $query->rowCount();
                  $fetch = $query->fetch();
                  if ($row > 0) {
                    $_SESSION['user'] = $fetch;
                    $_SESSION['connect'] = true;
              
                    header("location: myspace.php");
                  } else {
                    echo "<li class='alert alert-danger'>Date Naissance ou  Code Apogee sont incorectes !!.</li>";

               
                  }
                }
              }
              
              ?>
            </div>
          <div class="card bg-glass">
            <div class="card-body px-4 py-5 px-md-5">

              <form method="post">

                <div class="form-outline mb-4">
                  <input required type="date" id="form3Example3" class="form-control" name="datenaissance" />
                  <label class="form-label" for="form3Example3">Date Naissance</label>
                </div>
                <div class="form-outline mb-4">
                  <input required type="text" id="form3Example3" class="form-control" name="apogee" />
                  <label class="form-label" for="form3Example3">Code Apogee</label>
                </div>
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4" name="login">
                  Se connecte
                </button>

                <!-- Register buttons -->
                <div class="text-center">
                  <p>Administrateur ?</p>

                  <a href="login.php" class="btn btn-success">Connexion</a>



                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Design Block -->



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>

</html>