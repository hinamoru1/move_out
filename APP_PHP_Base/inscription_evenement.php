<?php session_start();

?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Modification de la photo de couverture de l'évènement</title>
        <link rel="stylesheet" href="CSSformulaire.css">
        <link rel='stylesheet' href='CSSnav.css'>
        <link rel='stylesheet' href='CSSfooter.css'>
    </head>
    <body>
        <div id="global">
        <?php
        if(isset($_GET['ide'])){
            $IDevenement=$_GET['ide'];
        if (isset($_SESSION['id']))
        {
            include_once 'nav_connecte.php';
            $IDutilisateur=$_SESSION['id'];
        }
        else
        {
            header('Location:formulaire_connection.php');
        }
        ?>
        <h1 class="titre">Combien de participants voulez-vous ajouter ?</h1>
        
        <form class="formulaire" action="inscription_evenement_fin.php?id=<?php echo $IDevenement; ?>" method="post"  autocomplete="off">
 
	<fieldset>
            <ol>
	        <li>
	        	<label for="nb_participant_max">Indiquez le nombre de participants : (70maximum par compte)</label>
	        	<input type="number" name="nb_participants" min="1" max="70" value=1 id="nb_participant_max" required><br> 
	        	<!-- 1 million de participant max -->
                        
	        </li>
	    </ol>
	</fieldset>
        <fieldset>
	<button id="sub_cre_eve" type="submit" name="sub_inscr">Valider</button>
        </fieldset>
		 
 </form>
        
        
        
        </div>
        <?php
        include_once 'footer.php';
        }
        ?>
        
    </body>
</html>
