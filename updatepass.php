<?php
session_start();
require "connect.php";

	if (isset($_GET['s']) && !empty($_GET['s'])) {
	 	$erreur = "Un code est envoyé sur votre email. Si vous n'aviez pas recu votre code, veuillez vérifier votre pourriel";
	}

	 if(isset($_POST['soumettre'])){
	 		$cod = htmlspecialchars($_POST['cod']);

		if ($cod != $_SESSION['code']) {
			$erreur = "Mauvais code ! Réessayer";
		}else{
			 $insertmbr = $bdd->prepare("UPDATE segodo_utilisateur SET password = ? WHERE login = ?"); //on met à jour les données de l'utilisateur
            $insertmbr->execute(array($_SESSION['mdp'], $_SESSION['mail']));
			$erreur = "Mot de passe modifié avec succès. Veuillez vous connecter !  <a href=\"index.php\">Me connecter</a>";
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
                <div class="col-md-4"></div>
                <div class="col-md-4 alert alert-success">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <h1 style="text-align: center;">Modification de votre mot de passe</h1>
                        <?php if (isset($erreur)) { ?>
						 	<div class="alert alert-danger" role="alert">
						 		<?php echo $erreur;	?>
						 	</div>
						<?php } ?>
                          <div class="form-group"><p>
                          	<label for="cod" style="font-size : large ;"><b>Code</b> </label>
			        		<input type="text" class="form-control" name="cod" id="cod" size="30" value="<?php if(isset($cod)) { echo $cod; } ?>"required /> 
                          </p></div>
                          
                        <input type="submit" id='submit' class="btn btn-primary" name="soumettre" value="Soumettre" />
                    </form>
                </div>
                <div class="col-md-4"></div>
            </div>
				
     </div>
        <script type="text/javascript" src="dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>