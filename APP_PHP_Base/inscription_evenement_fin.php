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

if(isset($_GET['id']))
{
if(isset($_SESSION['id']))
{
if(isset($_POST['sub_inscr']))
{

$IDutilisateur=$_SESSION['id'];
$IDevenement=$_GET['id'];
//$date_inscription=a;
//$heure_inscription=b;


$insert = $bdd->prepare("INSERT INTO  participe(IDevenement,IDutilisateur,date_inscription,heure_inscription,nombre_participants)  VALUES(?,?,CURDATE(),CURTIME(),?)");
$insert->bindParam(1, $IDevenement);
$insert->bindParam(2, $IDutilisateur);
$insert->bindParam(3, $_POST['nb_participants']);
//$insert->bindParam(4, $nom_evenement);
$insert->execute();
header('Location:voir_evenement2.php?id='.$IDevenement);
}else{header('Location:voir_evenement2.php?id='.$IDevenement);}
}else{header('Location:formulaire_connection.php');}
}else{header('Location:index.php');}
exit();
?>