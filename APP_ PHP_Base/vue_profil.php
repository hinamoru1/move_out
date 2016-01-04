<header>
    <h1>Mon Profil:</h1>
</header>

<section class="section_infos">
    <article class="affichage"> 
        <div class="image_profil" style="background-image:url('<?php echo $lien_image_profil?>')"></div>
        <a href="modification_photo_profil.php"><p class="bouton">Modifier ma photo de profil</p></a>
    </article>
    
    <article class='infos'>
        <fieldset>
            <legend>Informations du profil</legend>
            <?php
            if($admin==1){echo'<p> Vous êtes administrateur. </p>';}
            if($nom!==''){echo'<p>Nom :  '.$nom.' </p>';}
            if($prenom!==''){echo'<p>Prenom :  '.$prenom.' </p>';}
            if($sexe==1){echo '<p>Sexe :  Homme</p>';}
            if($sexe==0){echo '<p>Sexe :  Femme</p>';}
            echo '<p>Pseudo :  '.$pseudo.' </p>';
            echo '<p>Adresse mail :  '.$mail.' </p>';
            echo '<p>Date de naissance :  '.$date_naissance.' </p>';
            if($dept_residence!==0){echo'<p>Departement de résidence :  '.$dept_residence.' </p>';}
            if($newsletter==0){echo '<p>Vous n\'acceptez pas de newsletter.<p/>';}
            if($newsletter==1){echo '<p>Vous acceptez la newsletter.<p/>';}
            ?>
            <a href="modification_infos_profil.php"><p class="bouton">Modifier mes informations</p></a>
            <a href="modification_mdp.php"><p class="bouton">Modifier mon mot de passe</p></a>
            <a href="suppression_compte_validation.php"><p class="bouton">Supprimer mon compte</p></a>
        </fieldset>
    </article>
</section>


<!-- Affichons les évènements créés par l'utilisateur-->
<section class="affichage_liste">
    <h1>Mes évènements :</h1>
    <a href="formulaire_creation_evenement.php"><p class="bouton">Créer un évènement</p></a>
    <div>
    <table>
<?php
//On écrit une boucle qui affiche tous les évènements créés par l'utilisateur
//On définit une variable qui s'incrémentera de 1 à chaque boucle, les lignes paires seront grises, les impaires sblanches
$color=0;
while($donnees2 =$reponse2->fetch())
{
    $style='';
    if($color % 2 ==0){$style=' style="background-color: silver"';}
    echo '<tr '.$style.'><td>'.$donnees2['nom_evenement'].'</td><td>'.$donnees2['date_debut'].'</td><td>'.$donnees2['numero_de_rue'].' '.$donnees2['rue'].', '.$donnees2['ville'].', '.$donnees2['pays'].'</td><td><a class="bouton" href="voir_evenement2.php?id='.$donnees2['IDevenement'].'">&nbsp&nbspVoir&nbsp&nbsp</a></td>';
    $color+=1;
    }
//Si aucune boucle n'a été effectuée, on affiche que la requête est vide
if($color==0){echo '<p>Vous n\'avez encore créé aucun évènement. </p>';}
?>  
    </table>
    </div>
</section>

<!-- Affichons les évènements auxquels l'utilisateur participe-->
<section class="affichage_liste">
    <h1>Evènements auxquels je participe :</h1>
    <div>
    <table>
<?php
//On écrit une boucle qui affiche tous les évènements créés par l'utilisateur
//On définit une variable qui s'incrémentera de 1 à chaque boucle, les lignes paires seront grises, les impaires blanches
$color=0;
while($donnees3 =$reponse3->fetch())
{
    $style='';
    if($color % 2 ==0){$style=' style="background-color: silver"';}
    echo '<tr '.$style.'><td>'.$donnees3['nom_evenement'].'</td><td>'.$donnees3['date_debut'].'</td><td>'.$donnees3['numero_de_rue'].' '.$donnees3['rue'].', '.$donnees3['ville'].', '.$donnees3['pays'].'</td><td><a class="bouton" href="voir_evenement2.php?id='.$donnees3['IDevenement'].'">&nbsp&nbspVoir&nbsp&nbsp</a></td>';
    $color+=1;
    }
//Si aucune boucle n'a été effectuée, on affiche que la requête est vide
if($color==0){echo '<p>Vous ne participez encore à aucun évènement. </p>';}
?>  </table>
    </div>
    
</section>

<!-- Affichons les évènements de la wishlist de l'utilisateur-->
<section class="affichage_liste">
    <h1>Ma Wishlist :</h1>
    <div>
    <table>
<?php
//On écrit une boucle qui affiche tous les évènements créés par l'utilisateur
//On définit une variable qui s'incrémentera de 1 à chaque boucle, les lignes paires seront grises, les impaires sblanches
$color=0;
while($donnees4 =$reponse4->fetch())
{
    $style='';
    if($color % 2 ==0){$style=' style="background-color: silver"';}
    echo '<tr '.$style.'><td>'.$donnees4['nom_evenement'].'</td><td>'.$donnees4['date_debut'].'</td><td>'.$donnees4['numero_de_rue'].' '.$donnees4['rue'].', '.$donnees4['ville'].', '.$donnees4['pays'].'</td><td><a class="bouton" href="voir_evenement2.php?id='.$donnees2['IDevenement'].'">&nbsp&nbspVoir&nbsp&nbsp</a></td>';
    $color+=1;
    }
//Si aucune boucle n'a été effectuée, on affiche que la requête est vide
if($color==0){echo '<p>Vous n\'avez encore ajouté aucun évènement à votre wishlist. </p>';}
?>  
    </div>
    </table>
    
</section>

