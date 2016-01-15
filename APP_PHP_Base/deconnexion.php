<?php

session_start();
session_destroy();

?>

<!DOCTYPE html>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Succès de déconnexion.</title>
    </head>
    <body>
        <div id="global">
        <p>Vous avez bien été déconnecté. Retournez sur la page d'accueil en cliquant <a href="headpage.php">ici</a></p>
        </div>
    </body>
</html>

<?php 
header('Location:index.php');
    exit();?>
