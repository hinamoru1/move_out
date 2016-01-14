<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Forum</title>
	<link rel="stylesheet" href="CSS_forum.css">
    </head>
    <body>
        <div id="global">
        <h1>Derniers sujets :</h1>
	  
        <div class="nouveau">
            <a href="nouveau_sujet.php"><button id="nouveau_sujet" type=submit name="nouveau_sujet" >Nouveau Sujet</button></a>
        </div>

<?php

$reponse = $bdd-> query('SELECT IDtopic, topic.titre, utilisateur.pseudo, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr FROM topic, utilisateur WHERE topic.IDutilisateur = utilisateur.IDutilisateur ORDER BY date_creation DESC LIMIT 0, 5');

while ($donnees = $reponse->fetch() )

{

?>

<div class="news">
    <table>
        <tr>
            <td>
                <h4>
                    <?php echo htmlspecialchars($donnees['titre']); ?>		
                    <li>
                        <em>le <?php echo htmlspecialchars($donnees['date_creation_fr']); ?></em> &nbsp;par 
                        <strong><?php echo htmlspecialchars($donnees['pseudo']); ?></strong>
                    </li>
                </h4>
            </td>
            <td class="lien">
                <a href="topic.php?sujet=<?php echo htmlspecialchars($donnees['IDtopic']); ?>" ><em>Afficher le sujet</em></a>
            </td>
        </tr>
    </table>
</div>
        
<?php

} // Fin de la boucle des billets

$reponse->closeCursor();
?>
        </div>
        <?php
        include_once 'footer.php';
?>
</body>

</html>