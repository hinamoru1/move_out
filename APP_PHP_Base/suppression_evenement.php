<?php
session_start();
if(isset($_SESSION['id']))
{
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
        <title>Confirmation de suppression</title>
        <link rel='stylesheet' href='CSSerreur.css'>
        <link rel='stylesheet' href='CSSnav.css'>
        <link rel='stylesheet' href='CSSfooter.css'>
    </head>
    <body>
        <div id="global">
        <?php
        //On vérifie que l'utilisateur est bien le créateur de l'évènement ou un administrateur
        $idok=0;
        $adminok=0;
        if($donnees['IDcreateur']==$_SESSION['id'])
            {$idok=1;}
        if(isset($_SESSION['admin']))
            {$adminok=1;}
    
        if($idok===1 or $adminok===1)
        {
            include_once 'nav_connecte.php';
            $lien='fin_suppression_evenement.php?id='.$IDevenement;
            $lien2='voir_evenement2.php?id='.$IDevenement;
            ?>
        <section>
        <h3> Etes vous bien sur de vouloir supprimer l'évènement?
        <br/> <a href="<?php echo $lien ?>">Oui</a>
        <br/><a href="<?php echo $lien2 ?>">Non</a>
        </section>
        </div>
         <?php
         include_once 'footer.php';
        }else
        {
        header('Location:voir_evenement2.php?id='.$IDevenement);
        exit();
        }
        ?>
        </p>
    </body>
</html>

<?php
}else
        {
        header('Location:voir_evenement2.php?id='.$IDevenement);
        exit();
        }
?>
