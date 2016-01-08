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


$insert = $bdd->prepare("INSERT INTO  wishlist(IDevenement,IDutilisateur)  VALUES(?,?)");
$insert->bindParam(1, $IDevenement);
$insert->bindParam(2, $IDutilisateur);
//$insert->bindParam(3, $nom_evenement);
//$insert->bindParam(4, $nom_evenement);
$insert->execute();


header('Location:voir_evenement2.php?id='.$IDevenement);
exit();
?>
