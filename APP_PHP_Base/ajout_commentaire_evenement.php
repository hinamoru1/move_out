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

if (isset($_SESSION['id']))
{
    //On vérifie que l'utilisateur ne laisse pas un commentaire vide
    if($_POST['texte']!= '')
    {
    $insert = $bdd->prepare("INSERT INTO commentaires (date_ajout, heure_ajout, texte, IDutilisateur, IDevenement)  VALUES(CURDATE(), CURTIME(),?,?,?)");
    $insert->bindParam(1, $_POST['texte']);
    $insert->bindParam(2, $_SESSION['id']);
    $insert->bindParam(3, $_GET['id']);
    $insert->execute();
    }
}
header('Location:voir_evenement2.php?id='.$_GET['id']);
exit();
?>