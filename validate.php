<?php
session_start(); 
	require "connect.php";
	

	if (isset($_POST['submit'])) { //On vérifie que le bouton envoyer a été actionné

		$idmatlundi8 = $_POST['matlundi8'];
		$idmatmardi8 = $_POST['matmardi8'];
		$idmatmercredi8 = $_POST['matmercredi8'];
		$idmatjeudi8 = $_POST['matjeudi8'];
		$idmatvendredi8 = $_POST['matvendredi8'];
		$idmatlundi14 = $_POST['matlundi14'];
		$idmatmardi14 = $_POST['matmardi14'];
		$idmatmercredi14 = $_POST['matmercredi14'];
		$idmatjeudi14 = $_POST['matjeudi14'];
		$idmatvendredi14 = $_POST['matvendredi14'];
		$idclasse = $_POST['idclasse'];
		$date1 = $_POST['date0'];
		$date2 = $_POST['date1'];
		$date3 = $_POST['date2'];
		$date4 = $_POST['date3'];
		$date5 = $_POST['date4'];

//On vérifie s'il n'y a pas déja un programme dans la base de donnée pour la classe donné le lundi de 8h à 12h.
		if ((isset($idmatlundi8)) && (!empty($idmatlundi8)) && $idclasse != 0) {

			$date = $date1;
			$horaire = 1;
			$matiere = $idmatlundi8;

			$req = $bdd->prepare("SELECT * FROM segodo_cours c WHERE c.id_classe = ? AND c.dates = ? AND c.id_horaire = ?");
			$req->execute(array($idclasse, $date, $horaire));
			$programme = $req->rowCount();

			if ($programme == 0){
				//echo $idclasse." ".$matiere." ".$horaire." ".$date;
				//echo $programme;
				$q = $bdd->prepare("INSERT INTO segodo_cours (id_classe, id_mat_enseigner, dates, id_horaire ) VALUES (?, ?, ?, ?)");
				$q->execute(array($idclasse, $matiere, $date , $horaire));
				$message = "Programme sauvegardé";

			}else{
				$q = $bdd->prepare("SELECT c.id_classe, f.lib_filiere, n.lib_niveau FROM segodo_classe c
								JOIN segodo_filiere f 
								JOIN segodo_niveau n 
								ON f.id_filiere = c.id_filiere 
								AND n.id_niveau = c.id_niveau
								WHERE c.id_classe = ?");
				$q->execute(array($idclasse));
				$donnees = $q -> fetch();
				$erreur0 = $donnees['lib_filiere'].' '.$donnees['lib_niveau'].' a déjà un programme de cours pour le '.jourdelasemaine($date).' '.horaire($horaire).' .Changer le programme pour ce jour.';

			}
		}
//On vérifie s'il n'y a pas déja un programme dans la base de donnée pour la classe donné le lundi de 14h à 18h.
		if ((isset($idmatlundi14)) && (!empty($idmatlundi14)) && $idclasse != 0) {

			$date = $date1;
			$horaire = 2;
			$matiere = $idmatlundi14;

			$req = $bdd->prepare("SELECT * FROM segodo_cours c WHERE c.id_classe = ? AND c.dates = ? AND c.id_horaire = ?");
			$req->execute(array($idclasse, $date, $horaire));
			$programme = $req->rowCount();

			if ($programme == 0){
				//echo $idclasse." ".$matiere." ".$horaire." ".$date;
				//echo $programme;
				$q = $bdd->prepare("INSERT INTO segodo_cours (id_classe, id_mat_enseigner, dates, id_horaire ) VALUES (?, ?, ?, ?)");
				$q->execute(array($idclasse, $matiere, $date , $horaire));
				$message = "Programme sauvegardé";

			}else{
				$q = $bdd->prepare("SELECT c.id_classe, f.lib_filiere, n.lib_niveau FROM segodo_classe c
								JOIN segodo_filiere f 
								JOIN segodo_niveau n 
								ON f.id_filiere = c.id_filiere 
								AND n.id_niveau = c.id_niveau
								WHERE c.id_classe = ?");
				$q->execute(array($idclasse));
				$donnees = $q -> fetch();
				$erreur1 = $donnees['lib_filiere'].' '.$donnees['lib_niveau'].' a déjà un programme de cours pour le '.jourdelasemaine($date).' '.horaire($horaire).' .Changer le programme pour ce jour.';

			}
		}

//On vérifie s'il n'y a pas déja un programme dans la base de donnée pour la classe donné le mardi de 8h à 12h.
		if ((isset($idmatmardi8)) && (!empty($idmatmardi8)) && $idclasse != 0) {

			$date = $date2;
			$horaire = 1;
			$matiere = $idmatmardi8;

			$req = $bdd->prepare("SELECT * FROM segodo_cours c WHERE c.id_classe = ? AND c.dates = ? AND c.id_horaire = ?");
			$req->execute(array($idclasse, $date, $horaire));
			$programme = $req->rowCount();

			if ($programme == 0){
				//echo $idclasse." ".$matiere." ".$horaire." ".$date;
				//echo $programme;
				$q = $bdd->prepare("INSERT INTO segodo_cours (id_classe, id_mat_enseigner, dates, id_horaire ) VALUES (?, ?, ?, ?)");
				$q->execute(array($idclasse, $matiere, $date , $horaire));
				$message = "Programme sauvegardé";

			}else{
				$q = $bdd->prepare("SELECT c.id_classe, f.lib_filiere, n.lib_niveau FROM segodo_classe c
								JOIN segodo_filiere f 
								JOIN segodo_niveau n 
								ON f.id_filiere = c.id_filiere 
								AND n.id_niveau = c.id_niveau
								WHERE c.id_classe = ?");
				$q->execute(array($idclasse));
				$donnees = $q -> fetch();
				$erreur2 = $donnees['lib_filiere'].' '.$donnees['lib_niveau'].' a déjà un programme de cours pour le '.jourdelasemaine($date).' '.horaire($horaire).' .Changer le programme pour ce jour.';

			}
		}
//On vérifie s'il n'y a pas déja un programme dans la base de donnée pour la classe donné le mardi de 14h à 18h.
		if ((isset($idmatmardi14)) && (!empty($idmatmardi14)) && $idclasse != 0) {

			$date = $date2;
			$horaire = 2;
			$matiere = $idmatmardi14;

			$req = $bdd->prepare("SELECT * FROM segodo_cours c WHERE c.id_classe = ? AND c.dates = ? AND c.id_horaire = ?");
			$req->execute(array($idclasse, $date, $horaire));
			$programme = $req->rowCount();

			if ($programme == 0){
				//echo $idclasse." ".$matiere." ".$horaire." ".$date;
				//echo $programme;
				$q = $bdd->prepare("INSERT INTO segodo_cours (id_classe, id_mat_enseigner, dates, id_horaire ) VALUES (?, ?, ?, ?)");
				$q->execute(array($idclasse, $matiere, $date , $horaire));
				$message = "Programme sauvegardé";

			}else{
				$q = $bdd->prepare("SELECT c.id_classe, f.lib_filiere, n.lib_niveau FROM segodo_classe c
								JOIN segodo_filiere f 
								JOIN segodo_niveau n 
								ON f.id_filiere = c.id_filiere 
								AND n.id_niveau = c.id_niveau
								WHERE c.id_classe = ?");
				$q->execute(array($idclasse));
				$donnees = $q -> fetch();
				$erreur3 = $donnees['lib_filiere'].' '.$donnees['lib_niveau'].' a déjà un programme de cours pour le '.jourdelasemaine($date).' '.horaire($horaire).' .Changer le programme pour ce jour.';

			}
		}
		//On vérifie s'il n'y a pas déja un programme dans la base de donnée pour la classe donnée le mercredi de 8h à 12h.
		if ((isset($idmatmercredi8)) && (!empty($idmatmercredi8)) && $idclasse != 0) {

			$date = $date3;
			$horaire = 1;
			$matiere = $idmatmercredi8;

			$req = $bdd->prepare("SELECT * FROM segodo_cours c WHERE c.id_classe = ? AND c.dates = ? AND c.id_horaire = ?");
			$req->execute(array($idclasse, $date, $horaire));
			$programme = $req->rowCount();

			if ($programme == 0){
				//echo $idclasse." ".$matiere." ".$horaire." ".$date;
				//echo $programme;
				$q = $bdd->prepare("INSERT INTO segodo_cours (id_classe, id_mat_enseigner, dates, id_horaire ) VALUES (?, ?, ?, ?)");
				$q->execute(array($idclasse, $matiere, $date , $horaire));
				$message = "Programme sauvegardé";

			}else{
				$q = $bdd->prepare("SELECT c.id_classe, f.lib_filiere, n.lib_niveau FROM segodo_classe c
								JOIN segodo_filiere f 
								JOIN segodo_niveau n 
								ON f.id_filiere = c.id_filiere 
								AND n.id_niveau = c.id_niveau
								WHERE c.id_classe = ?");
				$q->execute(array($idclasse));
				$donnees = $q -> fetch();
				$erreur4 = $donnees['lib_filiere'].' '.$donnees['lib_niveau'].' a déjà un programme de cours pour le '.jourdelasemaine($date).' '.horaire($horaire).' .Changer le programme pour ce jour.';

			}
		}
//On vérifie s'il n'y a pas déja un programme dans la base de donnée pour la classe donné le mercredi de 14h à 18h.
		if ((isset($idmatmercredi14)) && (!empty($idmatmercredi14)) && $idclasse != 0) {

			$date = $date3;
			$horaire = 2;
			$matiere = $idmatmercredi14;

			$req = $bdd->prepare("SELECT * FROM segodo_cours c WHERE c.id_classe = ? AND c.dates = ? AND c.id_horaire = ?");
			$req->execute(array($idclasse, $date, $horaire));
			$programme = $req->rowCount();

			if ($programme == 0){
			//	echo $idclasse." ".$matiere." ".$horaire." ".$date;
			//	echo $programme;
				$q = $bdd->prepare("INSERT INTO segodo_cours (id_classe, id_mat_enseigner, dates, id_horaire ) VALUES (?, ?, ?, ?)");
				$q->execute(array($idclasse, $matiere, $date , $horaire));
				$message = "Programme sauvegardé";

			}else{
				$q = $bdd->prepare("SELECT c.id_classe, f.lib_filiere, n.lib_niveau FROM segodo_classe c
								JOIN segodo_filiere f 
								JOIN segodo_niveau n 
								ON f.id_filiere = c.id_filiere 
								AND n.id_niveau = c.id_niveau
								WHERE c.id_classe = ?");
				$q->execute(array($idclasse));
				$donnees = $q -> fetch();
				$erreur5 = $donnees['lib_filiere'].' '.$donnees['lib_niveau'].' a déjà un programme de cours pour le '.jourdelasemaine($date).' '.horaire($horaire).' .Changer le programme pour ce jour.';

			}
		}
		//On vérifie s'il n'y a pas déja un programme dans la base de donnée pour la classe donnée le jeudi de 8h à 12h.
		if ((isset($idmatjeudi8)) && (!empty($idmatjeudi8)) && $idclasse != 0) {

			$date = $date4;
			$horaire = 1;
			$matiere = $idmatjeudi8;

			$req = $bdd->prepare("SELECT * FROM segodo_cours c WHERE c.id_classe = ? AND c.dates = ? AND c.id_horaire = ?");
			$req->execute(array($idclasse, $date, $horaire));
			$programme = $req->rowCount();

			if ($programme == 0){
				//echo $idclasse." ".$matiere." ".$horaire." ".$date;
				//echo $programme;
				$q = $bdd->prepare("INSERT INTO segodo_cours (id_classe, id_mat_enseigner, dates, id_horaire ) VALUES (?, ?, ?, ?)");
				$q->execute(array($idclasse, $matiere, $date , $horaire));
				$message = "Programme sauvegardé";

			}else{
				$q = $bdd->prepare("SELECT c.id_classe, f.lib_filiere, n.lib_niveau FROM segodo_classe c
								JOIN segodo_filiere f 
								JOIN segodo_niveau n 
								ON f.id_filiere = c.id_filiere 
								AND n.id_niveau = c.id_niveau
								WHERE c.id_classe = ?");
				$q->execute(array($idclasse));
				$donnees = $q -> fetch();
				$erreur6 = $donnees['lib_filiere'].' '.$donnees['lib_niveau'].' a déjà un programme de cours pour le '.jourdelasemaine($date).' '.horaire($horaire).' .Changer le programme pour ce jour.';

			}
		}
//On vérifie s'il n'y a pas déja un programme dans la base de donnée pour la classe donné le jeudi de 14h à 18h.
		if ((isset($idmatjeudi14)) && (!empty($idmatjeudi14)) && $idclasse != 0) {

			$date = $date4;
			$horaire = 2;
			$matiere = $idmatjeudi14;

			$req = $bdd->prepare("SELECT * FROM segodo_cours c WHERE c.id_classe = ? AND c.dates = ? AND c.id_horaire = ?");
			$req->execute(array($idclasse, $date, $horaire));
			$programme = $req->rowCount();

			if ($programme == 0){
				//echo $idclasse." ".$matiere." ".$horaire." ".$date;
				//echo $programme;
				$q = $bdd->prepare("INSERT INTO segodo_cours (id_classe, id_mat_enseigner, dates, id_horaire ) VALUES (?, ?, ?, ?)");
				$q->execute(array($idclasse, $matiere, $date , $horaire));
				$message = "Programme sauvegardé";

			}else{
				$q = $bdd->prepare("SELECT c.id_classe, f.lib_filiere, n.lib_niveau FROM segodo_classe c
								JOIN segodo_filiere f 
								JOIN segodo_niveau n 
								ON f.id_filiere = c.id_filiere 
								AND n.id_niveau = c.id_niveau
								WHERE c.id_classe = ?");
				$q->execute(array($idclasse));
				$donnees = $q -> fetch();
				$erreur7 = $donnees['lib_filiere'].' '.$donnees['lib_niveau'].' a déjà un programme de cours pour le '.jourdelasemaine($date).' '.horaire($horaire).' .Changer le programme pour ce jour.';

			}
		}
		//On vérifie s'il n'y a pas déja un programme dans la base de donnée pour la classe donnée le vendredi de 8h à 12h.
		if ((isset($idmatvendredi8)) && (!empty($idmatvendredi8)) && $idclasse != 0) {

			$date = $date5;
			$horaire = 1;
			$matiere = $idmatvendredi8;

			$req = $bdd->prepare("SELECT * FROM segodo_cours c WHERE c.id_classe = ? AND c.dates = ? AND c.id_horaire = ?");
			$req->execute(array($idclasse, $date, $horaire));
			$programme = $req->rowCount();

			if ($programme == 0){
				//echo $idclasse." ".$matiere." ".$horaire." ".$date;
				//echo $programme;
				$q = $bdd->prepare("INSERT INTO segodo_cours (id_classe, id_mat_enseigner, dates, id_horaire ) VALUES (?, ?, ?, ?)");
				$q->execute(array($idclasse, $matiere, $date , $horaire));
				$message = "Programme sauvegardé";

			}else{
				$q = $bdd->prepare("SELECT c.id_classe, f.lib_filiere, n.lib_niveau FROM segodo_classe c
								JOIN segodo_filiere f 
								JOIN segodo_niveau n 
								ON f.id_filiere = c.id_filiere 
								AND n.id_niveau = c.id_niveau
								WHERE c.id_classe = ?");
				$q->execute(array($idclasse));
				$donnees = $q -> fetch();
				$erreur8 = $donnees['lib_filiere'].' '.$donnees['lib_niveau'].' a déjà un programme de cours pour le '.jourdelasemaine($date).' '.horaire($horaire).' .Changer le programme pour ce jour.';

			}
		}
//On vérifie s'il n'y a pas déja un programme dans la base de donnée pour la classe donné le vendredi de 14h à 18h.
		if ((isset($idmatvendredi14)) && (!empty($idmatvendredi14)) && $idclasse != 0) {

			$date = $date5;
			$horaire = 2;
			$matiere = $idmatvendredi14;

			$req = $bdd->prepare("SELECT * FROM segodo_cours c WHERE c.id_classe = ? AND c.dates = ? AND c.id_horaire = ?");
			$req->execute(array($idclasse, $date, $horaire));
			$programme = $req->rowCount();

			if ($programme == 0){
				//echo $idclasse." ".$matiere." ".$horaire." ".$date;
				//echo $programme;
				$q = $bdd->prepare("INSERT INTO segodo_cours (id_classe, id_mat_enseigner, dates, id_horaire ) VALUES (?, ?, ?, ?)");
				$q->execute(array($idclasse, $matiere, $date , $horaire));
				$message = "Programme sauvegardé";

			}else{
				$q = $bdd->prepare("SELECT c.id_classe, f.lib_filiere, n.lib_niveau FROM segodo_classe c
								JOIN segodo_filiere f 
								JOIN segodo_niveau n 
								ON f.id_filiere = c.id_filiere 
								AND n.id_niveau = c.id_niveau
								WHERE c.id_classe = ?");
				$q->execute(array($idclasse));
				$donnees = $q -> fetch();
				$erreur9 = $donnees['lib_filiere'].' '.$donnees['lib_niveau'].' a déjà un programme de cours pour le '.jourdelasemaine($date).' '.horaire($horaire).' .Changer le programme pour ce jour.';

			}
		}
	}

	function jourdelasemaine($date) {
		$jour=date("w", $date);
		switch ($jour) {
			case '1':
				return "Lundi";
				break;
			case '2':
				return "Mardi";
				break;
			case '3':
				return "Mercredi";
				break;
			case '4':
				return "Jeudi";
				break;
			default :
				return "Vendredi";
				break;
		}
	}

	function horaire($id) {
		switch ($id) {
			case '1':
				return "08h - 12h";
				break;
			
			default:
				return "14h - 18h";
				break;
		}
	}
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
    	
    	<div class="container-fluide" style="padding-top: 100px, height : 1000px, padding-bottom: 100px;">
    		<form>
    		<div class="row ">
    			<div class="col-md-2"></div>
    			<div class="col-md-8" style=" padding-top: 100px;">  				
			    	<?php if (isset($message)) { ?>
					 	<div class="alert alert-success" role="alert" style="font-weight: bold;">
					 		<?php echo $message; ?>
					 	</div>
					 <?php } ?>

					 <?php if (isset($erreur0)) { ?>
					 	<div class="alert alert-danger" role="alert" style="font-weight: bold;">
					 		<?php echo $erreur0;	?>
					 	</div>
					 <?php } ?>

					 <?php if (isset($erreur1)) { ?>
					 	<div class="alert alert-danger" role="alert" style="font-weight: bold;">
					 		<?php echo $erreur1;	?>
					 	</div>
					 <?php } ?>

					 <?php if (isset($erreur2)) { ?>
					 	<div class="alert alert-danger" role="alert" style="font-weight: bold;">
					 		<?php echo $erreur2;	?>
					 	</div>
					 <?php } ?>

					 <?php if (isset($erreur3)) { ?>
					 	<div class="alert alert-danger" role="alert" style="font-weight: bold;">
					 		<?php echo $erreur3;	?>
					 	</div>
					 <?php } ?>

					 <?php if (isset($erreur4)) { ?>
					 	<div class="alert alert-danger" role="alert" style="font-weight: bold;">
					 		<?php echo $erreur4;	?>
					 	</div>
					 <?php } ?>

					 <?php if (isset($erreur5)) { ?>
					 	<div class="alert alert-danger" role="alert" style="font-weight: bold;">
					 		<?php echo $erreur5;	?>
					 	</div>
					 <?php } ?>

					 <?php if (isset($erreur6)) { ?>
					 	<div class="alert alert-danger" role="alert" style="font-weight: bold;">
					 		<?php echo $erreur6;	?>
					 	</div>
					 <?php } ?>

					 <?php if (isset($erreur7)) { ?>
					 	<div class="alert alert-danger" role="alert" style="font-weight: bold;">
					 		<?php echo $erreur7;	?>
					 	</div>
					 <?php } ?>

					 <?php if (isset($erreur8)) { ?>
					 	<div class="alert alert-danger" role="alert" style="font-weight: bold;">
					 		<?php echo $erreur8;	?>
					 	</div>
					 <?php } ?>

					 <?php if (isset($erreur9)) { ?>
					 	<div class="alert alert-danger" role="alert" style="font-weight: bold;">
					 		<?php echo $erreur9;	?>
					 	</div>
					 <?php } ?>
				 </div>
    			<div class="col-md-2"></div>

    		</div>
    		</form>
    	</div>
    	<div class="row" style="padding-top: 200px"></div>
    	

        <script type="text/javascript" src="dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

