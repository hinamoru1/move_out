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


if(isset($_POST['sub_inscr']))
	{
    //On vérifie qu'on a appuyé sur le bouton d'inscription

        $pseudo= $_POST['pseudo'];
        $nom= $_POST['nom'];
	$sexe= $_POST['sexe'];
	$prenom= $_POST['prenom_utilisateur'];
        //$telephone= $_POST['telephone'];
	$date_naissance= $_POST['date_naissance'];
        $adresse_mail = $_POST['email'];
        $ville = $_POST['ville'];
        $dept_residence= $_POST['departement'];
        $newsletter=$_POST['accepte_newsletter'];
        //On associe une variable a la valeur d'un input
        
        $insert= $bdd->prepare('UPDATE utilisateur SET pseudo=?, nom_utilisateur=?, prenom_utilisateur=?, date_de_naissance=?, adresse_mail= ?, numero_departement_de_residence= ?, accepte_newsletter=?, sexe=?, ville=? WHERE IDutilisateur = ? ');
        $insert->bindParam(1, $pseudo);
        $insert->bindParam(2, $nom);
        $insert->bindParam(3, $prenom);
		//$insert->bindParam(4, $telephone);
        $insert->bindParam(4, $date_naissance );
        $insert->bindParam(5, $adresse_mail);
		//$insert->bindParam(6, $pass);
        $insert->bindParam(6, $dept_residence);
        $insert->bindParam(7, $newsletter);
        $insert->bindParam(10, $_SESSION['id']);
        $insert->bindParam(8, $sexe);
        $insert->bindParam(9, $ville);
        $insert->execute();
        }
        
?>
        
<!DOCTYPE html>
<html>
    <head>
       <meta charset="UTF-8">
       <title>Validation de modification</title>
    </head>
    <body>
        <p>Vos informations ont bien été modifiées.    <a href="profil.php">OK</a><br/></p>
    </body>
</html>

<?php
header('Location:profil.php');
exit();
?>