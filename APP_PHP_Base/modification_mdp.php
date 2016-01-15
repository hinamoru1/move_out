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
        <link rel='stylesheet' href='CSStestJS.css'>
        <script type="text/javascript" src="fonctionsJS.js"></script>
        <script type="text/javascript" src="test_verification_adresse_mail.js"></script>
    </head>
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
    <form id=formulaire_de_connexion action ="validation_modif_mdp.php" method="post" onSubmit="return verify(this.mot_de_passe,this.mot_de_passe_conf,'mdp')">
        <fieldset>
            <legend>Entrez votre nouveau mot de passe:</legend>
            <ol>
		<li>
                    <label for=mdp>Mot de Passe*</label>
                    <input id=mot_de_passe name=mot_de_passe type=password maxlength=25 minlength="6" onkeyup="verifPseudo(mot_de_passe)" required>
                </li>
		<li>
                    <label for=mdp2>Confirmer le mdp*</label>
                    <input id=mot_de_passe_conf name=mot_de_passe_conf type=password maxlength=25 minlength="6" onkeyup="compare(mot_de_passe,mot_de_passe_conf)" required>
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
