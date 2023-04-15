<!-- 
<pre>
<?php
session_start();
include "connexion.php";
if (!$_SESSION["connect"]) {
  header('Location: index.php');
}
?>

</pre> -->
<?php


//Releve Notes
$releve_note_name = $_FILES['releve_note']['name'];
$releve_note_extension = pathinfo($releve_note_name, PATHINFO_EXTENSION);
$releve_note_type = $_FILES['releve_note']['type'];
$releve_note_size = $_FILES['releve_note']['size'];
$releve_note_tmp = $_FILES['releve_note']['tmp_name'];

//Carte etudiant
$carte_etudiant_name = $_FILES['carte_etudiant']['name'];
$carte_etudiant_extension = pathinfo($carte_etudiant_name, PATHINFO_EXTENSION);
$carte_etudiant_type = $_FILES['carte_etudiant']['type'];
$carte_etudiant_size = $_FILES['carte_etudiant']['size'];
$carte_etudiant_tmp = $_FILES['carte_etudiant']['tmp_name'];

$name_re;
$name_ca;
//if($pdf_type != 'application/pdf')
//releve notes
if ($releve_note_size > 1024 * 1024 * 4) {
  echo "Error: File size exceeds the limit of 4MB.";
  exit();
} else {
  $name_re = $_POST["etudiant_nom"] . "_" .  $_POST["etudiant_prenom"] . "_releve";
  $upload_dir = "files_releve_carte/";
  echo "Size OK.";

  if (move_uploaded_file($releve_note_tmp, $upload_dir . $name_re . "." . $releve_note_extension)) {
    echo "releve de note uploaded successfully.<br>";
    $releve_permissions = fileperms("files_releve_carte/" . $name_re . "." .  $releve_note_extension);
    echo "<h2>Permissions du relevé de notes : " . decoct($releve_permissions) . "<br></h2>";
  } else {
    echo "Error uploading image.<br>";
  }
}

//Carte etudiant
if ($carte_etudiant_size > 1024 * 1024 * 3) {
  echo "Error: File size exceeds the limit of 3MB.<br>";
  die();
} else {
  $name_ca = $_POST["etudiant_nom"] . "_" .  $_POST["etudiant_prenom"] . "_carte";
  $upload_dir = "files_releve_carte/";
  echo "Size OK.<br>";
  if (move_uploaded_file($carte_etudiant_tmp, $upload_dir . $name_ca . "." . $carte_etudiant_extension)) {
    echo "carte etudiant uploaded successfully.";
    $carte_permissions = fileperms("files_releve_carte/" . $name_ca . "." .  $carte_etudiant_extension);
    echo "<h2>Permissions du Carte etudiant: " . decoct($carte_permissions) . "<br></h2>";
  } else {
    echo "Error uploading image.<br>";
  }
}

?>

<?php
  //INsert into DATABASE

  $sql = "INSERT INTO demande (idetud , datedemande, modulesdemandees,file_releve,file_carte,iduser ) VALUES (?,?,?,?,?,?)";
  $query= $db_con->prepare($sql);
  $releve = $name_re . "." . $releve_note_extension;
  $carte = $name_ca . "." . $carte_etudiant_extension;
  if(isset($_SESSION["data"]["modules"]) && isset($releve) && isset($carte) ){

    $query->execute([$_SESSION["user"]["idetud"], date("Y-m-d"),$_SESSION["data"]["modules"], $releve ,$carte,0]);
  }

header('Location: myspace.php');

?>