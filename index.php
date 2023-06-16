<?php
session_start();
require "connect.php"; //connexion à la base de donnée

if(isset($_POST['submit'])) //Si le bouton submit est actionné
{   
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $mail = htmlspecialchars($_POST['mail']); 
    $password =sha1(htmlspecialchars($_POST['password']));


    
    if($mail !== "" && $password !== "")
    {
        $q = $bdd->prepare("SELECT * FROM segodo_utilisateur where login = ? AND password = ?");
        $q->execute(array($mail, $password));
        $compteexist = $q->rowCount();//On vérifié si le mail de l'utilisateur et le mot de passe est dans la base de donnée
        $data = $q->fetch();
        $active = $data['active'];
        $_SESSION['matricule'] = $data['matricule'];
        $_SESSION['nom']  = $data['nom'];
        $_SESSION['id_user']  = $data['id_user'];
        $role = $data['id_role'];
        if(($compteexist!=0) && ($active == 1)) // nom d'utilisateur et mot de passe correctes et compte activé
        {
           if ($role == 1) {
               header('Location: admin.php');
           }else{
                header('Location: enseignant.php');
            }
        }
        else
        {
           $erreur = "Email ou mot de passe incorrect"; // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
       $erreur = "Email ou mot de passe incorrect"; // utilisateur ou mot de passe vide
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
    <body id = "mapage">
        <?php include ("header.php") ?>
        <div id="container-fluide" style="padding-top: 100px; padding-bottom: 100px" >
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 alert alert-success">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <h1>Connexion</h1>
                      
                            <p style="text-align: justify";>Hello. Ce site est réservé uniquement aux enseignants de l'IFRI. Si votre compte n'est pas encore activer, veuillez l'activer d'abord avant de pouvoir vous connecter et accéder à l'espace utilisateur</p>
                       
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
                            <label for="password"><b>Mot de passe</b></label>
                            <input type="password" class="form-control" placeholder="Entrer le mot de passe" id="password" name="password" required>
                          </p></div>
                          <div><p>
                          <a href="accueil.php">Activation</a> &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
                          <a href="motdepasse.php">Mot de passe oublié ?</a>
                          </p></div>
                          
                        <input type="submit" id='submit' class="btn btn-primary" name='submit' value='Se Connecter' />
                    </form>
                </div>
                <div class="col-md-4"></div>
            </div>
                
        </div>
<?php include ("footer.php") ?>
        <script type="text/javascript" src="dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>