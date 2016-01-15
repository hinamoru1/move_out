<?php
session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Move-out: Accueil</title>
        <link rel='stylesheet' href='CSSfaq.css'>
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
        
        include_once 'vue_faq.php';
        ?>
        </div>
        <?php
        include_once 'footer.php';
        ?>
    </body>
</html>