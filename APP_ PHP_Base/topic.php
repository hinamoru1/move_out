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
$reponse = $bdd-> prepare('SELECT pseudo, titre, message FROM topic, utilisateur WHERE IDtopic = ?');
$reponse->execute(array($_GET['sujet']));

$donnees = $reponse->fetch()
?>
<fieldset>
	<h1>
		Titre : <?php echo htmlspecialchars($donnees['titre']); ?>

	</h1>

	<?php echo htmlspecialchars($donnees['message']); ?>
</fieldset>