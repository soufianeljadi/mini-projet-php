<?php



function eventuser() {
  include "connexion.php";

  $iduser = $_SESSION["user"]["iduser"];
  $dateevent = date("Y-m-d");
  $ipadress = $_SERVER['REMOTE_ADDR'];

  $statut = 1;
  $sql = "INSERT INTO `eventuser`  (iduser, dateevent, ipadress) VALUES (:iduser, :dateevent, :ipadress)";
  $query = $db_con->prepare($sql);

  $query->bindParam(':iduser', $iduser, PDO::PARAM_INT);
  $query->bindParam(':dateevent', $dateevent, PDO::PARAM_STR);
  $query->bindParam(':ipadress', $ipadress, PDO::PARAM_STR);

  $query->execute();
  return "EVENT USER FUNCTION DONE";

}

?>