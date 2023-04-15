<?php 
session_start();
include "connexion.php";




if($_GET["del"]=="releve"){
  
$sql = "UPDATE `demande` set file_releve = NULL  WHERE idetud = :id";
$query = $db_con->prepare($sql);
$query->bindParam(':id', $_SESSION["user"]["idetud"], PDO::PARAM_INT);
$query->execute();
echo "<script>window.location = 'myspace.php'</script>";
}

if($_GET["del"]=="carte"){
  
$sql = "UPDATE `demande` set file_carte = NULL  WHERE idetud = :id";
$query = $db_con->prepare($sql);
$query->bindParam(':id', $_SESSION["user"]["idetud"], PDO::PARAM_INT);
$query->execute();
echo "<script>window.location = 'myspace.php'</script>";

}



?>