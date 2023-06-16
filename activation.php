<?php
session_start();
require "connect.php";

	if (isset($_GET['s']) && !empty($_GET['s'])) {
	 	$erreur = "Code d'activation envoyé sur votre adresse mail. Si vous n'aviez pas recu votre code, veuillez verifier votre pourriel";
	}

	$id = $_SESSION['id'];

	 if(isset($_POST['soumettre'])){
	 		$cod = htmlspecialchars($_POST['cod']);
	 	

	 	$q = $bdd->prepare('SELECT * FROM segodo_utilisateur WHERE id_user = ?');
		$q->execute(array($id));
		$data = $q->fetch();

		if ($cod != $data['cle']) {
			$erreur= "Mauvais code";
		}else{
			$q = $bdd->prepare('UPDATE segodo_utilisateur SET active = ? WHERE id_user = ?');
			$q->execute(array(1 , $id));
			$erreur = "Votre compte est activé. Veuillez vous connecter !  <a href=\"index.php\">Me connecter</a>";
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
                        <h1 style="text-align: center;">Activation</h1>
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
                <div class="col-md-3"></div>
            </div>
				
     </div>e
        <script type="text/javascript" src="dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>