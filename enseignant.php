<?php
session_start();
$iduser = $_SESSION['id_user']; 
require "connect.php";
$jours = array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi");
$days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
		
	    $q = $bdd->prepare("SELECT c.id_classe, f.lib_filiere, n.lib_niveau FROM segodo_classe c
								JOIN segodo_filiere f 
								JOIN segodo_niveau n 
								ON f.id_filiere = c.id_filiere 
								AND n.id_niveau = c.id_niveau");

        $req = $bdd->prepare("SELECT me.id_mat_enseigner, m.lib_mat
								FROM segodo_matiere_enseigner me
								JOIN segodo_utilisateur u
								JOIN segodo_matiere m 
								ON me.id_user = u.id_user
								AND m.cod_mat = me.cod_mat
								WHERE u.matricule = ?");
		//recupérer chaque jour de la semaine
        $jour1 = $bdd->prepare("SELECT lib_jour FROM segodo_jour WHERE id_jour = 1");
        $jour2 = $bdd->prepare("SELECT lib_jour FROM segodo_jour WHERE id_jour = 2");
        $jour3 = $bdd->prepare("SELECT lib_jour FROM segodo_jour WHERE id_jour = 3");
        $jour4 = $bdd->prepare("SELECT lib_jour FROM segodo_jour WHERE id_jour = 4");
        $jour5 = $bdd->prepare("SELECT lib_jour FROM segodo_jour WHERE id_jour = 5");
        //recuperer les heures
        $heure1 = $bdd->prepare("SELECT heure FROM segodo_horaire WHERE id_horaire = 1");
        $heure2 = $bdd->prepare("SELECT heure FROM segodo_horaire WHERE id_horaire = 2");
        
 ?>

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
    <body class="d-flex flex-column h-100" id="mapage">
    	<header>
	      <!-- Fixed navbar -->
	      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary" style="padding: 5px">
	        <a class="navbar-brand bg-light" href="enseignant.php"><img src="img/logoIfri.png" style="width: 80px" /></a>
	        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
	          <span class="navbar-toggler-icon"></span>
	        </button>
	        <div class="collapse navbar-collapse" id="navbarCollapse">
		        <ul class="navbar-nav me-auto mb-2 mb-md-0">
		          <li class="nav-item">
		            <a class="nav-link active h3" aria-current="page" href="enseignant.php">SCOLARITE IFRI</a>
		           </li>
		        </ul>
		        <ul class="navbar-nav me-auto mb-2 mb-md-0">
		          <li class="nav-item">
		            <a class="alert btn-success" aria-current="page" href="mescours.php">Mes Cours</a>
		          </li>
		        </ul>
		        <ul class="navbar-nav me-auto mb-2 mb-md-0">
                  <li class="nav-item">
                    <a class="alert btn-success" aria-current="page" href="toutcoursprof.php">Programmes récents</a>
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

                  <!-- message de bienvenue -->
                  <div class="container" style="padding-top: 100px, padding-bottom: 100px;">
            			<div class="row" style="padding-top: 30px;">
            				<div class="col-md- alert alert-success" style="font-weight: bold;">

            					<?php
			                    if(isset($_SESSION['nom'])) {
			                        echo "<p>Hello monsieur ".$_SESSION['nom'].".<br/>Bienvenue sur votre plateforme de programmation des cours pour l'ifri. Pour définir un programme de cours, il vous suffit de choisir la classe, ensuite choisir la matière à enseigner en fonction de vos disponibilités. Dans le menu Programmes récents vous pouvez déja voir les cours programmés par les autres profs et avoir une idée des heures libres.</p>" ;
			                    }
               				 ?>
            				</div>
            			</div>
            	</div>
            
        <!-- Formulaire de programmation -->
            	<div class="container ">
            		<form style="box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
            		padding : 30px; margin-bottom: 200px; margin-top: -10px" method="post" action="validate.php" enctype="multipart/form-data" class="alert alert-sucess">
            	<!-- Select Classe -->
            			<div class="row ">
		            		<div class="col-md-12">

		            			<div class="h3 text-center text-dark border bg-light">PROGRAMME</div>
		            			<select class="form-select" aria-label="Default select example" name="idclasse" id="idclasse">
										  <option value="0" selected>Classe</option>
										  <?php $q->execute(); while ($donnees = $q -> fetch()) {?>
										  	<option value="<?php echo $donnees['id_classe'] ?>">
										  		<?php echo $donnees['lib_filiere'].' '.$donnees['lib_niveau']; ?>
										  	</option>
										  <?php } ?>
								 </select>
		            		</div>
            			</div> <br/>
            	<!-- Tableau choisir cours -->
            			<div class="row">
            				<div class="col-md-12">
		            			<table class="table table-hover table-dark text-center">
								  <thead>
								    <tr>

								      <th scope="col">Horaire</th>
								      <?php for ($i=0; $i < 5; $i++) { ?>
								      	<th scope="col"><?php echo $jours[$i]; ?><input type="hidden" name="<?php echo "date".$i; ?>" style="font-weight: bold; text-align: center; border: none;" value="<?php echo strtotime("next ".$days[$i]);?>" size="10"></th>
								  	  <?php } ?>
				
								    </tr>
								  </thead>
								  <tbody>
								    <tr>
								      <th scope="col">08h - 12h</th>
								      <td>
								      	<select class="form-select" aria-label="Default select example" name="matlundi8">
										  <option selected></option>
										  <?php $req->execute(array($_SESSION['matricule'])); while ($donnees = $req->fetch()) {?>
										  	<option value="<?php echo $donnees['id_mat_enseigner']; ?>"><?php echo $donnees['lib_mat']; ?></option>
										  <?php } ?>
										</select>
								      </td>
								      <td>
								      	<select class="form-select" aria-label="Default select example" name="matmardi8">
										  <option selected></option>
										  <?php $req->execute(array($_SESSION['matricule'])); while ($donnees = $req->fetch()) {?>
										  	<option value="<?php echo $donnees['id_mat_enseigner']; ?>"><?php echo $donnees['lib_mat']; ?></option>
										  <?php } ?>
										</select>
								      </td>
								      <td>
								      	<select class="form-select" aria-label="Default select example" name="matmercredi8">
										  <option selected></option>
										  <?php $req->execute(array($_SESSION['matricule'])); while ($donnees = $req->fetch()) {?>
										  	<option value="<?php echo $donnees['id_mat_enseigner']; ?>"><?php echo $donnees['lib_mat']; ?></option>
										  <?php } ?>
										</select>
								      </td>
								      <td>
								      	<select class="form-select" aria-label="Default select example" name="matjeudi8">
										  <option selected></option>
										  <?php $req->execute(array($_SESSION['matricule'])); while ($donnees = $req->fetch()) {?>
										  	<option value="<?php echo $donnees['id_mat_enseigner']; ?>"><?php echo $donnees['lib_mat']; ?></option>
										  <?php } ?>
										</select>
								      </td>
								      <td>
								      	<select class="form-select" aria-label="Default select example" name="matvendredi8">
										  <option selected></option>
										  <?php $req->execute(array($_SESSION['matricule'])); while ($donnees = $req->fetch()) {?>
										  	<option value="<?php echo $donnees['id_mat_enseigner']; ?>"><?php echo $donnees['lib_mat']; ?></option>
										  <?php } ?>
										</select>
								      </td>
								    </tr>

								    <tr>
								       <th scope="col">14h - 18h</th>
								      <td>
								      	<select class="form-select" aria-label="Default select example" name="matlundi14">
										  <option selected></option>
										  <?php $req->execute(array($_SESSION['matricule'])); while ($donnees = $req->fetch()) {?>
										  	<option value="<?php echo $donnees['id_mat_enseigner']; ?>"><?php echo $donnees['lib_mat']; ?></option>
										  <?php } ?>
										</select>
								      </td>
								      <td>
								      	<select class="form-select" aria-label="Default select example" name="matmardi14">
										  <option selected></option>
										  <?php $req->execute(array($_SESSION['matricule'])); while ($donnees = $req->fetch()) {?>
										  	<option value="<?php echo $donnees['id_mat_enseigner']; ?>"><?php echo $donnees['lib_mat']; ?></option>
										  <?php } ?>
										</select>
								      </td>
								      <td>
								      	<select class="form-select" aria-label="Default select example" name="matmercredi14">
										  <option selected></option>
										  <?php $req->execute(array($_SESSION['matricule'])); while ($donnees = $req->fetch()) {?>
										  	<option value="<?php echo $donnees['id_mat_enseigner']; ?>"><?php echo $donnees['lib_mat']; ?></option>
										  <?php } ?>
										</select>
								      </td>
								      <td>
								      	<select class="form-select" aria-label="Default select example" name="matjeudi14">
										  <option selected></option>
										  <?php $req->execute(array($_SESSION['matricule'])); while ($donnees = $req->fetch()) {?>
										  	<option value="<?php echo $donnees['id_mat_enseigner']; ?>"><?php echo $donnees['lib_mat']; ?></option>
										  <?php } ?>
										</select>
								      </td>
								      <td>
								      	<select class="form-select" aria-label="Default select example" name="matvendredi14">
										  <option selected></option>
										  <?php $req->execute(array($_SESSION['matricule'])); while ($donnees = $req->fetch()) {?>
										  	<option value="<?php echo $donnees['id_mat_enseigner']; ?>"><?php echo $donnees['lib_mat']; ?></option>
										  <?php } ?>
										</select>
								      </td>
								    </tr>
								  </tbody>
								</table>
								<input class="btn btn-success" type="submit" name="submit" value="Soumettre" />

	            			</div>
            			</div>
            		</form>

            	</div>


        <script type="text/javascript" src="dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>