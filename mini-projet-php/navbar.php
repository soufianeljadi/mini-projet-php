<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
    <div class="container bootstrap snippets bootdey">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-toggle"></span>
        </button>
        <a class="navbar-brand" href="gestion.php">Ecole Supérieure de Technologie Fkih Ben Salah</a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#">
              <i class="glyphicon glyphicon-user"></i>
              <?php
                echo isset($_SESSION['connect_admin']) ? "Chef de scolarité - " . $_SESSION['user']["login"] : "Agent - " . $_SESSION['user']["login"];
              ?>
              <span class="caret"></span></a>
            <ul id="g-account-menu" class="dropdown-menu" role="menu">
              <li><a href="deconnexion.php"><i class="glyphicon glyphicon-lock"></i> Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>