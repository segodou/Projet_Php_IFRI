<?php 
session_start();
require "PHPMailer/PHPMailerAutoload.php";
require "connect.php";

	$id=$_SESSION['id'];
	$matricule=$_SESSION['matricule'];
	$nom=$_SESSION['nom'];
	$prenom=$_SESSION['prenom'];
	$email_bdd = $_SESSION['email'];

	if(isset($_POST['forminscription'])) { //Si les données sont envoyées, on les récupère
		   //$mail = htmlspecialchars($_POST['mail']);
		   //$mail2 = htmlspecialchars($_POST['mail2']);
			
			$mdp = sha1($_POST['mdp']);
		   $mdp2 = sha1($_POST['mdp2']);
		   
		   $phone = htmlspecialchars($_POST['phone']);

		   $code = strtoupper(substr(md5(uniqid()), 0, 6)); //rand(100000, 900000); On génère un code unique de 6 chiffre
  
    //if($mail == $mail2) { //on verifie si les deux mails entrés par l'utilisateur sont égaux
        //if(filter_var($mail, FILTER_VALIDATE_EMAIL)) { //On vérife que c'est vraiment un mail que l'utilisateur a tapé
            $q = $bdd->prepare("SELECT * FROM segodo_utilisateur WHERE id_user = ?");
            $q->execute(array($id));
            $data = $q->fetch();
        	$active = $data['active']; //on recupère la valeur de active pour vérifier si le compte est active ou pas
            /*$mailexist = $reqmail->rowCount();*/
            //if($mail == $email_bdd) {
                if($mdp == $mdp2) {
                	//if($active == 0) {
	                    $insertmbr = $bdd->prepare("UPDATE segodo_utilisateur SET password = ?, tel= ?, cle= ? WHERE id_user = ?"); //on met à jour les données de l'utilisateur
	                    $insertmbr->execute(array($mdp, $phone, $code, $id));

	                    $_SESSION['code'] = $code;
								
	                    //FONCTION POUR ENYOYER UN MAIL à l'utilisateur
								function smtpmailer($to, $from, $from_name, $subject, $body)
							    {
							        $email = new PHPMailer();
							        $email->IsSMTP();
							        $email->SMTPAuth = true; 
							 
							        $email->SMTPSecure = 'ssl'; 
							        $email->Host = 'smtp.gmail.com';
							        $email->Port = 465;  
							        $email->Username = 'bonnesarah21@gmail.com';
							        $email->Password = 'Sarah1987';   
							   
							   //   $path = 'reseller.pdf';
							   //   $mail->AddAttachment($path);
							   
							        $email->IsHTML(true);
							        $email->From='bonnesarah21@gmail.com';
							        $email->FromName=$from_name;
							        $email->Sender=$from;
							        $email->AddReplyTo($from, $from_name);
							        $email->Subject = $subject;
							        $email->Body = $body;
							        $email->AddAddress($to);
							       if(!$email->Send())
							        {
							            $error ="Please try Later, Error Occured while Processing...";
							            return $error; 
							        }
							        else 
							        {
							            $error = "Thanks You !! Your email is sent.";  
							            return $error;
							        }
							    }
							    
							    $to   = $email_bdd;
							    $from = 'bonnesarah21@gmail.com';
							    $name = 'IFRI, nous batissons l\'excellence';
							    $subj = 'Code de Confirmation';
							    $msg = "Votre code est :".$code;
							    
							    $error=smtpmailer($to,$from, $name ,$subj, $msg);

							    header ("Location: activation.php?s=1");
				
//$erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
	                } else {
	                    $erreur = "Vos mots de passes ne correspondent pas !";
	                }
               /* } else {
                	$erreur = "Vous aviez déjà un compte. Veuillez vous connecter !  <a href=\"connexion.php\">Me connecter</a>";
            	}
            } else {
                $erreur = "Vous n'etes pas utilisateur de ce site !";
            }
        } else {
            $erreur = "Votre adresse mail n'est pas valide !";
        }
    } else {
        $erreur = "Vos adresses mail ne correspondent pas !";
    }*/
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
                        <h1 style="text-align: center;">Inscription</h1>
                        <p>Bonjour monsieur <?php echo $nom. " " .$prenom ; ?>. Veuillez remplir le formulaire suivant.</p>
                        <?php if (isset($erreur)) { ?>
						 	<div class="alert alert-danger" role="alert">
						 		<?php echo $erreur;	?>
						 	</div>
						<?php } ?>
                          <div class="form-group"><p>
                          	<label for="mdp" style="font-size : large ;"><b>Mot de passe </b> </label>
			        		<input class="form-control" type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" required /> 
                          </p></div>
                           <div class="form-group"><p>
                          	<label for="mdp2" style="font-size : large ;"><b>Confirmation du mot de passe </b> </label>
			        		<input class="form-control" type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" required /> 
                          </p></div>
                          <div class="form-group"><p>
                          	<label for="phone" style="font-size : large ;"><b>Téléphone </b> </label>
			        		<input class="form-control" type="tel" placeholder="+229" id="phone" name="phone"  value="<?php if(isset($phone)) { echo $phone; } ?>" required /> 
                          </p></div>
                          
                        <input type="submit" id='submit' class="btn btn-primary" name="forminscription" value="J'active mon compte"/>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
				
     </div>
        <script type="text/javascript" src="dist/js/bootstrap.bundle.min.js"></script>
 </body>
 </html>