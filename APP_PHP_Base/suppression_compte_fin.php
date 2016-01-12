<?php
session_start();
$idok=0;
$adminok=0;
if(isset($_SESSION['id']))
{
if(isset($_GET['id']))
{

if($_GET['id']==$_SESSION['id'])
            {$idok=1;}
        if(isset($_SESSION['admin']))
            {$adminok=1;}
    
        if($idok===1 or $adminok===1)
        {
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


//On va commencer par supprimer l'ancienne photo de profil
//On utilisa la fonction unlink(lien_du_fichier)
//Il restera à s'assurer que l'on renomme toutes les photos avec des noms différents
$reponse= $bdd->prepare("SELECT IDimage_profil FROM utilisateur WHERE IDutilisateur =:id");
$reponse->execute(array('id' => $_GET['id']));
$donnees = $reponse->fetch();

$reponse= $bdd->prepare("SELECT lien FROM multimedia WHERE IDmultimedia =:id");
$reponse->execute(array('id' => $donnees['IDimage_profil']));
$donnees2 = $reponse->fetch();

//Suppression du fichier de l'ancienne photo
if(isset($donnees2['lien'])){
unlink($donnees2['lien']);
}

// Ensuite on supprime l'ancien lien dans la table multimedia
if(isset($donnees['IDimage_profil']))
{
$req = $bdd->prepare('DELETE FROM multimedia WHERE IDmultimedia = :id');
$req->execute(array('id' => $donnees['IDimage_profil']));
}

//Suppression  de toutes les informations de ce profil
$req = $bdd->prepare('DELETE FROM utilisateur WHERE IDutilisateur = :id');
$req->execute(array('id' => $_GET['id']));

//On termine ensuite la session
session_destroy();

?>
<!DOCTYPE html>
<html>
    <head></head>
    <body>
<script>alert('Le profil et toutes les informations le concernant on été supprimés avec succès');</script>
    </body>
</html>
    <?php
header('Location:index.php');
exit();
}else{header('Location:profil.php');}
}else{header('Location:profil.php');}
}else{header('Location:formulaire_connection.php');}
?>