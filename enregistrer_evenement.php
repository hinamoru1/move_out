<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            try
            {
                $bdd = new PDO('mysql:host=localhost;dbname=move_out;charset=utf8', 'root', '');

            }
            catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            }

            //une insertion dans la base de donnée

            $req = $bdd->prepare('INSERT INTO  evenement(nom_evenement,numero_de_rue,bis,rue,ville,code_postal,pays,complement_adresse,date_debut,date_fin,heure_debut,heure_fin,description_lieu_accueil,nb_de_places_max,gratuit,prix_min,prix_max)  VALUES(:nom_evenement,:numero_rue,:bis,:rue,:ville,:departement,:pays,:complement_adresse,:date_debut,:date_fin,:heure_debut, :heure_fin,:description_lieux,:nb_participant_max,:gratuit,:prix_entree_mini,:prix_entree_max');

//			sport, :gastronomie, :soiree, :culturel, :autre_type,  :url_billeterie,:a_propos,:photo_evente
            
            $req ->execute(array(			
				'nom_evenement'=> $_POST['nom_evenement'],
				'numero_de_rue'=> $_POST['numero_rue'],
				'bis'=>$_POST['bis'],
				'rue'=>$_POST['rue'],
				'ville'=>$_POST['ville'],
				'code_postal_evenement'=>$_POST['departement'],
				'pays'=>$_POST['pays'],
				'complement_adresse'=>$_POST['complement_adresse'],
				'date_debut'=>$_POST['date_debut'],
				'date_fin'=>$_POST['date_fin'],
				'heure_debut'=>$_POST['heure_debut'],
				'heure_fin'=>$_POST['heure_fin'],
				'description_lieu_accueil'=>$_POST['description_lieux'],
				'nb_de_places_max'=>$_POST['nb_participant_max'],
				'gratuit'=>$_POST['gratuit'],
				'prix_min'=>$_POST['prix_entree_mini'],
				'prix_max'=>$_POST['prix_entree_max']
				)
				
				)
				;

           echo 'création terminée';
           
//           $reponse->closeCursor();
        ?>
    </body>
</html>