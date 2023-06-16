<?php 
	try
	{
		// On se connecte à MySQL
		$bdd = new PDO('mysql:host=localhost;dbname=siribd;charset=utf8', 'siriuser', '18f@2021SIRI');
	}
	catch(Exception $e)
	{
				// En cas d'erreur, on affiche un message et on arrête tout
			        die('Erreur : '.$e->getMessage());
	} 
 ?>