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
       <!-- <header>
            <h1>Trouvez votre prochaine sortie!</h1>
            <p>Tous les évènements ici et ailleurs.</p>
        </header>-->
        <div class="carrousel">
<section id="slideshow">
        
    <div class="container">
        <div class="slider">
            <figure>
                <img src="Images/Party.jpg" alt="" width="1200" height="500" />

            </figure><!--
            --><figure>
                <img src="Images/vin.jpg" alt="" width="1200" height="500" />
                
            </figure><!--
            --><figure>
                <img src="Images/b.png" alt="" width="1200" height="500" />
                

            </figure><!--
            --><figure>
                <img src="Images/c.jpg" alt="" width="1200" height="500" />
                
            </figure>
        </div>
    </div>
        
    <span id="timeline"></span>
    
</section>
            
<header>
            <h1>Trouvez votre prochaine sortie!</h1>
            <p>Tous les évènements ici et ailleurs.</p>
</header>      
            
</div>
        <!-- Description des fonctionnalités du site-->
            
        <div class='conteneur'>
            <div class="petit_conteneur" id="p1">
                <h3>Participez</h3>
                <p>Envie de sortir? De la gastronomie aux soirées festives en passant par les visites culturelles et les évènements sportifs, il y en a pour tous les goûts, et forcément pour le votre!</p>
            </div>
            <div class='petit_conteneur' id="p2">
                <h3>Invitez</h3>
                <p>Sortir c'est bien, sortir à plusieurs c'est mieux. Grâce au système d'amis invitez qui vous voulez à participer aux mêmes évènements que vous ou rejoignez vos amis sur les leurs.</p>
            </div>
            <div class='petit_conteneur' id="p3">
                <h3>Créez</h3>
                <p>Vous êtes débordant de créativité et voulez tester votre sens de l'organisation:Créez vos propres évènements et montrez les à la face du monde!</p>
            </div>
        </div>
        
        <!-- 2 conteneurs pricipaux de suggestions-->
		
		<!-- On affiche des évenements qui existe -->
        
        <div class='conteneur'>
            <h2>Suggestions:</h2>
			
		
		
		<?php
		if (isset($_SESSION['id']))
		{
		// il faut afficher des evenements en fonction de la localisation du membre 
		}
		else
		{
			$reponse= $bdd->query("SELECT *,DATE_FORMAT(date_debut, '%d/%m/%Y') AS date_debut_fr, multimedia.lien FROM multimedia, evenement WHERE multimedia.IDmultimedia = evenement.IDmultimedia LIMIT 0, 2");
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
		}
		?>
		</div>
        
		
		
		<!-- 2 suggestions de villes-->
        
        <div class="conteneur">
            <h2>Suggestions de villes:</h2>
            <div class="suggestion-ville" id="v-un">
                <h3>Paris</h3>
            </div>
            <div class="suggestion-ville" id="v-deux">
                <h3>Lyon</h3>
            </div>
            <a href="#" class="plus">Plus de villes</a>
        </div>
