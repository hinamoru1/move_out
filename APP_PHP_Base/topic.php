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
        <link rel='stylesheet' href='CSS_forum.css'>
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
        <div class="nouveau">
            <a href="corpsforum.php"><button id="nouveau_sujet" type=submit name="nouveau_sujet" >Chercher un autre topic</button></a>
        </div>
            
        <div class="titre_topic">
            <h1>
		<?php echo htmlspecialchars($donnees['titre']); ?>
            </h1>
            <h2>
                <?php echo 'posté par &nbsp ' .htmlspecialchars($donnees["pseudo"]). ' le ' .htmlspecialchars($donnees['date_creation_fr']);?>
            </h2>
        </div>
            
            
            
            
          <!------------------------------------------->
            <div class="form_topic">
                <form action ="message_post.php?sujet=<?php echo $_GET['sujet'] ;?>" method="post">
                    <p id="nouveau_message">Ecrire un nouveau message  : </p><textarea id="message" name="message" type="text" rows=2 >  </textarea> <br />
                <button id=submit type=submit name=submit >Envoyer</button> </br>
                </form>
            </div>
              
            <div class="messages_topic">
            <table>
<?php
//Gestion de la limitation du nombre de messages affichés
//De base elle vaut 5
//Si on demande plus de massages elle vaudra 40
//Si on en demande encore plus on affiche tout
//Si l'utilisateur s'amuse à mettre tout autre valeur ça ne marchera pas

//On sélectionne le nom de l'auteur, la date, et le texte des différents commentaires
$sujet=$_GET['sujet'];
if(isset($_GET['limit']))
{
    if($_GET['limit']=='tout')
        {
            $reponse= $bdd->prepare("SELECT IDmessage, texte, IDutilisateur, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin') AS date_creation_fr FROM messages WHERE IDtopic = :sujet ORDER BY date_creation DESC");
            $reponse->execute(array('sujet' => $sujet));
        }
        else
            {
                $nb=  intval($_GET['limit']);
                $reponse= $bdd->prepare("SELECT IDmessage, texte, IDutilisateur, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin') AS date_creation_fr FROM messages WHERE IDtopic = :sujet ORDER BY date_creation DESC LIMIT 0, :limit");
                $reponse->bindValue('sujet', $sujet, PDO::PARAM_STR);
                $reponse->bindValue('limit', $nb, PDO::PARAM_INT);     
                $reponse->execute();
            }
}
else
{
$reponse= $bdd->prepare("SELECT IDmessage, texte, IDutilisateur, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin') AS date_creation_fr FROM messages WHERE IDtopic = :sujet ORDER BY date_creation DESC LIMIT 0, 10");
        $reponse->execute(array('sujet' => $sujet));
}   
        //On colore une fois sur deux les sections de messages, grâce à un style qui ne s'applique qu'une fois sur deux
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
            
            if($donnees2['IDimage_profil']==0)
            {
                $donnees3['lien']="Images/defaultprofil.png";
            }
            
            //Définition du style gris une fois sur deux
            $style=' style="background-color: silver"';
            if($color % 2 ==0){$style=' style="background-color: rgb(40,40,40); color:white"';}
            $color+=1;
            
            //On s'occupe de sécuriser les variables de l'affichage
            $donnees3['lien']=  htmlspecialchars($donnees3['lien']);
            $donnees['date_creation_fr'] = htmlspecialchars($donnees['date_creation_fr']);
            //$donnees['heure_ajout']= htmlspecialchars($donnees['heure_ajout']);
            $donnees2['pseudo']= htmlspecialchars($donnees2['pseudo']);
            $donnees['texte']= htmlspecialchars($donnees['texte']);
            
            //On peut maintenant afficher la ligne correspondant au commmentaire
            ?>
            <tr class="billet_forum" <?php echo $style; ?>>
                <td class="image_auteur" style="background-image:url('<?php echo $donnees3['lien']; ?>')">
                </td>
                <td >
                    <div id="texte">
                        <p><?php echo $donnees['date_creation_fr']; ?></p>
                        <?php if(isset($_SESSION['admin'])){ echo '<a href="suppression_message.php?id='. $donnees['IDmessage'].'">Supprimer</a>';}?>
                    </div>
                    <div id="texte">
                        <p><?php echo $donnees2['pseudo']; ?> :</p>
                        <p><?php echo $donnees['texte']; ?></p>
                    </div>
                </td>
            </tr>
            <?php
        }
//Si aucune boucle n'a été effectuée, on affiche qu'il n'y a aucun commentaire pour cet évènement
if($color==0){echo '<p>Il n\'y a aucun message dans ce topic.</p>';}
?>
</table>
<div class="lien_affichage">
<?php
//On prévoit l'appel de plus de résultats pour les commentaires
//Si au moins une boucle a été effectuée
if($color>=1)
{
if(isset($_GET['limit']))
{
    if($_GET['limit']=='tout'){;}
    else
    {
    $plus= intval($_GET['limit']);
    if($plus>=125)
    {echo'<a class="plus" href="topic.php?sujet='.$_GET['sujet'].'&limit=tout">Afficher tous les commentaires</a><br/>';}
    else{$plus+=30;
    echo'<a class="plus" href="topic.php?sujet='.$_GET['sujet'].'&limit='.$plus.'">Afficher plus les commentaires</a><br/>';}
    }
}
 else 
{
    echo'<a class="plus" href="topic.php?sujet='.$_GET['sujet'].'&limit=35">Afficher plus de commentaires</a><br/>';
}
}
?> 
</div>

            
            
            
  <!-------------------------------------------->          
            
        <!--<fieldset>
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
            </form>-->
        </div>
        <?php
                include_once 'footer.php';
        ?>
    </body>
</html>
