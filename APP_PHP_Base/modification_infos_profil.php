<?php

session_start();

?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Modification informations du profil</title>
        <link rel='stylesheet' href='CSSnav.css'>
        <link rel='stylesheet' href='CSSfooter.css'>
        <link rel='stylesheet' href='CSSformulaire.css'>
        <link rel='stylesheet' href='CSStestJS.css'>
        <script type="text/javascript" src="fonctionsJS.js"></script>
        <script type="text/javascript" src="test_verification_adresse_mail.js"></script>
    </head>
    <body>
        <div id="global">
        
        
<?php
//On vérifie que l'utilisateur est bien connecté
if (isset($_SESSION['id']))
{
include_once 'nav_connecte.php';

//On redemande toutes les informations sur l'utilisatzeur pour pouvoir pré-remplir les champs

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
 

$reponse= $bdd->prepare("SELECT * FROM utilisateur WHERE  IDutilisateur = :id");

$reponse->execute(array('id' => $_SESSION['id']));
$donnees = $reponse->fetch();

//On définit des variables contenant les informations sur le site

$pseudo=htmlspecialchars($donnees['pseudo']);
$nom=htmlspecialchars($donnees['nom_utilisateur']);
$prenom=htmlspecialchars($donnees['prenom_utilisateur']);
$sexe=htmlspecialchars($donnees['sexe']);
$mail=htmlspecialchars($donnees['adresse_mail']);
$mdp=htmlspecialchars($donnees['mot_de_passe']);
$date_naissance=htmlspecialchars($donnees['date_de_naissance']);
$dept_residence=htmlspecialchars($donnees['numero_departement_de_residence']);
$ville=htmlspecialchars($donnees['ville']);
$newsletter=htmlspecialchars($donnees['accepte_newsletter']);


// On inclue le formulaire de modification
include_once 'formulaire_modification_profil.php';
}
else
{
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
