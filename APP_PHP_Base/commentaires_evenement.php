<?php
//On n'affiche le champs permettant de commenter que si l'utilisateur est connecté
if(isset($_SESSION['id'])){
?>
<form action="ajout_commentaire_evenement.php?id=<?php echo $id;?>" method='POST'>
    <textarea name="texte" placeholder="Ecrivez un commentaire ..." required="required"></textarea>
    <input type="submit" value="Commenter">
</form>
<?php
}
?>

<table>
<?php
//Gestion de la limitation du nombre de messages affichés
//De base elle vaut 5
//Si on demande plus de massages elle vaudra 40
//Si on en demande encore plus on affiche tout
//Si l'utilisateur s'amuse à mettre tout autre valeur ça ne marchera pas

//On sélectionne le nom de l'auteur, la date, et le texte des différents commentaires
if(isset($_GET['limit']))
{
    if($_GET['limit']=='tout')
        {
            $reponse= $bdd->prepare("SELECT DATE_FORMAT(date_ajout, '%d/%m/%Y') AS date_ajout_fr, heure_ajout, texte, IDutilisateur FROM commentaires WHERE IDevenement = :id ORDER BY date_ajout DESC, heure_ajout DESC");
            $reponse->execute(array('id' => $id));
        }
        else
            {
                $nb=  intval($_GET['limit']);
                $reponse= $bdd->prepare("SELECT DATE_FORMAT(date_ajout, '%d/%m/%Y') AS date_ajout_fr, heure_ajout, texte, IDutilisateur FROM commentaires WHERE IDevenement = :id ORDER BY date_ajout DESC, heure_ajout DESC LIMIT 0, :limit");
                $reponse->bindValue('id', $id, PDO::PARAM_STR);
                $reponse->bindValue('limit', $nb, PDO::PARAM_INT);     
                $reponse->execute();
            }
}
else
{
$reponse= $bdd->prepare("SELECT DATE_FORMAT(date_ajout, '%d/%m/%Y') AS date_ajout_fr, heure_ajout, texte, IDutilisateur FROM commentaires WHERE IDevenement = :id ORDER BY date_ajout DESC, heure_ajout DESC LIMIT 0,5");
        $reponse->execute(array('id' => $id));
}   
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
            
            if($donnees2['IDimage_profil']==0)
            {
                $donnees3['lien']="Images/defaultprofil.png";
            }
            
            //Définition du style gris une fois sur deux
            $style='';
            if($color % 2 ==0){$style=' style="background-color: silver"';}
            $color+=1;
            
            //On s'occupe de sécuriser les variebles de l'affichage
            $donnees3['lien']=  htmlspecialchars($donnees3['lien']);
            $donnees['date_ajout_fr'] = htmlspecialchars($donnees['date_ajout_fr']);
            $donnees['heure_ajout']= htmlspecialchars($donnees['heure_ajout']);
            $donnees2['pseudo']= htmlspecialchars($donnees2['pseudo']);
            $donnees['texte']= htmlspecialchars($donnees['texte']);
            
            //On peut maintenant afficher la ligne correspondant au commmentaire
            echo '<tr class="billet_commentaire" '.$style.'><td class="image_auteur" style="background-image:url(\''.$donnees3['lien'].'\')"></td><td><div id="texte"><p>'.$donnees['date_ajout_fr'].'</p><p>'.$donnees['heure_ajout'].'</p></div><div id="texte"><p>'.$donnees2['pseudo'].' :</p><p>'.$donnees['texte'].'</p></div></td></tr>';
        }
//Si aucune boucle n'a été effectuée, on affiche qu'il n'y a aucun commentaire pour cet évènement
if($color==0){echo '<p>Il n\'y a aucun commentaire.</p>';}
?>
</table>
<div class="boutons_d_interaction">
<?php
//On prévoit l'appel de plus de résultats pour les commentaires
//Si au moins une boucle a été effectuée
if($color>=1)
{
if(isset($_GET['limit']))
{
    $plus= intval($_GET['limit']);
    if($plus>=125)
    {echo'<a class="plus" href="voir_evenement2.php?id='.$_GET['id'].'&limit=tout">Afficher tous les commentaires</a><br/>';}
    else{$plus+=30;
    echo'<a class="plus" href="voir_evenement2.php?id='.$_GET['id'].'&limit='.$plus.'">Afficher plus les commentaires</a><br/>';}
}
 else 
{
    echo'<a class="plus" href="voir_evenement2.php?id='.$_GET['id'].'&limit=35">Afficher plus de commentaires</a><br/>';
}
}
?>
</div>
