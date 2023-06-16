<?php
session_start();
require "connect.php";
    
      $q = $bdd->prepare("SELECT c.id_classe, f.lib_filiere, n.lib_niveau FROM segodo_classe c
                JOIN segodo_filiere f 
                JOIN segodo_niveau n 
                ON f.id_filiere = c.id_filiere 
                AND n.id_niveau = c.id_niveau");

        $req = $bdd->prepare("SELECT * FROM segodo_salle");

  if (isset($_POST['attribuer'])) { //On vérifie que le bouton envoyer a été actionné
      $top = 0;
      for ($i=1; $i <=18 ; $i++) { 
        $salleclasse = $_POST['salleclasse'.$i];

          if ((isset($salleclasse)) && (!empty($salleclasse))){
              $top = 1;
               $q = $bdd->prepare("UPDATE segodo_cours SET id_salle = ? WHERE id_classe = ?"); //on met à jour de la salle
                $q->execute(array($salleclasse, $i));
          }
      }

      if ($top == 0) {
        $erreur = "Vous n'aviez attribuer de salle à aucune classe !!!";
      }else{
        $erreur = "Affectation de salle réussi";
      }
      
  }
        
 ?>

<html>
    <head>
         <meta charset="utf-8">
       <title>IFRI Emploi du temps</title>
        <!-- importer le fichier de style -->
        
        <link rel="stylesheet" href="dist/css/bootstrap.min.css" media="screen" type="text/css" />
        <link href="css/sticky-footer-navbar.css" rel="stylesheet">
        <link href="fontawesome/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body class="d-flex flex-column h-100" id = "mapage"s>
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

        <!-- Formulaire de programmation -->
              <div class="container ">
                <form style="box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
                padding : 30px; margin-bottom: 200px; margin-top: -10px" method="post" action="" enctype="multipart/form-data">
              <!-- Tableau choisir cours -->
                  <div class="row">
                    <div class="col-md-8 " style="text-align: center-all;">
                        <?php if (isset($erreur)) { ?>
                          <div class="alert alert-danger" role="alert">
                            <?php echo $erreur; ?>
                          </div>
                        <?php } ?>
                      <table class="table table-hover alert alert-success table-bordered text-center">
                        <thead>
                          <tr>
                            <th scope="col">Classe</th>
                            <th scope="col">Sélectionner une salle</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $q->execute(); $i=1; while ($donnees = $q -> fetch()) {?>
                            <tr>
                              <th>
                                  <?php echo $donnees['lib_filiere'].' '.$donnees['lib_niveau']; ?>
                              </th>
                              <td>
                                <select class="form-select" aria-label="Default select example" name="<?php echo "salleclasse".$i; ?>">
                                  <option selected></option>
                                  <?php $req->execute(array()); while ($donnees = $req->fetch()) {?>
                                    <option value="<?php echo $donnees['id_salle']; ?>"><?php echo $donnees['lib_salle']; ?></option>
                                  <?php } ?>
                                </select>
                              </td>
                            </tr> 
                            <?php $i = $i + 1 ; ?>
                            <?php } ?>
                        </tbody>
                      </table>
                <input class="btn btn-success" type="submit" name="attribuer" value="Attribuer" />

                    </div>
                  </div>
                </form>

              </div>

        <script type="text/javascript" src="dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>