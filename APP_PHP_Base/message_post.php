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
if(isset($_POST['submit']))
{
		$req = $bdd->prepare('INSERT INTO messages (IDutilisateur, texte,IDtopic,date_creation) VALUES(?, ?,?,CURTIME())');

		$req->execute(array($_SESSION['id'], $_POST['message'],$_GET['sujet']));
}

header('Location: topic.php?sujet='.$_GET['sujet']);
?>