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
if(isset($_POST['id']))
{
if(isset($_POST['sub_inscr']))
{
    if($_POST['mot_de_passe'] == $_POST['mot_de_passe_conf'])
	{
        //on vérifie que les deux mots de passe tapé sont les mêmes
        $pass = sha1($_POST['mot_de_passe']);
        
        $insert= $bdd->prepare('UPDATE utilisateur SET mot_de_passe=? WHERE IDutilisateur = ? ');
        $insert->bindParam(1, $pass);
        $insert->bindParam(2, $_SESSION['id']);
		//$insert->bindParam(8, $sexe);
        $insert->execute();
        }
        
}

    

?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Validation de modification de mot de passe</title>
        <link rel='stylesheet' href='CSSerreur.css'>
        <link rel='stylesheet' href='CSSnav.css'>
        <link rel='stylesheet' href='CSSfooter.css'>
    </head>
    <body>
        <div id="footer">
        <?php
            include_once 'nav_connecte.php';
        ?>
        <p>Votre mot de passe a bien été modifié.      <a href="profil.php">OK</a></p>
        </div>
        <?php
            include_once 'footer.php';
        ?>
    </body>
</html>
<?php
}
header('Location:profil.php');
exit();
?>
