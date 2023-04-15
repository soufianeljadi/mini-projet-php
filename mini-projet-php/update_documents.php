<?php
session_start();
include "connexion.php";
if (isset($_POST["save_releve"])) {
  //Releve Notes
  $releve_note_name = $_FILES['releve_note']['name'];
  $releve_note_extension = pathinfo($releve_note_name, PATHINFO_EXTENSION);
  $releve_note_type = $_FILES['releve_note']['type'];
  $releve_note_size = $_FILES['releve_note']['size'];
  $releve_note_tmp = $_FILES['releve_note']['tmp_name'];
  $name_re;
  if ($releve_note_size > 1024 * 1024 * 4) {
    echo "Error: File size exceeds the limit of 4MB.";
    exit();
  } else {
    $name_re = $_SESSION["user"]["nom"] . "_" .  $_SESSION["user"]["prenom"] . "_releve". "." . $releve_note_extension;
    $upload_dir = "files_releve_carte/";
    echo "Size OK.";

    if (move_uploaded_file($releve_note_tmp, $upload_dir . $name_re )) {
      echo "<li class'alert alert-success'>releve de note uploaded successfully.<br></li>";
      $sql = "UPDATE  demande set file_releve = :name_re where idetud = :idetud";
      $query= $db_con->prepare($sql);
      $query->bindParam(':name_re', $name_re, PDO::PARAM_STR);
      $query->bindParam(':idetud', $_SESSION["user"]["idetud"], PDO::PARAM_INT);
      $query->execute();
      echo "<script>window.location = 'myspace.php'</script>";

    
    
    } else {
      echo "Error uploading image.<br>";
    }
  }
  
}
if (isset($_POST["save_carte"])) {
  //Releve Notes
  $carte_etudiant_name = $_FILES['carte_etudiant']['name'];
  $carte_etudiant_extension = pathinfo($carte_etudiant_name, PATHINFO_EXTENSION);
  $carte_etudiant_type = $_FILES['carte_etudiant']['type'];
  $carte_etudiant_size = $_FILES['carte_etudiant']['size'];
  $carte_etudiant_tmp = $_FILES['carte_etudiant']['tmp_name'];
  $name_re;
  if ($carte_etudiant_size > 1024 * 1024 * 4) {
    echo "Error: File size exceeds the limit of 4MB.";
    exit();
  } else {
    $name_re = $_SESSION["user"]["nom"] . "_" .  $_SESSION["user"]["prenom"] . "_carte". "." . $carte_etudiant_extension;
    $upload_dir = "files_releve_carte/";
    echo "Size OK.";

    if (move_uploaded_file($carte_etudiant_tmp, $upload_dir . $name_re )) {
      echo "<li class'alert alert-success'>Carte uploaded successfully.<br></li>";
      $sql = "UPDATE  demande set file_carte = :name_re where idetud = :idetud";
      $query= $db_con->prepare($sql);
      $query->bindParam(':name_re', $name_re, PDO::PARAM_STR);
      $query->bindParam(':idetud', $_SESSION["user"]["idetud"], PDO::PARAM_INT);
      $query->execute();
      echo "<script>window.location = 'myspace.php'</script>";

    
    
    } else {
      echo "Error uploading image.<br>";
    }
  }
  
}
