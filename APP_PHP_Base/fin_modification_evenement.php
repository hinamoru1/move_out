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

		
				$nom_evenement= $_POST['nom_evenement'];
				$numero_de_rue= $_POST['numero_rue'];
				if (isset($_POST['bis']))
				{
				$bis=$_POST['bis'];
				}
				$rue=$_POST['rue'];
				$ville=$_POST['ville'];
				$code_postal_evenement=$_POST['departement'];
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
                                }else{$ratuit=1;}
				$prix_min=$_POST['prix_entree_mini'];
				$prix_max=$_POST['prix_entree_max'];
				if (isset($_POST['accessibilite']))
				{
				$accessibilite=$_POST['accessibilite'];
				}
                                $categorie_evenement=$_POST['categorie_evenement'];
                                $url_auxiliaire=$_POST['url_auxiliere'];
                                $a_propos=$_POST['a_propos'];
				
//verif prix
                                if ($gratuit==1){
                                    $prix_min=0;
                                    $prix_max=0;
                                }
                                if ($prix_min==$prix_max && $prix_min==0){
                                    $gratuit=1;
                                }
            
            
            
            
$date_now=date("Y-m-d");
$date=0;
$heure=0;
$prix=0;

          
if ($prix_min>$prix_max) {
    echo "ton prix min est supperieur a ton prix max <br>";
    $prix=1;
}
if ($date_debut>$date_fin){
    echo "ta date de debut est apres ta date de fin <br>";
    $date=1;
}
if ($date_now>$date_debut){
    echo "ton evenement a deja commencer <br>";
    $date=1;
}
if ($date_now>$date_fin){
    echo "tonevenement est deja fini <br>";
    $date=1;
}
if ($heure_debut > $heure_fin && $date_debut===$date_fin){
    echo "il y a un probleme au niveau de tes horaires de debut et de fin <br>";
    $heure=1;
}
if ($date_debut>$date_now && $date_fin>$date_debut){
$heure=0;
}
            
if($prix!=1 && $date!=1 && $date!=2 && $heure!=1){
				$insert = $bdd->prepare("UPDATE evenement SET nom_evenement=?,numero_de_rue=?,bis=?,rue=?,ville=?,code_postal_evenement=?,complement_adresse=?,date_debut=?,date_fin=?,heure_debut=?,heure_fin=?,description_lieu_accueil=?,nb_de_places_max=?,gratuit=?,prix_min=?,prix_max=?,accessibilite_handicape=?,a_propos=?,IDcategorie_evenement=?,IDcreateur=? WHERE IDevenement= ?");
				
				$insert->bindParam(1, $nom_evenement);
				$insert->bindParam(2, $numero_de_rue);
				$insert->bindParam(3, $bis);
				$insert->bindParam(4, $rue);
				$insert->bindParam(5, $ville);
				$insert->bindParam(6, $code_postal_evenement);
				$insert->bindParam(7, $pays);
				$insert->bindParam(7, $complement_adresse);
				$insert->bindParam(8, $date_debut);
				$insert->bindParam(9, $date_fin);
				$insert->bindParam(10, $heure_debut);
				$insert->bindParam(11, $heure_fin);
				$insert->bindParam(12, $description_lieu_accueil);
				$insert->bindParam(13, $nb_de_places_max);
				$insert->bindParam(14, $gratuit);
				$insert->bindParam(15, $prix_min);
				$insert->bindParam(16, $prix_max);
				$insert->bindParam(17, $accessibilite);
                                $insert->bindParam(18, $a_propos);
                                //$insert->bindParam(20, $url_auxiliaire);
                                $insert->bindParam(19, $categorie_evenement);
                                $insert->bindParam(20, $_SESSION['id']);
                                $insert->bindParam(21, $_GET['id']);
				$insert->execute();
				
$id=$_GET['id'];
header('Location:voir_evenement2.php?id='.$id);
exit();}
        ?>


