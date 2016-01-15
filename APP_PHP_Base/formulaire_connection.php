<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>formulaire connexion</title>
        <link rel="stylesheet" href="CSSformulaire_connexion.css">
        <link rel='stylesheet' href='CSSnav.css'>
        <link rel='stylesheet' href='CSSfooter.css'>
    </head>
	
    <body>
        <div id="global">
        
        <?php
        if (isset($_SESSION['id']))
        {
         include_once 'nav_connecte.php';   
        }
        else 
        {
         include_once 'nav_non_connecte.php';  
        }
        ?>
        
        
        
        <h1>Connexion:</h1>
        <form id ="formulaire_de_connexion"action ="connection.php" method="post" >
                <fieldset>
                    <ul>
                        <li>
                            <label for="id_connection">identifiant :</label>
                            <input type="text" name="id_connection" id="id_connection" required/>
                        </li>
                        <li>
                            <label for="mdp_connection">mot de passe :</label>
                            <input type="password" name="mdp_connection" id="mdp_connection" required/><br>
                            <a href="#">mot de passe oublié?</a>
                        </li>
                </fieldset>
            <button id=sub_inscr type=submit name=sub_inscr >connexion</button>
            </form>
                
        <?php   
        ?></div><?php
                include_once 'footer.php';
        ?>
    </body>
</html>
