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


$mailmail=0;
$mdpmdp=0;

if(isset($_POST['sub_inscr']))
	{
			//On vérifie qu'on a appuyé sur le bouton d'inscription
			if($_POST['email'] == $_POST['conf_email'])
				{
			//on vérifie que les deux mots de passe tapé sont les mêmes
				
				if ($_POST['mot_de_passe'] == $_POST['mot_de_passe_conf'])
					{
					$pseudo= $_POST['pseudo'];
					$nom= $_POST['nom'];
					$sexe= $_POST['sexe'];
					$prenom_utilisateur= $_POST['prenom_utilisateur'];
					//$telephone= $_POST['telephone'];
					$date_naissance= $_POST['date_naissance'];
					$adresse_mail = $_POST['email'];
					$pass = sha1($_POST['mot_de_passe']);
					$numero_departement_de_residence= $_POST['numero_departement_de_residence'];
					$newsletter=$_POST['accepte_newsletter'];
					//On associe une variable a la valeur d'un input
		
					$insert = $bdd->prepare("INSERT INTO utilisateur (pseudo, nom_utilisateur, prenom_utilisateur, date_de_naissance, adresse_mail, mot_de_passe, numero_departement_de_residence, sexe,accepte_newsletter) VALUES (?, ?, ?, ?, ?, ?, ?,?,?)");
					$insert->bindParam(1, $pseudo);
					$insert->bindParam(2, $nom);
					$insert->bindParam(3, $prenom_utilisateur);
					//$insert->bindParam(4, $telephone);
					$insert->bindParam(4, $date_naissance );
					$insert->bindParam(5, $adresse_mail);
					$insert->bindParam(6, $pass);
					$insert->bindParam(7, $numero_departement_de_residence);
					$insert->bindParam(8, $sexe);
					$insert->bindParam(9, $newsletter);
					$insert->execute();
			
					//Comme la validation par mail n'est pas fonctionnelle pour l'instant on procède tout de suite à l connection-->
			
					$reponse= $bdd->prepare("SELECT * FROM utilisateur WHERE  pseudo = :pseudo AND mot_de_passe = :pass");
		
					$reponse->execute(array('pseudo' => $pseudo,'pass' => $pass));
					$donnees = $reponse->fetch();
		
					$_SESSION['id']=$donnees['IDutilisateur'];
					
					header('Location:profil.php');
					
					}
					else{
						echo"Votre mot de passe et votre mot de passe de confirmation ne correspondent pas, veuillez faire un retour en arrier et modifier vos informations";
					}
					
				}
			else{
			echo"Votre adresse mail et votre adresse mail de confirmation ne correspondent pas, veuillez faire un retour en arrier et modifier vos informations";
			}
	}
	

exit();
?>