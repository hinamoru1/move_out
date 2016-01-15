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
        <title>Forum</title>
        <link rel='stylesheet' href='CSSglobalAccueil.css'>
        <link rel='stylesheet' href='CSSnav.css'>
        <link rel='stylesheet' href='CSSfooter.css'>
        <link rel='stylesheet' href='CSSforum.css'>
        <script type="text/javascript" src="fonctionsJS.js"></script>
    </head>
    <body>
        <div id="global">
        <?php
        include_once 'nav_connecte.php';    
        $reponse = $bdd-> prepare('SELECT pseudo, titre, message_source,  DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr FROM topic, utilisateur WHERE topic.IDtopic = ?');
        $reponse->execute(array($_GET['sujet']));
            
        $donnees= $reponse->fetch()
        ?>
        <fieldset>
            <div class="titre">
                <h1>
		<?php echo '<p>'.htmlspecialchars($donnees['titre']). "&nbsp posté par &nbsp " .htmlspecialchars($donnees['pseudo']). '&nbspà&nbsp' .htmlspecialchars($donnees['date_creation_fr']).'</p>' ; ?>
                </h1>
            </div>

            <div class="message">
                <?php echo htmlspecialchars($donnees['message_source']);?></br>
                </fieldset>
	
                <?php 
                $reponse= $bdd->prepare("SELECT texte, IDutilisateur, date_creation FROM messages WHERE IDtopic = :sujet ORDER BY date_creation ASC");
                $reponse->execute(array('sujet' => $_GET['sujet']));
                    
                //On colore une fois sur deux les sections de commentaires, grâce à un style qui ne s'applique qu'une fois sur deux
                $color=0;
                while($donnees=$reponse->fetch())
                {
                //On cherche l'image de profil de l'utilisateur qui a commenté
                //On trouve d'abord l'id de son image de profil
                $reponse2= $bdd->prepare("SELECT pseudo,IDimage_profil FROM utilisateur WHERE  IDutilisateur = :ida");
                $reponse2->execute(array('ida' => $donnees['IDutilisateur']));
                $donnees2 = $reponse2->fetch();
                
                //On cherche maintenant le lien correspondant
                $reponse3= $bdd->prepare("SELECT lien FROM multimedia WHERE IDmultimedia = :IDphoto");
                $reponse3->execute(array('IDphoto' => $donnees2['IDimage_profil']));
                $donnees3= $reponse3->fetch();
                
                //Définition du style gris une fois sur deux
                $style='';
                if($color % 2 ==0){$style=' style="background-color: silver"';}
                $color+=1;
                
                //On peut maintenant afficher la ligne correspondant au commmentaire
                echo '<fieldset><tr class="billet_commentaire" '.$style.'><td class="image_auteur" style="background-image:url(\''.$donnees3['lien'].'\')"></td><td><div id="texte"><p>'.$donnees['date_creation'].'</p><p>'.$donnees2['pseudo'].' :</p><p>'.$donnees['texte'].'</p></div></td></tr></fieldset>';
		}
                ?>
            </div>
                <fieldset>
                    <form action ="message_post.php?sujet=<?php echo $_GET['sujet'] ;?>" method="post">
                    <label for="message">Répondre</label> : <textarea id="message" name="message" type="text" rows=2 >  </textarea> <br />
                    <button id=submit type=submit name=submit >Valider</button> </br>
                </fieldset>
            </form>
        </div>
        <?php
                include_once 'footer.php';
        ?>
    </body>
</html>
