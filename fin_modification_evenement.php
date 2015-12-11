   <?php
		session_start();
            try
            {
                $bdd = new PDO('mysql:host=localhost;dbname=move_out;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            }
            catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            }
			?><pre><?php 
            print_r($_POST);

			
//			sport, :gastronomie, :soiree, :culturel, :autre_type,  :url_billeterie,:a_propos,:photo_evente
		
				$nom_evenement= $_POST['nom_evenement'];
				$numero_de_rue= $_POST['numero_rue'];
				if (isset($_POST['bis']))
				{
				$bis=$_POST['bis'];
				}
				$rue=$_POST['rue'];
				$ville=$_POST['ville'];
				$code_postal_evenement=$_POST['departement'];
				$pays=$_POST['pays'];
				$complement_adresse=$_POST['complement_adresse'];
				$date_debut=$_POST['date_debut'];
				$date_fin=$_POST['date_fin'];
				$heure_debut=$_POST['heure_debut'];
				$heure_fin=$_POST['heure_fin'];
				$description_lieu_accueil=$_POST['description_lieux'];
				$nb_de_places_max=$_POST['nb_participant_max'];
				if (isset($_POST['gratuit']))
				{
				$gratuit=$_POST['gratuit'];
				}
				$prix_min=$_POST['prix_entree_mini'];
				$prix_max=$_POST['prix_entree_max'];
				if (isset($_POST['accessibilite']))
				{
				$accessibilite=$_POST['accessibilite'];
				}
                                $categorie_evenement=$_POST['categorie_evenement'];
                                $url_auxiliaire=$_POST['url_auxiliere'];
                                $a_propos=$_POST['a_propos'];
				
				$insert = $bdd->prepare("UPDATE evenement SET nom_evenement=?,numero_de_rue=?,bis=?,rue=?,ville=?,code_postal_evenement=?,pays=?,complement_adresse=?,date_debut=?,date_fin=?,heure_debut=?,heure_fin=?,description_lieu_accueil=?,nb_de_places_max=?,gratuit=?,prix_min=?,prix_max=?,accessibilite_handicape=?,a_propos=?,IDcategorie_evenement=?,IDcreateur=? WHERE IDevenement= ?");
				
				$insert->bindParam(1, $nom_evenement);
				$insert->bindParam(2, $numero_de_rue);
				$insert->bindParam(3, $bis);
				$insert->bindParam(4, $rue);
				$insert->bindParam(5, $ville);
				$insert->bindParam(6, $code_postal_evenement);
				$insert->bindParam(7, $pays);
				$insert->bindParam(8, $complement_adresse);
				$insert->bindParam(9, $date_debut);
				$insert->bindParam(10, $date_fin);
				$insert->bindParam(11, $heure_debut);
				$insert->bindParam(12, $heure_fin);
				$insert->bindParam(13, $description_lieu_accueil);
				$insert->bindParam(14, $nb_de_places_max);
				$insert->bindParam(15, $gratuit);
				$insert->bindParam(16, $prix_min);
				$insert->bindParam(17, $prix_max);
				$insert->bindParam(18, $accessibilite);
                                $insert->bindParam(19, $a_propos);
                                //$insert->bindParam(20, $url_auxiliaire);
                                $insert->bindParam(20, $categorie_evenement);
                                $insert->bindParam(21, $_SESSION['id']);
                                $insert->bindParam(22, $_GET['id']);
				$insert->execute();
				
$id=$_GET['id'];
header('Location:voir_evenement2.php?id='.$id);
exit();
        ?>


