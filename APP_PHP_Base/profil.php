<?php

session_start();

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Mon profil</title>
        <meta charset="UTF-8">
        <title>Move-out: Accueil</title>
        <link rel='stylesheet' href='CSSprofil.css'>
        <link rel='stylesheet' href='CSSnav.css'>
        <link rel='stylesheet' href='CSSfooter.css'>
    </head>
    <body>
        <div id="global">
        
        <?php
        //On vérifie que l'utilisateur est bien connecté
        
        
if (isset($_SESSION['id']))
{
include_once 'nav_connecte.php'; 
         
  
//Si c'est la cas on charcge les données nécessaires dans la bdd
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

$id=$_SESSION['id'];
if(isset($_SESSION['admin']))
    {
        $admin=$_SESSION['admin'];
        if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
    }

$reponse= $bdd->prepare("SELECT *,DATE_FORMAT(date_de_naissance, '%d/%m/%Y') AS date_de_naissance_fr FROM utilisateur WHERE  IDutilisateur = :id");

$reponse->execute(array('id' => $id));
$donnees = $reponse->fetch();

//On définit des variables contenant les informations sur le site
//echo $_SESSION['admin'];

//$admin=htmlspecialchars($donnees['admin']);
$pseudo=htmlspecialchars($donnees['pseudo']);
$nom=htmlspecialchars($donnees['nom_utilisateur']);
$prenom=htmlspecialchars($donnees['prenom_utilisateur']);
$sexe=htmlspecialchars($donnees['sexe']);
$ville=htmlspecialchars($donnees['ville']);
$mail=htmlspecialchars($donnees['adresse_mail']);
$date_naissance=htmlspecialchars($donnees['date_de_naissance_fr']);
$dept_residence=htmlspecialchars($donnees['numero_departement_de_residence']);
$newsletter=htmlspecialchars($donnees['accepte_newsletter']);
$IDimage_profil=htmlspecialchars($donnees['IDimage_profil']);

/*test
echo $admin . '<br/>';
echo $pseudo. '<br/>';
echo $nom. '<br/>';
echo $prenom. '<br/>';
echo $sexe. '<br/>';
echo $mail. '<br/>';
echo $date_naissance. '<br/>';
echo $dept_residence. '<br/>';
echo $newsletter. '<br/>';
echo $IDimage_profil. '<br/>';
test*/


//On va cherche le lien de l'image
if ($IDimage_profil == 0)
{
 $lien_image_profil="Images/defaultprofil.png";
 //echo $lien_image_profil;
}
else 
{
$reponse= $bdd->prepare("SELECT lien FROM multimedia WHERE IDmultimedia = :id");

$reponse->execute(array('id' => $IDimage_profil));
$donnees = $reponse->fetch();

$lien_image_profil=$donnees['lien'];

}



//On charge maintenant les informations sur les évènements créés par l'utilisateur
$reponse2= $bdd->prepare("SELECT IDevenement,nom_evenement,date_debut,numero_de_rue,rue,ville,pays FROM evenement WHERE IDcreateur= :id ORDER BY evenement.date_debut");
$reponse2->execute(array('id' => $id));

//On charge les informations sur les évènements auxquels l'utilisateur participe
$reponse3= $bdd->prepare("SELECT evenement.IDevenement,nom_evenement,date_debut,numero_de_rue,rue,ville,pays FROM evenement,participe WHERE evenement.IDevenement=participe.IDevenement  AND participe.IDutilisateur= :id ORDER BY evenement.date_debut");
$reponse3->execute(array('id' => $id));


//On charge les informations sur les évènements de sa wishlist
$reponse4= $bdd->prepare("SELECT evenement.IDevenement,nom_evenement,date_debut,numero_de_rue,rue,ville,pays FROM evenement,wishlist WHERE evenement.IDevenement=wishlist.IDevenement AND wishlist.IDutilisateur= :id ORDER BY evenement.date_debut");
$reponse4->execute(array('id' => $id));


include_once 'vue_profil.php';
}
else
{
//sinon on invite l'utilisateur à se connecter
include_once 'nav_non_connecte.php';
include_once 'erreur_profil.php';
}
?>
    </div>
    <?php
include_once 'footer.php';

?>
        
        
        
        
    </body>
</html>
  
