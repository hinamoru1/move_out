<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Forum</title>
	<link rel="stylesheet" href="CSS_forum.css">
  </head>
 <h1>
       <p>Derniers sujets </p></h1>
		
<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=move_out;charset=utf8', 'root', '', 
               /* La ligne qui suit est à rajouter pour obtenir des informations beaucoup plus précise lors des erreurs SQL*/
               array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}


$reponse = $bdd-> query('SELECT IDtopic, topic.titre, utilisateur.pseudo, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr FROM topic, utilisateur WHERE topic.IDutilisateur = utilisateur.IDutilisateur ORDER BY date_creation DESC LIMIT 0, 5');

while ($donnees = $reponse->fetch() )

{

?>

<div class="news">

    <h4><a href="topic.php?sujet=<?php echo $donnees['IDtopic']; ?>">

        <?php echo htmlspecialchars($donnees['titre']); ?>
		
        <em>le <?php echo $donnees['date_creation_fr']; ?></em> &nbsp;par <strong><?php echo htmlspecialchars($donnees['pseudo']); ?></strong></a>

    </h4>

    

    <p>


    <br />

    <em><a href="topic.php?sujet=<?php echo $donnees['IDtopic']; ?>">Afficher le sujet</a></em>

    </p>

</div>

<?php

} // Fin de la boucle des billets

$reponse->closeCursor();

?>
</body>

</html>