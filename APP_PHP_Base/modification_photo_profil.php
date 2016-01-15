<?php

session_start();

?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Modification de la photo de couverture de l'évènement</title>
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
        
        ?>
        <h1>Modification de la photo de profil :</h1>
        <form id ="formulaire_de_connexion" action="modification_photo_profil_fin.php" method="post" enctype="multipart/form-data">
            <p>
                <strong>Sélectionnez une nouvelle photo de profil: </strong><br/><br/>(taille maximale: 5Mo)<br/><br/>
                <input type="file" name="photo" id="selection_photo"/><br/><br/>
                <button id=sub_inscr type=submit name=sub_inscr>Envoyer le fichier</button>
            </p>
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
