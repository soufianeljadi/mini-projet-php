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
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login - Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,600' rel='stylesheet' type='text/css'><link rel="stylesheet" href="login.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div id="back">
  <canvas id="canvas" class="canvas-back"></canvas>
  <div class="backRight">    
  </div>
  <div class="backLeft">
  </div>
</div>

<div id="slideBox">
  <div class="topLayer">
  
    <div class="right">
      <div class="content">
        <h2>Authentification</h2>
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
            header("location: gestion.php");
          } else {
            echo "<li class='alert alert-danger'>Email ou Mot de pass incorrecte!!</li>";
          }
        }
      }
      ?>
        <form id="form-login" method="post" >
          <div class="form-element form-stack">
            <label for="username-login" class="form-label">Email</label>
            <input id="username-login" type="email" name="email">
          </div>
          <div class="form-element form-stack">
            <label for="password-login" class="form-label">Password</label>
            <input id="password-login" type="password" name="password">
          </div>
          <div class="form-element form-submit">
            <button id="logIn" class="login" type="submit" name="login">Log In</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- 

Remixed from "Sliding Login Form" Codepen by
C-Rodg (github.com/C-Rodg)
https://codepen.io/crodg/pen/yNKxej

Remixed from "Paper.js - Animated Shapes Header" Codepen by
Connor Hubeny (@cooper_hu)
https://codepen.io/cooper_hu/pen/ybxoev

Custom Checkbox based on the blog post by
Mik Ted (@inserthtml):
https://www.inserthtml.com/2012/06/custom-form-radio-checkbox/

HTML5 Form Validation based on the blog post by
Thoriq Firdaus (@tfirdaus):
https://webdesign.tutsplus.com/tutorials/
html5-form-validation-with-the-pattern-attribute--cms-25145

-->
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/paper.js/0.11.3/paper-full.min.js'></script>
<script>
  /* ====================== *
 *  Toggle Between        *
 *  Sign Up / Login       *
 * ====================== */
$(document).ready(function(){
  $('#goRight').on('click', function(){
    $('#slideBox').animate({
      'marginLeft' : '0'
    });
    $('.topLayer').animate({
      'marginLeft' : '100%'
    });
  });
  $('#goLeft').on('click', function(){
    if (window.innerWidth > 769){
      $('#slideBox').animate({
        'marginLeft' : '50%'
      });
    }
    else {
      $('#slideBox').animate({
        'marginLeft' : '20%'
      });
    }
    $('.topLayer').animate({
      'marginLeft': '0'
    });
  });
});

/* ====================== *
 *  Initiate Canvas       *
 * ====================== */
paper.install(window);
paper.setup(document.getElementById("canvas"));

// Paper JS Variables
var canvasWidth, 
    canvasHeight,
    canvasMiddleX,
    canvasMiddleY;

var shapeGroup = new Group();

var positionArray = [];

function getCanvasBounds() {
  // Get current canvas size
  canvasWidth = view.size.width;
  canvasHeight = view.size.height;
  canvasMiddleX = canvasWidth / 2;
  canvasMiddleY = canvasHeight / 2;
  // Set path position
  var position1 = {
    x: (canvasMiddleX / 2) + 100,
    y: 100, 
  };

  var position2 = {
    x: 200,
    y: canvasMiddleY, 
  };

  var position3 = {
    x: (canvasMiddleX - 50) + (canvasMiddleX / 2),
    y: 150, 
  };

  var position4 = {
    x: 0,
    y: canvasMiddleY + 100, 
  };

  var position5 = {
    x: canvasWidth - 130,
    y: canvasHeight - 75, 
  };

  var position6 = {
    x: canvasMiddleX + 80,
    y: canvasHeight - 50, 
  };
  
  var position7 = {
    x: canvasWidth + 60,
    y: canvasMiddleY - 50, 
  };
  
  var position8 = {
    x: canvasMiddleX + 100,
    y: canvasMiddleY + 100, 
  };

  positionArray = [position3, position2, position5, position4, position1, position6, position7, position8];
  };


/* ====================== *
 * Create Shapes          *
 * ====================== */
function initializeShapes() {
  // Get Canvas Bounds
  getCanvasBounds();

  var shapePathData = [
    'M231,352l445-156L600,0L452,54L331,3L0,48L231,352', 
    'M0,0l64,219L29,343l535,30L478,37l-133,4L0,0z', 
    'M0,65l16,138l96,107l270-2L470,0L337,4L0,65z',
    'M333,0L0,94l64,219L29,437l570-151l-196-42L333,0',
    'M331.9,3.6l-331,45l231,304l445-156l-76-196l-148,54L331.9,3.6z',
    'M389,352l92-113l195-43l0,0l0,0L445,48l-80,1L122.7,0L0,275.2L162,297L389,352',
    'M 50 100 L 300 150 L 550 50 L 750 300 L 500 250 L 300 450 L 50 100',
    'M 700 350 L 500 350 L 700 500 L 400 400 L 200 450 L 250 350 L 100 300 L 150 50 L 350 100 L 250 150 L 450 150 L 400 50 L 550 150 L 350 250 L 650 150 L 650 50 L 700 150 L 600 250 L 750 250 L 650 300 L 700 350 '
  ];

  for (var i = 0; i <= shapePathData.length; i++) {
    // Create shape
    var headerShape = new Path({
      strokeColor: 'rgba(255, 255, 255, 0.5)',
      strokeWidth: 2,
      parent: shapeGroup,
    });
    // Set path data
    headerShape.pathData = shapePathData[i];
    headerShape.scale(2);
    // Set path position
    headerShape.position = positionArray[i];
  }
};

initializeShapes();

/* ====================== *
 * Animation              *
 * ====================== */
view.onFrame = function paperOnFrame(event) {
  if (event.count % 4 === 0) {
    // Slows down frame rate
    for (var i = 0; i < shapeGroup.children.length; i++) {
      if (i % 2 === 0) {
        shapeGroup.children[i].rotate(-0.1);
      } else {
        shapeGroup.children[i].rotate(0.1);
      }
    }
  }
};

view.onResize = function paperOnResize() {
  getCanvasBounds();

  for (var i = 0; i < shapeGroup.children.length; i++) {
    shapeGroup.children[i].position = positionArray[i];
  }

  if (canvasWidth < 700) {
    shapeGroup.children[3].opacity = 0;
    shapeGroup.children[2].opacity = 0;
    shapeGroup.children[5].opacity = 0;
  } else {
    shapeGroup.children[3].opacity = 1;
    shapeGroup.children[2].opacity = 1;
    shapeGroup.children[5].opacity = 1;
  }
};
</script>

</body>
</html>
