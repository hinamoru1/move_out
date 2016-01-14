<?php
session_start();
//APPEL BDD -------------------------------
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
//OK---------------------------------------

//On va maintenant chercher toutes les valeurs dont on aura besoin------------------
$reponse= $bdd->prepare("SELECT COUNT(*) AS nb FROM utilisateur");
$reponse->execute();
$donnees = $reponse->fetch();
$nb_inscrits=$donnees['nb'];

$reponse= $bdd->prepare("SELECT COUNT(*) AS nb FROM evenement");
$reponse->execute();
$donnees = $reponse->fetch();
$nb_evts=$donnees['nb'];

$reponse= $bdd->prepare("SELECT COUNT(*) AS nb FROM messages");
$reponse->execute();
$donnees = $reponse->fetch();
$nb_messages=$donnees['nb'];
//OK--------------------------------------------------------------------------------
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Back Office</title>
        <link rel='stylesheet' href='CSSback_office.css'>
        <link rel='stylesheet' href='CSSnav.css'>
        <link rel='stylesheet' href='CSSfooter.css'>
    </head>
    <body>
        <div id="global">
        
<?php
if(isset($_SESSION['id']))
{   
    include_once 'nav_connecte.php'; 
        if($_SESSION['admin']===1)
            {
                include_once 'corps_back_office.php';
            }
        else
            {
                header('Location:profil.php');
            }
            ?>
            </div>
            <?php
            include_once 'footer.php';
}
        else
        {
            
            header('Location:formulaire_connection.php');
        }
        ?>
    </body>
</html>
