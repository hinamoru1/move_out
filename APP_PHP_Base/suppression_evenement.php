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
        //On vérifie que l'utilisateur est bien le créateur de l'évènement
        if($donnees['IDcreateur']==$_SESSION['id'])
        {
         echo'Etes vous bien sur de vouloir supprimer l\'évènement?';
         $lien='fin_suppression_evenement.php?id='.$IDevenement;
         echo '<br/> <a href="'.$lien.'">Oui</a>';
         $lien2='voir_evenement2.php?id='.$IDevenement;
         echo '<br/><a href="'.$lien2.'">Non</a>';
        }else
        {
        header('Location:voir_evenement2.php?id='.$IDevenement);
        exit();
        }
        ?>
        </p>
    </body>
</html>
