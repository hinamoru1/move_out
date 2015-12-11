<?php

session_start();

?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Modification du mot de passe</title>
    </head>
    <body>

    <form id=inscription action ="validation_modif_mdp.php" method="post">
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
        
    </body>
</html>
