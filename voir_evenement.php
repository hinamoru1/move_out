<?php session_start(); ?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>Page evenement</title>
        <link rel="stylesheet" href="CSS_voir_evenement.css">
		<link rel="stylesheet" href="CSS.css">
                <link rel='stylesheet' href='CSSnav.css'>
                <link rel='stylesheet' href='CSSfooter.css'>
	</head>

	<body>
	<?php 
        
        if(isset($_SESSION['id'])){
        include_once("nav_connecte.php");}else{include_once("nav_non_connecte.php");}
        
        ?>
		<section class="a">
		
			<ul class="info_supplementaire_affichage_evenement">
			
				<li><aside class="accessibilite_evenement" >
					<img src="Images/logohandicapeok.png" alt = "accessibe aux andicapes moteur" width="50"/>
					<img src="Images/logohandicapenop.png" alt="non accessible aux andicapes moteur" width="50"/>
				</aside></li>
			
				<?php
                                if($complet==1){
                                echo '<li><aside class="evenement_complet">complet</aside></li>';}
                                ?>

				<li><aside class="enteted">
					<ul>
						<li> <a href="#">Réserver</a> </li>
						<li>  <a href="#">♡/♥</a> </li>
					</ul>
				</aside></li>
			</ul>
			
				<article>
					<h1>titre evenement</h1>
					<img class="image_couverture_evenement" src="Images/img_conf.jpg" alt="image de l'evenement" />
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
			
				<h2>titre evenement <!-- la vriable qui contient le nom de l'evenement et delet titre evenement --> </h2>
				<p>
				lieu: <!-- les variables qui contiennent la ville, la rue, le numero, bis --> <br/> <br/>
				date de debut: <!-- la variable qui contiennent la date de debut --> <br /> <br/>
				date de fin: <!-- la variable qui contiennent la date de fin --><br /> <br/>
				heure de debut :<br /> <br/>
				heure de fin: <br /> <br/>
				nombre de place maximum: <!-- la variable qui contiennent le nb de place maxi--> <br/> <br/>
				description des lieux: <br /> <br/>
				a propos: <br /> <br/>
				
				</p>
			</article>
				
			<article>
				<h2>commentaires</h2>
				<a href="#">gallerie</a>
			</article>
		</section>

		<?php include ("footer.php"); ?>
		
	</body>
</html>