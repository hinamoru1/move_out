<?php session_start();
try
{
$bdd = new PDO('mysql:host=localhost;dbname=move_out;charset=utf8', 'root', '', 
/* La ligne qui suit est à rajouter pour obtenir des informations beaucoup plus précises lors des erreurs SQL*/
array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$IDutilisateur=$_SESSION['id'];
$IDevenement=$_GET['ide'];

$req = $bdd->prepare('DELETE FROM wishlist WHERE IDutilisateur=:idu AND IDevenement=:ide');
$req->execute(array('ide' => $IDevenement, 'idu' => $IDutilisateur));


header('Location:voir_evenement2.php?id='.$IDevenement);
exit();
?>
