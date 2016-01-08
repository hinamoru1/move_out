<?php
session_start();

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=move_out;charset=utf8', 'root', '', 
               /* La ligne qui suit est à rajouter pour obtenir des informations beaucoup plus précise lors des erreurs SQL*/
               array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

if(isset($_POST['submit_sujet']))
{
		$req = $bdd->prepare('INSERT INTO topic (titre, message_source, IDutilisateur,date_creation) VALUES(?, ?, ?,CURTIME())');

		$req->execute(array($_POST['titre'], $_POST['message'], $_SESSION['id']));
		
}

header('Location: corpsforum.php');
?>