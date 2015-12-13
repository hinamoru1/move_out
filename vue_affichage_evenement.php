<?php
try
{
$bdd = new PDO('mysql:host=localhost;dbname=move_out;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
?>
    <section class="a">
		
			<ul class="info_supplementaire_affichage_evenement">
			
				<li><aside class="accessibilite_evenement" >
                                        <?php if($handicap==0){ echo '<img src="Images/logohandicapeok.png" alt = "accessibe aux andicapes moteur" width="50"/>';}
                                        else{ echo '<img src="Images/logohandicapenop.png" alt="non accessible aux andicapes moteur" width="50"/> ';} ?>
				</aside></li>
			
				<?php
                                if($complet==1){
                                echo '<li><aside class="evenement_complet">complet</aside></li>';}
                                ?>

				<li><aside class="enteted">
					<ul>
                                                <?php
                                                // On teste voir si l'utilisateur est inscrit
                                                $reponse= $bdd->prepare("SELECT * FROM participe WHERE IDevenement= :ide AND IDutilisateur = :idu");
                                                $reponse->execute(array('ide' => $_GET['id'],'idu' => $_SESSION['id'] ));
                                                //Si oui on lui propose de se désinscrire, si non de s'inscrire
                                                if($donnees = $reponse->fetch()){ echo '<li> <a href="desinscription_evenement.php?ide='.$_GET['id'].'">&nbsp;Ne plus participer&nbsp;</a> </li>';}
                                                else{echo '<li> <a href="inscription_evenement.php?ide='.$_GET['id'].'">&nbsp;Participer&nbsp;</a> </li>';}
                                                ?>
						
                                                <?php
                                                // On teste voir si l'évènement est dans la wishlist de l'utilisateur
                                                $reponse= $bdd->prepare("SELECT * FROM wishlist WHERE IDevenement= :ide AND IDutilisateur = :idu");
                                                $reponse->execute(array('ide' => $_GET['id'],'idu' => $_SESSION['id'] ));
                                                //Si non on lui propose de le retirer, si de l'ajouter
                                                if($donnees = $reponse->fetch()){ echo '<li> <a href="retirer_wishlist.php?ide='.$_GET['id'].'">&nbsp;♥&nbsp;</a> </li>';}
                                                else{echo '<li> <a href="ajouter_wishlist.php?ide='.$_GET['id'].'">&nbsp;♡&nbsp;</a> </li>';}
                                                ?>
                                                
                                                
                                        </ul>
                                                <?php
                                                // On regarde si l'utilisateur est ler créateur de l'évènement.
                                                //Si oui on lui affiche des commandes de gestion de l'évènement
                                                if($IDcreateur == $_SESSION['id'])
                                                {
                                                    echo '<ul><li> <a href="modification_evenement.php?id='.$_GET['id'].'">&nbsp;Modifier l\'évènement.&nbsp;</a> </li></ul>';
                                                    echo '<ul><li> <a href="#">&nbsp;Indiquer que l\'évènement est complet.&nbsp;</a> </li></ul>';
                                                    echo'<ul><li> <a href="suppression_evenement.php?id='.$_GET['id'].'">&nbsp;Supprimer l\'évènement&nbsp;</a> </li></ul>';
                                                }
                                                ?>
					
				</aside></li>
			</ul>
			
				<article>
					<h1><?php echo $nom ;?></h1>
                                        <div class="image_couverture_evenement" style="background-image:url('Images/gris.jpg')" alt="image de l'evenement"></div>
					
				</article>
			
			
		</section>

		
		<section id="aff_evenement_commentaires">
			<aside class="google_map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2628.2560482920317!2d2.1575946152837195!3d48.79609161304593!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e67c3e24eeb3d3%3A0x594635fd4dc9f849!2s5+Rue+Lamartine%2C+78370+Plaisir!5e0!3m2!1sfr!2sfr!4v1447321309575" width="300" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
			</aside>
			
			<aside class="meteo">
                <a id='lcm2K13_632' href='http://paris.lachainemeteo.com/meteo-france/ville/previsions-meteo-paris-3903-0.php'>Meteo P</a><script src='http://services.lachainemeteo.com/meteodirect/generationjs/javascript?type_affichage=vignette&w=140&h=175&idc=lcm2K13&entite=3903&type_entite=1&echeance=0&rand=632'></script>
			</aside>
			
			<article>
			
				<h2>titre evenement <?php echo $nom;?> </h2>
				<p>
                                    
                                <?php
                                // On cherche la catégorie
                                $reponse= $bdd->prepare("SELECT categorie FROM categorie_evenement WHERE  IDcategorie_evenement = :id");
                                $reponse->execute(array('id' => $IDcat_evt));
                                $donnees = $reponse->fetch();
                                $IDcat_evt=$donnees['categorie'];

                                ?>
                                    
                                    
                                <?php if($bis==1){$bis='bis ';}else{$bis='';}?>
				Lieu : <?php echo $num_rue.' '.$bis.$rue.', '.$code_postal.' '.$ville.', '.$pays;?>
                                <?php if(isset($complement_adresse)){echo '<br/>'.$complement_adresse;}?><br/><br/>
                                Categorie : <?php echo $IDcat_evt;?><br/><br/>
				Date de debut : <?php echo $date_debut;?><br/>
                                Heure de debut : <?php echo $heure_debut;?><br/><br/>
				Date de fin : <?php echo $date_fin;?><br />
				Heure de fin : <?php echo $heure_fin;?><br/> <br/>
				Nombre de places maximum : <?php echo $nb_pl_max;?> <br/> <br/>
                                <?php if(isset($desc_accueil)){ echo'Description des lieux : <br/>'.$desc_accueil.'<br/><br/>';}?>
				<?php if(isset($a_propos)){ echo'Description des lieux : <br/>'.$a_propos.'<br/>';}?>
				
				</p>
			</article>
				
			<article>
				<h2>commentaires</h2>
				<a href="#">gallerie</a>
			</article>
		</section>
