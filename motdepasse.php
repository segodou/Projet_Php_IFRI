<?php
session_start();
require "PHPMailer/PHPMailerAutoload.php";
require "connect.php";

if (isset($_POST['modifier'])) //On vérifie que le bouton modifier a été actionné
{
    if(!empty($_POST['mail']) && !empty($_POST['mdp']) && !empty($_POST['mdp2'])) //on verifie que le champ est rempli et non vide
    {
        $mail = htmlspecialchars($_POST['mail']);
        $mdp = sha1($_POST['mdp']);
        $mdp2 = sha1($_POST['mdp2']);
           
        $code = strtoupper(substr(md5(uniqid()), 0, 6)); 
  
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)) { //On vérife que c'est vraiment un mail que l'utilisateur a tapé
            $q = $bdd->prepare("SELECT * FROM segodo_utilisateur WHERE login = ?");
            $q->execute(array($mail));
            $data = $q->fetch();
            $active = $data['active']; //on recupère la valeur de active pour vérifier si le compte est active ou pas
            $email_bdd = $data['login'];
            /*$mailexist = $reqmail->rowCount();*/
            if($mail == $email_bdd) {
                if($mdp == $mdp2) {
                    if($active == 1) {

                        $_SESSION['code'] = $code;
                         $_SESSION['mail'] = $mail;
                          $_SESSION['mdp'] = $mdp;
                                
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

                                header ("Location: updatepass.php?s=1");


                    } else {
                        $erreur = "Erreur incoonu. Veuillez réessayer";
                    }
               } else {
                    $erreur = "Vos mots de passes ne correspondent pas !";
                }
            } else {
                $erreur = "Vous adresse mail est erroné !";
            }
        } else {
            $erreur = "Votre adresse mail n'est pas valide !";
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
                        <h1 style="text-align: center;">Mot de passe oublié</h1>
                        <p>Pour modifier votre mot de passe, veuillez entrer votre email.</p>

                        <?php if (isset($erreur)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $erreur; ?>
                            </div>
                        <?php } ?>

                        <div class="form-group"><p>
                            <label for="mail"><b>Email</b></label>
                            <input type="email" class="form-control" placeholder="Entrer votre mail" name="mail" id="mail" value="<?php if(isset($mail)) { echo $mail; } ?>"required aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais votre e-mail avec quelqu'un d'autre.</small>
                          </p></div>
                          <div class="form-group"><p>
                            <label for="mdp" style="font-size : large ;"><b>Nouveau mot de passe </b> </label>
                            <input class="form-control" type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" required /> 
                          </p></div>
                           <div class="form-group"><p>
                            <label for="mdp2" style="font-size : large ;"><b>Confirmation du mot de passe </b> </label>
                            <input class="form-control" type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" required /> 
                          </p></div>
                          
                        <input type="submit" id='submit' class="btn btn-primary" name="modifier" value="Modifier"/>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
                
     </div>
        <script type="text/javascript" src="dist/js/bootstrap.bundle.min.js"></script>
 </body>
 </html>