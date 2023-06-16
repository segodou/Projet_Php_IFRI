<?php
session_start();
require "connect.php";

	if (isset($_POST['envoyer'])) //On vérifie que le bouton envoyer a été actionné
	{
		if(!empty($_POST['matricule'])) //on verifie que le champ est rempli et non vide
		{
			$matri = htmlspecialchars($_POST['matricule']);

			// On récupère tout les donnees de la table utilisateur ayant le mmatricule saisi par l'utilisateur
			$requete = $bdd->prepare("SELECT * FROM segodo_utilisateur WHERE matricule = ?");
			$requete->execute(array($matri));
			$matriexist = $requete->rowCount();
			if ($matriexist != 0) 
			{
				$userinfo = $requete->fetch();
				$_SESSION['id'] = $userinfo['id_user'];
				$_SESSION['nom'] = $userinfo['nom'];
				$_SESSION['prenom'] = $userinfo['prenom'];
				$_SESSION['matricule'] = $userinfo['matricule'];
				$_SESSION['email'] = $userinfo['login'];
				$actif = $userinfo['active'];

				if ($actif ==  0) {
					header('Location: inscription.php');
				}else{
					$erreur = "Vous aviez déjà un compte. Veuillez vous connecter !  <a href=\"index.php\">Me connecter</a>";
				}
				
			}else{
				$erreur = "Matricule incorrect" ;
			}
		
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
</head>
<body id="mapage">
	<?php include ("header.php") ?>
	<div id="container-fluide" style="padding-top: 100px; padding-bottom: 100px" >
		    <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 alert alert-success">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <h1 style="text-align: center;">Bienvenue sur la plateforme d'emploi du temps de l'IFRI</h1>
                        <p>Afin d'accéder à l'espace utilisateur, nous vous invitons à activer votre compte utilisateur. Pour cela, veuillez renseignez le champ suivant.</p>
                        <?php if (isset($erreur)) { ?>
						 	<div class="alert alert-danger" role="alert">
						 		<?php echo $erreur;	?>
						 	</div>
						<?php } ?>
                          <div class="form-group"><p>
                          	<label for="matricule" style="font-size : large ;"><b>Entrer votre matricule</b> </label>
			        		<input type="text" class="form-control" name="matricule" id="matricule" size="30"  required <?php if(isset($matri)) { echo $matri; } ?> /> 
                          </p></div>
                          
                        <input type="submit" id='submit' class="btn btn-primary" name="envoyer" value="Envoyer" />
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
				
     </div>
        <script type="text/javascript" src="dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>