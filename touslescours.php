<?php 
require "connect.php";
	$q = $bdd->prepare("SELECT lib_filiere, lib_niveau, dates, heure, lib_mat 
							FROM segodo_cours co
							JOIN segodo_matiere_enseigner me
							JOIN segodo_matiere m
							JOIN segodo_classe c 
							JOIN segodo_filiere f
							JOIN segodo_niveau n
							JOIN segodo_horaire h
							ON co.id_mat_enseigner = me.id_mat_enseigner
							AND me.cod_mat = m.cod_mat
							AND co.id_classe = c.id_classe
							AND c.id_filiere = f.id_filiere
							AND c.id_niveau = n.id_niveau
							AND co.id_horaire = h.id_horaire
							WHERE c.id_classe = ? ORDER BY(dates)");

	$req = $bdd->prepare("SELECT * 
							FROM segodo_cours co 
							JOIN segodo_salle s 
							JOIN segodo_classe c 
							ON co.id_classe = c.id_classe 
							AND co.id_salle = s.id_salle 
							WHERE co.id_classe = ? 
							LIMIT 1");

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
        <link rel="stylesheet" href="styletabl.css" media="screen" type="text/css" />
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

	<div class="container" style="padding-top: 70px;">

		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<?php for ($i=1; $i <=18 ; $i++) { ?>
					<p><?php
						$q->execute(array($i));
						$ligne = $q->rowCount();
						if ($ligne != 0) {
							echo '<table class="table table-hover table-dark text-center">';
							echo "<thead>";
								echo "<tr>";
									echo '<th scope="col">';
										echo "Classe";
									echo "</th>";
									echo '<th scope="col">';
										echo "Dates";
									echo "</th>";
									echo '<th scope="col">';
										echo "Horaire";
									echo "</th>";
									echo '<th scope="col">';
										echo "Matière";
									echo "</th>";
								echo "</tr>";
							echo "</thead>";
							echo "<tbody>";
							while ($donnees = $q -> fetch()) {								
									echo "<tr>";
										echo '<th scope="col">';
											echo $donnees['lib_filiere']." ".$donnees['lib_niveau'];
										echo "</th>";
										echo '<td>';
											echo jourdelasemaine($donnees['dates'])." ".date("d-m-Y",$donnees['dates']);
										echo "</td>";
										echo '<td>';
											echo $donnees['heure'];
										echo "</td>";
										echo '<td>';
											echo $donnees['lib_mat'];
										echo "</td>";
									echo "</tr>";
							} 
							echo "</tbody>";

							echo "<tfoot>";
								echo "<tr>";
									echo '<th scope="col">';
										echo "Salle";
									echo "</th>";
									echo '<td colspan=3>';
										$req->execute(array($i));
										$donnees = $req -> fetch();
										if ((isset($donnees['id_salle'])) && (!empty($donnees['id_salle']))) {
											echo $donnees['lib_salle'];
										}else{
											echo "Aucune salle n'est encore attribuée";
										}
									echo '</td>';
								echo "</tr>";
							echo "</tfoot>";
							
						echo "</table>";	
						}

				 	?></p>
				<?php } ?>
			</div>
			
			<div class="col-md-1"></div>
		</div>
	</div>
	<div class="row" style="padding-top: 200px"></div>

<script type="text/javascript" src="dist/js/bootstrap.bundle.min.js"></script>
 </body>
 </html>