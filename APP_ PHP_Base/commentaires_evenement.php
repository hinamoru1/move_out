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
//On sélectionne le nom de l'auteur, la date, et le texte des différents commentaires
$reponse= $bdd->prepare("SELECT DATE_FORMAT(date_ajout, '%d/%m/%Y') AS date_ajout, heure_ajout, texte, IDutilisateur FROM commentaires WHERE IDevenement = :id ORDER BY date_ajout DESC,heure_ajout DESC");
        $reponse->execute(array('id' => $id));
        
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
            echo '<tr class="billet_commentaire" '.$style.'><td class="image_auteur" style="background-image:url(\''.$donnees3['lien'].'\')"></td><td><div id="texte"><p>'.$donnees['date_ajout'].'</p><p>'.$donnees['heure_ajout'].'</p></div><div id="texte"><p>'.$donnees2['pseudo'].' :</p><p>'.$donnees['texte'].'</p></div></td></tr>';
        }
//Si aucune boucle n'a été effectuée, on affiche qu'il n'y a aucun commentaire pour cet évènement
if($color==0){echo '<p>Il n\'y a aucun commentaire.</p>';}
?>
</table>
