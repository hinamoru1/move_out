<?php
session_start();
?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Inscription</title>
        <link rel='stylesheet' href='CSSnav.css'>
        <link rel='stylesheet' href='CSSfooter.css'>
        <link rel='stylesheet' href='CSSinscription.css'>
    </head>
    <body>
        <?php
        include_once 'nav_non_connecte.php';
        include_once 'formulaire_inscription.php';
        include_once 'footer.php';
        ?>
    </body>
</html>
