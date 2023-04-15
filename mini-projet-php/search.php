<?php 

include "connexion.php";
$search = '%'. $_GET["search"] .'%';
$sql = "SELECT * FROM `etudiant` WHERE filiere LIKE :search OR apogee LIKE :search";
$query = $db_con->prepare($sql);
$query->bindParam(':search', $search, PDO::PARAM_STR);
$query->execute();

$row = $query->rowCount();
$data = $query->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Result</title>
  <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
  <div class="container">
    <a href="etudiants.php" style="margin-top: 10px" class="btn btn-success">Back</a>
    <h2>Resultats</h2>
      
<table class="table table-hover table-responsive">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Prenom</th>
            <th scope="col">Code Apogee</th>
            <th scope="col">Date Naissance</th>
            <th scope="col">Filliere</th>
          </tr>
        </thead>
        <tbody>
          
            <?php
            $i=1;
            foreach ($data as $etudiant) {
              echo "<tr>";
              echo "<td>". $i++ ."</td>";
              echo "<td>". $etudiant["nom"] ."</td>";
              echo "<td>". $etudiant["prenom"] ."</td>";
              echo "<td>". $etudiant["apogee"] ."</td>";
              echo "<td>". $etudiant["datenaissance"] ."</td>";
              echo "<td>". $etudiant["filiere"] ."</td>";
           
              echo "</tr>";
            }
            ?>
          
         
          

        </tbody>
      </table>
  </div>
</body>
</html>