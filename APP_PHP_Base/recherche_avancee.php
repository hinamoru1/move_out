<?php
session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Recherche avancée</title>
        <link rel='stylesheet' href='CSSrecherche_avancee.css'>
        <link rel='stylesheet' href='CSSnav.css'>
        <link rel='stylesheet' href='CSSfooter.css'>
    </head>
    <body>
        
        <?php
        if (isset($_SESSION['id']))
        {
         include_once 'nav_connecte.php';   
        }
        else 
        {
         include_once 'nav_non_connecte.php';  
        }
        include_once 'formulaire_recherche_avancee.php';
        
        if(isset($_POST['valider']))
        {
            include_once 'recherche_avancee_resultats.php';
        }
        
        include_once 'footer.php';
        ?>
    </body>
</html>