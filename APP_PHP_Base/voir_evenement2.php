<?php session_start() ?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Move-out: évènement</title>
        <link rel='stylesheet' href='CSS_affichage_evenement.css'>
        <link rel='stylesheet' href='CSSnav.css'>
        <link rel='stylesheet' href='CSSfooter.css'>
    </head>
    <body>
        <div id="global">
<?php       
//On définit toutes les variables nécessaires sur l'évènement
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

$reponse= $bdd->prepare("SELECT *,DATE_FORMAT(date_creation, '%d/%m/%Y') AS date_creation_fr,DATE_FORMAT(date_debut, '%d/%m/%Y') AS date_debut_fr,DATE_FORMAT(date_fin, '%d/%m/%Y') AS date_fin_fr FROM evenement WHERE  IDevenement = :id");

$reponse->execute(array('id' => $_GET['id']));
$donnees = $reponse->fetch();
//On définit toutes les variables
$id=$_GET['id'];
$nom=htmlspecialchars($donnees['nom_evenement']);
$num_rue=htmlspecialchars($donnees['numero_de_rue']);
$bis=htmlspecialchars($donnees['bis']);
$rue=htmlspecialchars($donnees['rue']);
$ville=htmlspecialchars($donnees['ville']);
$code_postal=htmlspecialchars($donnees['code_postal_evenement']);
$pays=htmlspecialchars($donnees['pays']);
$complement_adresse=htmlspecialchars($donnees['complement_adresse']);
$date_creation=htmlspecialchars($donnees['date_creation_fr']);
$date_debut=htmlspecialchars($donnees['date_debut_fr']);
$date_fin=htmlspecialchars($donnees['date_fin_fr']);
$heure_debut=htmlspecialchars($donnees['heure_debut']);
$heure_fin=htmlspecialchars($donnees['heure_fin']);
$desc_accueil=htmlspecialchars($donnees['description_lieu_accueil']);
$nb_pl_max=htmlspecialchars($donnees['nb_de_places_max']);
$complet=htmlspecialchars($donnees['complet']);
$gratuit=htmlspecialchars($donnees['gratuit']);
$prix_min=htmlspecialchars($donnees['prix_min']);
$prix_max=htmlspecialchars($donnees['prix_max']);
$handicap=htmlspecialchars($donnees['accessibilite_handicape']);
$a_propos=htmlspecialchars($donnees['a_propos']);
$lien_aux=htmlspecialchars($donnees['lien_auxiliaire']);
$IDcat_evt=htmlspecialchars($donnees['IDcategorie_evenement']);
$IDmultimedia=htmlspecialchars($donnees['IDmultimedia']);
$IDcreateur=htmlspecialchars($donnees['IDcreateur']);





        
        
        if (isset($_SESSION['id']))
        {
         include_once 'nav_connecte.php';   
        }
        else 
        {
         include_once 'nav_non_connecte.php';  
        }
        
        include_once 'vue_affichage_evenement.php';
        ?>
        </di>
        <?php
        include_once 'footer.php';
        ?>
    </body>
</html>
