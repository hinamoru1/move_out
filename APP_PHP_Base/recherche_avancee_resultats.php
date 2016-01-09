<?php
if(!empty($_POST['mot_cle']))
{
    echo 'mot cle';
}
if(!empty($_POST['categorie']))
{
    echo 'categorie';
}
if(!empty($_POST['date_min_ok']))
{
    echo 'date_min_ok';
}
if(!empty($_POST['date_min']))
{
    echo 'date_min';
}
if(!empty($_POST['date_max_ok']))
{
    echo 'date_max_ok';
}
if(!empty($_POST['date_max']))
{
    echo 'date_max';
}
if(!empty($_POST['departement']))
{
    echo 'departement';
}
if(!empty($_POST['lieu']))
{
    echo 'lieu';
}
if(!empty($_POST['popularite']))
{
    echo 'popularite';
}
if(!empty($_POST['gratuit']))
{
    echo 'gratuit';
}
if(!empty($_POST['handicap']))
{
    echo 'handicap';
}

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=move_out;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
$req="SELECT IDevenement, nom_evenement,DATE_FORMAT(date_debut, '%d/%m/%Y') AS date_debut_fr,gratuit,accessibilite_handicape WHERE nom_evenement=:idev AND categorie=:idcat LIKE %a%";
$reponse= $bdd->prepare("SELECT IDevenement, nom_evenement,ville,DATE_FORMAT(date_debut, '%d/%m/%Y') AS date_debut_fr,nb_de_places_max,gratuit,complet,accessibilite_handicape,IDcategorie_evenement,IDmultimedia,complet FROM evenement WHERE nom_evenement LIKE :a");

$reponse->execute(array('a' => '%'.$_POST['mot_cle'].'%'));

?>
<table>
<?php

$color=0;
while($donnees = $reponse->fetch())
{
    //Définition du gris un affichage sur deux
    $style='';
    if($color % 2 ==0){$style=' style="background-color: silver"';}
    $color+=1;


    //On va chercher le lien de l'image
        $IDmultimedia=$donnees['IDmultimedia'];
        
        //On trouve le lien de l'image
        if ($IDmultimedia == 0)
        {
        //Si l'utilisateur n'a pas défini d'image on met une image de base
        $lien_image_evenement="Images/gris.jpg";
        }
        else 
        {
        //S'il en a définit une on cherche son lien
        $reponse2= $bdd->prepare("SELECT lien FROM multimedia WHERE IDmultimedia = :id");
        $reponse2->execute(array('id' => $IDmultimedia));
        $donnees2 = $reponse2->fetch();
        $lien_image_evenement=  htmlspecialchars($donnees2['lien']);
        //echo $lien_image_evenement;
        }
        
        //recherche du nom de la catégorie
        $reponse3= $bdd->prepare("SELECT categorie FROM categorie_evenement WHERE IDcategorie_evenement = :id");
        $reponse3->execute(array('id' => $donnees['IDcategorie_evenement']));
        $donnees3 = $reponse3->fetch();
        $categorie=htmlspecialchars($donnees3['categorie']);
        
        
        //création du dernier champ "places/gratuit" si l'évènement n'est pas complet
        //Ou complet si l'évènement l'est
        $infos_fin='';
        if($donnees['complet']==1){$infos_fin='<p class=complet>Complet</p>';}
        else
        {
            $imgpayant='';
            if($donnees['gratuit']!=1){$imgpayant='<img class="payant" src="Images/payant.png"/>';}
            $infos_fin='<p>'.$donnees['nb_de_places_max'].'</p>'.$imgpayant;
            $infos_fin=  htmlspecialchars($info_fin);
        }
        
        
        
        //sécurisation de l'affichage
        $titre=htmlspecialchars($donnees['nom_evenement']);
        $date=htmlspecialchars($donnees['date_debut_fr']);
        $ville=htmlspecialchars($donnees['ville']);
        $nb=htmlspecialchars($donnees['nb_de_places_max']);
        
        //gestion de l'affichage des logos accessibilité handicapé
        if($donnees['accessibilite_handicape']==0)
        {$imghandicap='<img class="img_handicap" src="Images/logohandicapeok.png"/>';}
        else{$imghandicap='<img class="img_handicap" src="Images/logohandicapenop.png"/>';}
        
        
        
    echo '<tr class="billet_evenement" '.$style.'><td class="image_evenement" style="background-image:url(\''.$lien_image_evenement.'\')"></td><td><div><p>'.$titre.'</p><p>'.$date.'</p><p>'.$categorie.'</p></div><div><p>'.$ville.'</p>'.$imghandicap.$infos_fin.'<a class="lien_evenement" href="voir_evenement2.php?id='.$donnees['IDevenement'].'">voir</a></div></td></tr>';   
}
if($color===0){echo 'Désolé. Il n\'y a aucun résultat correspondant à votre recherche.';}
?>
</table>

