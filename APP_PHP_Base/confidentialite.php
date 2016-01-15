<?php
session_start();
?>
<!DOCTYPE html>
<!test>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Move-out: Confidentialité</title>
      <!--  <link rel='stylesheet' href='CSSfaq.css'> !-->
        <link rel='stylesheet' href='CSSnav.css'>
        <link rel='stylesheet' href='CSSglobalAccueil.css'>
        <link rel='stylesheet' href='CSSfooter.css'>
        <link rel='stylesheet' href='aaa.css'>
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
        include_once 'vue_confidentialite.php';
        ?>
        </div>
        <?php
        include_once 'footer.php';
        ?>
    </body>
</html>
