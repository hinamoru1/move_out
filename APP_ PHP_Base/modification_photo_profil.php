<?php

session_start();

?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Modification photo profil</title>
    </head>
    <body>
        <form action="modification_photo_profil_fin.php" method="post" enctype="multipart/form-data">
            <p>
                Sélectionnez une nouvelle photo de profil: <br/><br/>(taille maximale: 5Mo)<br/><br/>
                <input type="file" name="photo"/><br/><br/>
                <input type="submit" value="Envoyer le fichier">
                
            </p>
        </form>
        
        

        
        
    </body>
</html>
