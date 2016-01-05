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

//Suppression  de toutes les informations de ce profil
$req = $bdd->prepare('DELETE FROM utilisateur WHERE IDutilisateur = :id');
$req->execute(array('id' => $_SESSION['id']));

//On termine ensuite la session
session_destroy();

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Suppression de compte</title>
    </head>
    <body>
        <p>Votre compte a bien été supprimé.    <a href="headpage.php">OK</a></p>
    </body>
</html>
<?php
header('Location:headpage.php');
exit();
?>