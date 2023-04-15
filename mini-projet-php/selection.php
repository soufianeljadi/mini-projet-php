<?php
session_start();
include "connexion.php";
if (!$_SESSION["connect"]) {
  header('Location: index.php');
}
?>

<?php
$modules = "";
$arr=[];
foreach ($_GET as  $module) {
  if ($module[0] == "m") {
    array_push($arr,$module);
    // $modules .= $module . " , ";
  }
}

// $ligne ="CODE APOGEE : " .  $_SESSION['user']["apogee"] . " | NOM : " . $_SESSION['user']["nom"] . " | PRENOM : " . $_SESSION['user']["prenom"]. " | MODULES : " . $modules;



$_SESSION["data"]["modules"] = implode("-", $arr); 



//iINSERT INTO FILES
// $fich = fopen("listedemandes.txt", "a");
// fwrite($fich, nl2br($ligne));
// fwrite($fich , "\n");
// fclose($fich);
// $demande =  "<h3 style='color: #4caf50;'>Votre demande a été bien enregistrée !</h3>";
// header('Location: index.php?message=' . urlencode($demande));
// exit();
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Documents</title>
  <style>
    input {
      padding: 6px;
    }
  </style>
</head>

<body class="container">
  <div style="display: flex;justify-content: space-between;">
    <h1>Upload Documents</h1>
    <div>
      <form action="deconnexion.php" method="post">
        <button style="background-color: #F44336;color: white;padding: 10px;border: none;cursor: pointer;" type="submit">Deconnexion</button>
      </form>
    </div>
  </div>
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="etudiant_nom" value="<?php echo $_SESSION['user']["nom"]?>">
    <input type="hidden" name="etudiant_prenom" value="<?php echo $_SESSION['user']["prenom"] ?>">
    <div class="input-group">
      <label>Releve de note</label>
      <input type="file" name="releve_note" accept=".pdf">
    </div>
    <div class="input-group">
      <label>Carte etudiant</label>
      <input type="file" name="carte_etudiant" accept=".jpg,.jpeg,.png">
    </div>
    <div class="input-group1">
      <input type="checkbox" name="confirmation" class="confirmation">
      <label>Je confirme ma demande</label>
    </div>
    <input type="submit" class="submit_btn" value="Envoyer ma demande" disabled>





  </form>
  <script>
    let confirmation_btn = document.querySelector(".confirmation");
    let submit_btn = document.querySelector(".submit_btn");
    confirmation_btn.addEventListener("change", function() {
      if (confirmation_btn.checked) {
        submit_btn.disabled = false;
      } else {
        submit_btn.disabled = true;

      }
    });
  </script>
</body>

</html>