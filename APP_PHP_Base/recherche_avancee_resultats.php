<?php

//On va commencer par définir la requête sql en fonction des champs qui on été remplis
//On définit les différentes variables qui peuvent être définies
$mot_cle='%%';
$ville='%%';
$popularite=0;
//On va obtenir la date actuelle grâce à une requête
try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=move_out;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
$insert = $bdd->prepare("UPDATE date SET date_actuelle=DATE(NOW()) WHERE id =1");
$insert->execute();
$resultat=$bdd->query('SELECT date_actuelle FROM date WHERE id=1');
$donnees=$resultat ->fetch();
$date_min=$donnees['date_actuelle'];
//echo $date_min;
$date_max='2500-00-00';

if(!empty($_POST['mot_cle']))
{
    //echo 'mot cle';
    $mot_cle='%'.$_POST['mot_cle'].'%';
}

if(!empty($_POST['categorie']))
{
    echo 'categorie';
    echo $_POST['categorie'];
}

if(!empty($_POST['date_min_ok']))
{
    echo 'date_min_ok';
    if(!empty($_POST['date_min']))
    {
        $date_min=$_POST['date_min'];
        echo 'date_min';
    }
}

if(!empty($_POST['date_max_ok']))
{
    echo 'date_max_ok';
    if(!empty($_POST['date_max']))
    {
        $date_max=$_POST['date_max'];
        echo 'date_max';
    }
}

if(!empty($_POST['departement']))
{
    echo 'departement';
}

if(!empty($_POST['lieu']))
{
    //echo 'lieu';
    $ville='%'.$_POST['lieu'].'%';
}

if(!empty($_POST['popularite']))
{
    //echo 'popularite';
    $popularite=$_POST['popularite'];
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



$reponse= $bdd->prepare("SELECT IDevenement, nom_evenement,ville,DATE_FORMAT(date_debut, '%d/%m/%Y') AS date_debut_fr,nb_de_places_max,gratuit,complet,accessibilite_handicape,IDcategorie_evenement,IDmultimedia,complet FROM evenement WHERE nom_evenement LIKE :nom_evt AND ville LIKE :ville AND accessibilite_handicape LIKE :handicap AND nb_de_places_max >= :popularite AND date_debut >= :date_min AND date_fin <= :date_max");

$reponse->execute(array('nom_evt' => $mot_cle,
                        'date_min' => $date_min,
                        'date_max' => $date_max,
                        'ville' => $ville,
                        'handicap' => '%%',
                        'popularite' =>$popularite,
                        ));

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
            $infos_fin='<p>'.htmlspecialchars($donnees['nb_de_places_max']).'</p>'.$imgpayant;
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

