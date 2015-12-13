<?php
session_start();
try
{
$bdd = new PDO('mysql:host=localhost;dbname=move_out;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
$IDevenement=$_GET['id'];


$reponse= $bdd->prepare("SELECT IDcreateur FROM evenement WHERE  IDevenement = :id");
$reponse->execute(array('id' => $IDevenement));
$donnees = $reponse->fetch();
                                
                                
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p>
        <?php
        if($donnees['IDcreateur']==$_SESSION['id'])
        {
        //Suppression  de toutes les informations de ce profil
        $req = $bdd->prepare('DELETE FROM evenement WHERE IDevenement = :id');
        $req->execute(array('id' => $_GET['id']));
        header('Location:profil.php');
        exit();
        }else
        {
        header('Location:voir_evenement2.php?id='.$IDevenement);
        exit();
        }
        ?>
        </p>
    </body>
</html>
