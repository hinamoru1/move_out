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

//On applique la fonction de hachage au mot de passa afin de le comparer au mot de passe haché enregistré dans la bdd
$_POST['mdp_connection']=  sha1($_POST['mdp_connection']);
//On sélectionne les éléments de la bdd correspondant aux pseudo et mdp donnés
//Si il ne sont pas dans la bdd, la requêtre ne retournera rien
$reponse= $bdd->prepare("SELECT * FROM utilisateur WHERE  pseudo = :pseudo AND mot_de_passe = :pass");

$reponse->execute(array('pseudo' => $_POST['id_connection'],'pass' => $_POST['mdp_connection']));
$donnees = $reponse->fetch();


//On définit l'id en tant que variable superglobale ce qui nous servira à vérifier la connexion sur les autres pages
$_SESSION['id']=$donnees['IDutilisateur'];
//Si l'utilisateur est un administrateur, on le définit dans une variable de session
if($donnees['admin']==1){$_SESSION['admin']=1;}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Erreur de connection</title>
        <link rel='stylesheet' href='CSSerreur.css'>
        <link rel='stylesheet' href='CSSnav.css'>
        <link rel='stylesheet' href='CSSfooter.css'>
    </head>
    <body>
        <div id="global">
<?php
//Maintenant on cherche si l'utilisateur est bien connecté
//En gros si les variables de sessions ne contiennt rien c'est qu'il a rentré un mauvais login ou mot de passe
//Si il a rentré un login ou mot de passe existants et qui correspondent les variables de sessions contiennent qqch
//if(isset($_SESSION['pseudo']) and isset($_SESSION['mot_de_passe']))
        
if(isset($_SESSION['id']))
{
    header('Location:profil.php');
    exit();
}
else
{
include_once 'nav_non_connecte.php'
?>
<section>
    <h1>Pseudo ou login incorrect.<br/>Veuillez réessayer de vous connecter en cliquant <a href="formulaire_connection.php">ici</a>.</h1> 
</section>       
        </div>        
<?php
include_once 'footer.php';
}
?>
    </body>
</html>