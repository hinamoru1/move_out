<?php
try
{
$bdd = new PDO('mysql:host=localhost;dbname=move_out;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
?>

<!--D'abord un partie avec le titre, l'image de l'évènement, et les boutons d'interaction avec l'evt-->
<section class="haut_page_evenement">
    
    <aside class="titre_evenement"><!-- Titre -->
        <h1><?php echo $nom ;?></h1>
    </aside>
    
    <aside class="boutons_d_interaction" id="bouton_inscription"><!-- boutons -->
        
        <!-- première série de boutons-->
        <div>
            <!-- Logo handicapé -->
            <?php if($handicap==1){ echo '<img src="Images/logohandicapeok.png" alt = "accessible aux handicapes moteur"/>';}
            else{ echo '<img src="Images/logohandicapenop.png" alt="non accessible aux handicapes moteur"/>';} ?>
            
            <?php
                //Si l'utilisateur est connecté:
                if (isset($_SESSION['id']))
                {
                    //On vérifie que l'évènement n'est pas complet
                    if($complet==1)
                        {
                        echo '<p class="evenement_complet">&nbsp;complet&nbsp;</p>';
                        //On donne quand même la possibilité à l'utilisateur de se désinscrire
                        // On teste voir si l'utilisateur est inscrit
                        $reponse= $bdd->prepare("SELECT * FROM participe WHERE IDevenement= :ide AND IDutilisateur = :idu");
                        $reponse->execute(array('ide' => $_GET['id'],'idu' => $_SESSION['id'] ));
                        //Si oui on lui propose de se désinscrire
                        if($donnees = $reponse->fetch()){ echo '<a href="desinscription_evenement.php?ide='.$_GET['id'].'">Ne plus participer</a>';}
                        }
                        else
                        {
                        //Si l'évènement n'est pas complet, On teste voir si l'utilisateur est inscrit
                        $reponse= $bdd->prepare("SELECT * FROM participe WHERE IDevenement= :ide AND IDutilisateur = :idu");
                        $reponse->execute(array('ide' => $_GET['id'],'idu' => $_SESSION['id'] ));
                        //Si oui on lui propose de se désinscrire, si non de s'inscrire
                        if($donnees = $reponse->fetch()){ echo '<a href="desinscription_evenement.php?ide='.$_GET['id'].'">Ne plus participer</a>';}
                        else{echo '<a href="inscription_evenement.php?ide='.$_GET['id'].'">Participer</a>';}   
                        }
                    //On ajoute le bouton d'ajout/ suppression de la wishlist
                    // On teste voir si l'évènement est dans la wishlist de l'utilisateur
                    $reponse= $bdd->prepare("SELECT * FROM wishlist WHERE IDevenement= :ide AND IDutilisateur = :idu");
                    $reponse->execute(array('ide' => $_GET['id'],'idu' => $_SESSION['id'] ));
                    //Si oui on lui propose de la retirer, si non de l'ajouter
                    if($donnees = $reponse->fetch()){ echo '<a href="retirer_wishlist.php?ide='.$_GET['id'].'">♥</a>';}
                    else{echo '<a href="ajouter_wishlist.php?ide='.$_GET['id'].'">♡</a>';}
                }
                //Si l'utilisateur n'est pas connecté
                else
                {
                //Si l'évènement est complet on l'affiche
                if($complet==1)
                    {
                    echo '<p class="evenement_complet">complet</p>';
                    }
                
                }
                
                ?>
        </div>
        
    </aside>
    
    <article> <!-- Image de l'évènement -->
        <?php
        //On va cherche le lien de l'image
        if ($IDmultimedia == 0)
        {
        //Si l'utilisateur n'a pas défini d'image on met une image de base
        $lien_image_evenement="Images/gris.jpg";
        }
        else 
        {
        //S'il en a définit une on cherche son lien
        $reponse= $bdd->prepare("SELECT lien FROM multimedia WHERE IDmultimedia = :id");
        $reponse->execute(array('id' => $IDmultimedia));
        $donnees = $reponse->fetch();
        
        $lien_image_evenement=  htmlspecialchars($donnees['lien']);
        //echo $lien_image_evenement;
        }
        ?>
        <div class="image_couverture_evenement" style="background-image:url('<?php echo $lien_image_evenement;?>')" alt="image de l'evenement"></div>
        
        <aside class="boutons_d_interaction" id="bouton_modif">
            
            
            <!-- Deuxième série de boutons, si l'utilisateur est connecté et qu'il est le créateur de l'évènement -->
            <div>
                <?php
                //Si l'utilisateur est connecté:
                if (isset($_SESSION['id']))
                {
                 // On regarde si l'utilisateur est le créateur de l'évènement ou un admin
                //Si oui on lui affiche des commandes de gestion de l'évènement
                if($IDcreateur == $_SESSION['id'] or isset($_SESSION['admin']))
                {
                 //Si l'évènement est complet on propose d'indiquer qu'il l'est et inversement
                if($complet==1)
                        {echo '<a href="evenement_complet.php?id='.$id.'&complet=0">Indiquer que l\'évènement n\'est plus complet</a>';}
                        else{echo '<a href="evenement_complet.php?id='.$id.'&complet=1">Indiquer que l\'évènement est complet</a>';}
                echo '<a href="modification_evenement.php?id='.$_GET['id'].'">Modifier</a>';
                echo'<a href="suppression_evenement.php?id='.$_GET['id'].'">Supprimer</a>';
                echo'<a href="modification_photo_evenement.php?id='.$_GET['id'].'">Changer la photo</a>';
                }       
            }  
            else 
                {
                    //Dans tous les cas si l'utilisateur n'est pas connecté on lui propose de le faire
                echo '<a href="formulaire_connection.php" id="bouton_connexion">Connectez vous pour pouvoir interagir</a>';
                }
            ?>
        </div>
            
            
        </aside>    
        
    </article>
    
</section>

<!--Ensuite la description de l'évènement,la carte google maps, la météo et les commentaires-->
<section class="bas_page_evenement">
    <aside class="google_map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2628.2560482920317!2d2.1575946152837195!3d48.79609161304593!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e67c3e24eeb3d3%3A0x594635fd4dc9f849!2s5+Rue+Lamartine%2C+78370+Plaisir!5e0!3m2!1sfr!2sfr!4v1447321309575" width="300" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
    </aside>
			
    <aside class="meteo">
        <a id='lcm2K13_632' href='http://paris.lachainemeteo.com/meteo-france/ville/previsions-meteo-paris-3903-0.php'>Meteo P</a><script src='http://services.lachainemeteo.com/meteodirect/generationjs/javascript?type_affichage=vignette&w=140&h=175&idc=lcm2K13&entite=3903&type_entite=1&echeance=0&rand=632'></script>
    </aside>
    
    <!-- Infos sur l'évènement-->
    <article>
        <h2><?php echo $nom;?> </h2>
        
        <?php
            // On cherche la catégorie
            $reponse= $bdd->prepare("SELECT categorie FROM categorie_evenement WHERE  IDcategorie_evenement = :id");
            $reponse->execute(array('id' => $IDcat_evt));
            $donnees = $reponse->fetch();
            $IDcat_evt=$donnees['categorie'];
        ?>
        
        <table>
            <?php if($a_propos !=''){ echo'<tr class="gris"><td class="gras_souligne">A Propos :</td> <td class="marge">'.$a_propos.'</td></tr>';}?>
            <?php if($bis==1){$bis='bis ';}else{$bis='';}?>
            <tr><td class="gras_souligne">Lieu :</td> <td><?php echo $num_rue.' '.$bis.$rue.', '.$code_postal.' '.$ville.', '.$pays;?>
            <?php if(isset($complement_adresse)){echo '<br/>'.$complement_adresse;}?></td></tr>
            
            <!-- On s'occupe maintenant d'ajouter le prix-->
            <?php
            if($gratuit==1){$prix="gratuit";}
            elseif($prix_min == 0 AND $prix_max == 0){$prix="gratuit";}
            else{$prix='Prix minimum : '.$prix_min.' €<br/>Prix maximum : '.$prix_max.' €';}
            ?>
            
            <tr class="gris"><td class="gras_souligne">Prix :</td> <td><?php echo $prix;?></td></tr>
            <tr><td class="gras_souligne">Categorie :</td> <td><?php echo $IDcat_evt;?></td></tr>
            
            <!--On change un peu l'affichage en fonction de si les dates de début et de fin sont les mêmes ou non-->
            <?php if($date_debut == $date_fin)
                {
                ?>
                <tr class="gris"><td class="gras_souligne">Date :</td> <td><?php echo $date_debut;?></td></tr>
                <tr><td class="gras_souligne">Heure de debut :<br/>Heure de fin :</td> <td><?php echo $heure_debut . '<br/>' . $heure_fin;?></td><tr/>
                
                <?php
                }
                else
                {
                ?>
                <tr class="gris"><td class="gras_souligne">Date de debut :<br/>Heure de debut</td> <td class="marge"><?php echo $date_debut . '<br/>' . $heure_debut;?></td></tr>
                <tr><td class="gras_souligne">Date de fin :<br/>Heure de fin :</td> <td><?php echo $date_fin . '<br/>' . $heure_fin;?></td></tr>
                <?php
                }
                ?>
                 
                
                <?php // On ajoute le nombre d'inscrits pour le créateur de l'évènement
                $nb_inscrits_txt='';
                $nb_inscrits='';
                if (isset($_SESSION['id']))
                {
                 // On regarde si l'utilisateur est le créateur de l'évènement.
                //Si oui on compte le nombre d'inscrits et on l'affiche
                if($IDcreateur == $_SESSION['id'])
                {
                   $reponse= $bdd->prepare("SELECT nombre_participants FROM participe WHERE IDevenement= :id");
                   $reponse->execute(array('id' => $id));
                   $nb=0;
                   while($donnees = $reponse->fetch())
                   {
                       $nb+=$donnees['nombre_participants'];
                   }
                   $nb_inscrits_txt='<br/>Nombre d\'inscrits :';
                   $nb_inscrits='<br/>'.$nb;
                }
                }
                ?>
                <tr class="gris"><td class="gras_souligne">Nombre de places maximum :<?php echo $nb_inscrits_txt?></td> <td><?php echo $nb_pl_max;?><?php echo $nb_inscrits?></td></tr>
            
            <?php $couleur='';
            if($desc_accueil != ''){ echo'<tr><td class="gras_souligne">Description des lieux :</td> <td class="marge">'.$desc_accueil.'</td></tr>'; $couleur='class="gris"';}?>
            <?php if($lien_aux != ''){echo '<tr '.$couleur.'><td class="gras_souligne">Lien auxiliaire :</td> <td class="marge"><a href="'.$lien_aux.'">Cliquez ici</a></td></tr>';}?>
        </table>
    </article>
    
    <!-- Commentaires-->
    <article class="zone_commentaires">
        <h2>commentaires :</h2>
        <?php include_once 'commentaires_evenement.php';?>
        <a href="#">gallerie</a>
    </article>
    
</section>
