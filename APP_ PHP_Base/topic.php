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
?>
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
        <?php
        include_once 'nav_connecte.php';    
		?>
	<p>

	<?php
$reponse = $bdd-> prepare('SELECT pseudo, titre, message_source, date_creation FROM topic, utilisateur WHERE topic.IDtopic = ?');
$reponse->execute(array($_GET['sujet']));

$donnees= $reponse->fetch()
?>
<fieldset>
	<div class="titre">
	<h1>
		<?php echo '<p>'.htmlspecialchars($donnees['titre']). "&nbsp posté par &nbsp " .htmlspecialchars($donnees['pseudo']). '&nbspà&nbsp' .htmlspecialchars($donnees['date_creation']).'</p>' ; ?>

	</h1>
	</div>
</fieldset>
	<div class="message">

	<?php echo htmlspecialchars($donnees['message_source']);?></br>
	
	<?php 
	$reponse = $bdd-> prepare('SELECT texte, pseudo FROM messages, utilisateur WHERE utilisateur.IDutilisateur=? , messages.IDtopic = ?');
	$reponse->execute(array($_GET['sujet'], $_SESSION['id']));
	while ($donnees= $reponse->fetch())
	{
	echo '<p>'.htmlspecialchars($donnees['pseudo']). '&nbsp:&nbsp'.htmlspecialchars($donnees['texte']). '</p>' ;?>  </br>
	<?php
	}
	?>
	</div>
	<fieldset>
	<form action ="message_post.php?sujet=<?php echo $_GET['sujet'] ;?>" method="post">
	<label for="message">Répondre</label> : <textarea id="message" name="message" type="text" rows=2 >  </textarea> <br />
	<button id=submit type=submit name=submit >Valider</button> </br>
	</fieldset>
	</p>
	</form>
