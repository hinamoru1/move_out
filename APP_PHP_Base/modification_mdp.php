<?php

session_start();

?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel='stylesheet' href='CSSformulaire_connexion.css'>
        <link rel='stylesheet' href='CSSnav.css'>
        <link rel='stylesheet' href='CSSfooter.css'>
        <title>Modification du mot de passe</title>
    </head>
    <body>
        <div id="global">
        
        
    <?php
        if (isset($_SESSION['id']))
        {
         include_once 'nav_connecte.php';   
        
    ?>
    <br/><br/><br/>
    <form id=formulaire_de_connexion action ="validation_modif_mdp.php" method="post">
        <fieldset>
            <legend>Entrez votre nouveau mot de passe:</legend>
            <ol>
		<li>
                    <label for=mdp>Mot de Passe*</label>
                    <input id=mot_de_passe name=mot_de_passe type=password required>
                </li>
		<li>
                    <label for=mdp2>Confirmer le mdp*</label>
                    <input id=mot_de_passe_conf name=mot_de_passe_conf type=password required>
                </li>
            </ol>
            <button id=sub_inscr type=submit name=sub_inscr >Valider</button>
	</fieldset>
    </form>
    <?php
    
    }
        else 
        {
        header('Location:formulaire_connection.php');
         
        }
    ?>
    </div>
    <?php
    include_once 'footer.php';
    ?>
    
    
    </body>
</html>
