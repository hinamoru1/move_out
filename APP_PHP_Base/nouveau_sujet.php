<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Forum</title>
        <link rel='stylesheet' href='CSSglobalAccueil.css'>
        <link rel='stylesheet' href='CSSnav.css'>
        <link rel='stylesheet' href='CSSfooter.css'>
		<link rel='stylesheet' href='CSSforum.css'>
        <script type="text/javascript" src="fonctionsJS.js"></script>
    </head>
    <body>
        <div is="global">
        <?php
        include_once 'nav_connecte.php';    
		?>
	<p>
	<form id="nouveau_sujet" action="validation_sujet.php" method="post">
	<fieldset>
	
	<h2>
	<label for="titre">Titre</label></br>
	<input type="text" id="titre" name="titre" size=30 placeholder="Votre titre de sujet içi"></br>
	
	<label for="message">Votre texte</label></br>
	<textarea name="message" id="message" rows=20 cols=100 placeholder="Votre message ici"></textarea></br>
	
	<input type="submit" id="submit_sujet" name="submit_sujet" value="Envoyez">
		
		
		
		
	</h2>
	</fieldset>
	</p>		
		
		
		
		
        </div>	
	<?php	
	include_once 'footer.php';
	?>	
    </body>
</html>