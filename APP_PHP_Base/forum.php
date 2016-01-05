<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Forum</title>
	<link rel="stylesheet" href="CSS_forum.css">
  </head>
 <h1>
       <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Derniers sujets </p>
</h1>
	  
<p>

<div class="nouveau">
<a href="nouveau_sujet.php">
<button id="nouveau_sujet" type=submit name="nouveau_sujet" >Nouveau Sujet</button>


</a>

</div>

</p>






<?php

$reponse = $bdd-> query('SELECT IDtopic, topic.titre, utilisateur.pseudo, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr FROM topic, utilisateur WHERE topic.IDutilisateur = utilisateur.IDutilisateur ORDER BY date_creation DESC LIMIT 0, 5');

while ($donnees = $reponse->fetch() )

{

?>

<div class="news">

    <h4>
	<a href="topic.php?sujet=<?php echo $donnees['IDtopic']; ?>">

        <?php echo htmlspecialchars($donnees['titre']); ?>		
        <li>
			<em>le <?php echo htmlspecialchars($donnees['date_creation_fr']); ?></em> &nbsp;par 
			<strong><?php echo htmlspecialchars($donnees['pseudo']); ?></strong>
		</li>
	</a>
    </h4>

    

    <p>


    <br />

    <em><a href="topic.php?sujet=<?php echo htmlspecialchars($donnees['IDtopic']); ?>" >Afficher le sujet</a></em>

    </p>

</div>

<?php

} // Fin de la boucle des billets

$reponse->closeCursor();

?>
</body>

</html>