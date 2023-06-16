<?php 
session_start();
require "connect.php";

 ?>

 <!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <title>IFRI Emploi du temps</title>
      <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
        <link rel="stylesheet" href="dist/css/bootstrap.min.css" media="screen" type="text/css" />
        <link href="css/sticky-footer-navbar.css" rel="stylesheet">
        <link href="fontawesome/css/all.css" rel="stylesheet">
 </head>
 <body id="mapage">
    <header>
          <!-- Fixed navbar -->
          <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary" style="padding: 5px">
            <a class="navbar-brand bg-light" href="admin.php"><img src="img/logoIfri.png" style="width: 80px" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                  <li class="nav-item">
                    <a class="nav-link active h3" aria-current="page" href="admin.php">SCOLARITE IFRI</a>
                   </li>
                </ul>
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                  <li class="nav-item">
                    <a class="alert btn-success" aria-current="page" href="touslescours.php">Programme de la semaine</a>
                  </li>
                </ul>
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                  <li class="nav-item">
                    <a class="alert btn-success" aria-current="page" href="salle.php">Gérer salle</a>
                  </li>
                </ul>
                <form class="d-flex h4 text-light">
                  <button class="btn btn-danger">
                    <a style="text-decoration: none" class="text-light" href="deconnexion.php">
                        <i class="fas fa-power-off"></i> Logout
                    </a>
                  </button>
                </form>
              </div>
          </nav>
        </header>


    <div class="container" style="padding-top: 100px;">
        <div class="row">
            <div class="col-md-2" ></div>
                <div class="col-md-8 alert, alert-success" style="text-align: justify;" id="admin">
                    <p >Bienvenue adminstrateur. Pour attribuer des salles de cours, allez dans l'onglet Gérer salle. Vous pouvez aussi visualiser les cours programmés par les profs dans le menu Programme de la semaine.</p>
                </div>
            <div class="col-md-2"></div>
        </div>
    </div>


<script type="text/javascript" src="dist/js/bootstrap.bundle.min.js"></script>
 </body>
 </html>