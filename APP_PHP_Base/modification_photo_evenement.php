<?php

session_start();
try
{
$bdd = new PDO('mysql:host=localhost;dbname=move_out;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
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
            
            // On vérifie que l'utilisateur est le créateur de l'évènement.
            //Pour cela on rechere le créateur de l'évènement dans la BDD
            $reponse= $bdd->prepare("SELECT IDcreateur FROM evenement WHERE  IDevenement = :id");
            $reponse->execute(array('id' => $_GET['id']));
            $donnes = $reponse->fetch();
            $IDcreateur=$donnes['IDcreateur'];
            
            if($IDcreateur == $_SESSION['id'])
                {
                ?>
                <h1>Modification de la photo de couverture de l'évènement :</h1>
                <form id ="formulaire_de_connexion" action="modification_photo_evenement_fin.php?id=<?php echo $_GET['id'];?>" method="post" enctype="multipart/form-data">
                    <p>
                        <strong>Sélectionnez une nouvelle photo :</strong><br/><br/>(taille maximale: 5Mo)<br/><br/>
                        <input type="file" name="photo" id="selection_photo"/><br/><br/>
                        <button id=sub_inscr type=submit name=sub_inscr>Envoyer le fichier</button>
                    </p>
                </form>
                <?php
                    
                }
                else 
                {
                    header('Location:voir_evenement2.php?id='.$_GET['id']);
                }
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