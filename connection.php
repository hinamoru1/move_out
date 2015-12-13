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

//On affecte ensuite à une variable superglobale de session les pseudo et mot de passe retournés
//On les echo en même temps pour savoir ce qui se passe
echo 'Valeur des variables superglobales de session: <br/>';


//On définit l'id en tant que variable superglobale ce qui nous servira à vérifier la connexion sur les autres pages
$_SESSION['id']=$donnees['IDutilisateur'];



//On définit aussi comme variable de session le lien vers l'image de profil TENTATIVE
/*$IDimage_profil=$donnees['IDimage_profil'];
if ($IDimage_profil == 0)
{
 $_SESSION['image_profil']="Images/defaultprofil.png";
 //echo $lien_image_profil;
}
else 
{
$reponse= $bdd->prepare("SELECT lien FROM multimedia WHERE type='image' AND IDmultimedia = :id");

$reponse->execute(array('id' => $IDimage_profil));
$donnees = $reponse->fetch();

$_SESSION['image_profil']=$donnees['lien'];

}

echo $_SESSION['image_profil'];
*/

echo $donnees['IDutilisateur'] . '<br />';
// ??? $_SESSION['idutilisateur']=$donnees['IDutilisateur'];
echo $donnees['pseudo'] . '<br />';
// ??? $_SESSION['pseudo']=$donnees['pseudo'];
echo $donnees['mot_de_passe'] . '<br />';
// ??? $_SESSION['mot_de_passe']=$donnees['mot_de_passe'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p>-------------------------------------------------------</p>
        <br/><br/>
        <?php
        //Maintenant on cherche si l'utilisateur est bien connecté
        //En gros si les variables de sessions ne contiennt rien c'est qu'il a rentré un mauvais login ou mot de passe
        //Si il a rentré un login ou mot de passe existants et qui correspondent les variables de sessions contiennent qqch
        
        //if(isset($_SESSION['pseudo']) and isset($_SESSION['mot_de_passe']))
        if(isset($_SESSION['id']))
        {
        echo '<p>Bonjour ' . $donnees['pseudo'] . '. Vous êtes bien connecté.</p><br/><br/>';
        echo '<p>Cliquez <a href="headpage.php">ici</a> pour revenir à la page d\'accueil.</p><br/><br/>';
        echo '<p>Cliquez <a href="profil.php">ici</a> pour accéder à votre profil.</p>';
        
        }
        else 
        {
        echo '<p>Echec de la connexion. Cliquez <a href="formulaire_connection.php">ici</a> pour réessayer</p><br/><br/>';
        echo '<p>Cliquez <a href="headpage.php">ici</a> pour revenir à la page d\'accueil.</p>';
        }

if(isset($_SESSION['id']))
{
    header('Location:profil.php');
    exit();
}
        
        
        
        ?>
    </body>
</html>