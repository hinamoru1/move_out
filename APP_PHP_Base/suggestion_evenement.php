<?php $reponse= $bdd->query("SELECT *,DATE_FORMAT(date_debut, '%d/%m/%Y') AS date_debut_fr, multimedia.lien FROM multimedia, evenement WHERE multimedia.IDmultimedia = evenement.IDmultimedia LIMIT 0, 2");
			while ($donnees = $reponse->fetch())
				{
		
				//On va cherche le lien de l'image
				if ($donnees['IDmultimedia'] == 0)
					{
					//Si l'utilisateur n'a pas défini d'image on met une image de base
					$lien_image_evenement="Images/gris.jpg";
					}
				else 
				{
					$lien_image_evenement=$donnees['lien'];
					//echo $lien_image_evenement;
				}
				
		?>
			
					<a href="voir_evenement2.php?id=<?php echo $donnees['IDevenement'];;?>">
							<div class="image_couverture_evenement" style="background-image:url('<?php echo $lien_image_evenement;?>')" alt="image de l'evenement">
								<h3 class="titre"><?php echo $donnees['nom_evenement']; ;?></h3>
								<h3 class="lieu"><?php echo $donnees['ville']; ;?></h3>
								<h3 class="date"><?php echo $donnees['date_debut_fr']; ;?></h3>
							</div>
					</a>
		<?php
				}
		?>