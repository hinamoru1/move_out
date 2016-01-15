<?php

//On va commencer par définir la requête sql en fonction des champs qui on été remplis
//On définit le valeurs de bases des différentes variables qui peuvent être utilisées.
//On définit aussi des variables qui permettent de savoir quelle requête effectuer
$mot_cle='%%';
$ville='%%';
$handicap='%%';
$gratuit='%%';
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
$categorie_valid=0;
$mot_cle_valid=0;
$date_min_valid=0;
$date_max_valid=0;
$ville_cle_valid=0;
$popularite_valid=0;
$gratuit_valid=0;
$handicap_valid=0;
$dept_valid=0;




if(!empty($_POST['mot_cle']))
{
    //echo 'mot cle';
    $mot_cle_valid=1;
    $mot_cle='%'.$_POST['mot_cle'].'%';
}

if(!empty($_POST['categorie']))
{
    //echo 'categorie';
    $categorie_valid=1;
}

if(!empty($_POST['date_min_ok']))
{
    $date_min_valid=1;
    //echo 'date_min_ok';
    if(!empty($_POST['date_min']))
    {
        $date_min=$_POST['date_min'];
        //echo 'date_min';
    }
}

if(!empty($_POST['date_max_ok']))
{
    //echo 'date_max_ok';
    $date_max_valid=1;
    if(!empty($_POST['date_max']))
    {
        $date_max=$_POST['date_max'];
        //echo 'date_max';
    }
}

if(!empty($_POST['departement']))
{
    //echo $_POST['departement'];
    $dept_valid=1;
    
}else{$_POST['departement']=0;}


if(!empty($_POST['lieu']))
{
    //echo 'lieu';
    $ville_cle_valid=1;
    $ville='%'.$_POST['lieu'].'%';
}

if(!empty($_POST['popularite']))
{
    $popularite_valid=1;
    //echo 'popularite';
    $popularite=$_POST['popularite'];
}
if(!empty($_POST['gratuit']))
{
    if($_POST['gratuit']=='oui'){$gratuit=1;};
    //echo 'gratuit';
    $gratuit_valid=1;
}
if(!empty($_POST['handicap']))
{
    //echo 'handicap';
    $handicap_valid=1;
    if($_POST['handicap']=='oui'){$handicap=1;}
}

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=move_out;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

//
//En fonction des variables qui ont été mises à 1 on effectue la requête appropriée
//
$cas1=0;
if($mot_cle_valid===1 or $ville_cle_valid===1 or $date_min_valid===1 or $date_max_valid===1 or $handicap_valid===1 or $popularite_valid===1 or $gratuit_valid===1)
{$cas1=1;}
$compte=0;

//Cas 1
if($cas1===1)
    {
    $reponse= $bdd->prepare("SELECT IDevenement, nom_evenement,ville,DATE_FORMAT(date_debut, '%d/%m/%Y') AS date_debut_fr,nb_de_places_max,gratuit,complet,accessibilite_handicape,IDcategorie_evenement,IDmultimedia,complet,prix_min,prix_max FROM evenement WHERE nom_evenement LIKE :nom_evt AND ville LIKE :ville AND accessibilite_handicape LIKE :handicap AND nb_de_places_max >= :popularite AND date_debut >= :date_min AND date_fin <= :date_max AND gratuit LIKE :gratuit ORDER BY date_debut");
    
    $reponse->execute(array('nom_evt' => $mot_cle,
                            'date_min' => $date_min,
                            'date_max' => $date_max,
                            'ville' => $ville,
                            'handicap' => $handicap,
                            'popularite' =>$popularite,
                            'gratuit' =>$gratuit
                            ));
    $compte++;
    }
//Cas 2
if ($categorie_valid===1)
    {
        $reponse= $bdd->prepare("SELECT IDevenement, nom_evenement,ville,DATE_FORMAT(date_debut, '%d/%m/%Y') AS date_debut_fr,nb_de_places_max,gratuit,complet,accessibilite_handicape,IDcategorie_evenement,IDmultimedia,complet,prix_min,prix_max FROM evenement WHERE IDcategorie_evenement =:IDcat AND date_debut >= :date_min ORDER BY date_debut");
        
        $reponse->execute(array('IDcat' => $_POST['categorie'],
                                'date_min' => $date_min,
                                ));
        $compte++;
    }
//Cas 3
if ($dept_valid===1)
    {
    //echo $_POST['departement'];
        $reponse= $bdd->prepare("SELECT IDevenement, nom_evenement,ville,DATE_FORMAT(date_debut, '%d/%m/%Y') AS date_debut_fr,nb_de_places_max,gratuit,complet,accessibilite_handicape,IDcategorie_evenement,IDmultimedia,complet,prix_min,prix_max FROM evenement WHERE nom_evenement LIKE :nom_evt AND ville LIKE :ville AND accessibilite_handicape LIKE :handicap AND nb_de_places_max >= :popularite AND date_debut >= :date_min AND date_fin <= :date_max AND gratuit LIKE :gratuit AND code_postal_evenement = :dept ORDER BY date_debut");
    
    $reponse->execute(array('nom_evt' => $mot_cle,
                            'date_min' => $date_min,
                            'date_max' => $date_max,
                            'ville' => $ville,
                            'handicap' => $handicap,
                            'popularite' =>$popularite,
                            'gratuit' =>$gratuit,
                            'dept' => $_POST['departement']
                            ));;
        $compte++;
    }
//Cas 4
if($cas1===1 and $categorie_valid===1)
    {
    $reponse= $bdd->prepare("SELECT IDevenement, nom_evenement,ville,DATE_FORMAT(date_debut, '%d/%m/%Y') AS date_debut_fr,nb_de_places_max,gratuit,complet,accessibilite_handicape,IDcategorie_evenement,IDmultimedia,complet,prix_min,prix_max FROM evenement WHERE nom_evenement LIKE :nom_evt AND ville LIKE :ville AND accessibilite_handicape LIKE :handicap AND nb_de_places_max >= :popularite AND date_debut >= :date_min AND date_fin <= :date_max AND gratuit LIKE :gratuit AND IDcategorie_evenement =:IDcat ORDER BY date_debut");
    
    $reponse->execute(array('nom_evt' => $mot_cle,
                            'date_min' => $date_min,
                            'date_max' => $date_max,
                            'ville' => $ville,
                            'handicap' => $handicap,
                            'popularite' =>$popularite,
                            'gratuit' =>$gratuit,
                            'IDcat' => $_POST['categorie']
                            ));
    $compte++;
    }
//Cas 5
if($cas1===1 and $dept_valid===1)
    {
    $reponse= $bdd->prepare("SELECT IDevenement, nom_evenement,ville,DATE_FORMAT(date_debut, '%d/%m/%Y') AS date_debut_fr,nb_de_places_max,gratuit,complet,accessibilite_handicape,IDcategorie_evenement,IDmultimedia,complet,prix_min,prix_max FROM evenement WHERE nom_evenement LIKE :nom_evt AND ville LIKE :ville AND accessibilite_handicape LIKE :handicap AND nb_de_places_max >= :popularite AND date_debut >= :date_min AND date_fin <= :date_max AND gratuit LIKE :gratuit AND code_postal_evenement = :dept ORDER BY date_debut");
    
    $reponse->execute(array('nom_evt' => $mot_cle,
                            'date_min' => $date_min,
                            'date_max' => $date_max,
                            'ville' => $ville,
                            'handicap' => $handicap,
                            'popularite' =>$popularite,
                            'gratuit' =>$gratuit,
                            'dept' => $_POST['departement']
                            ));
    $compte++;
    }
//Cas 6
if ($categorie_valid===1 and $dept_valid===1)
    {
        $reponse= $bdd->prepare("SELECT IDevenement, nom_evenement,ville,DATE_FORMAT(date_debut, '%d/%m/%Y') AS date_debut_fr,nb_de_places_max,gratuit,complet,accessibilite_handicape,IDcategorie_evenement,IDmultimedia,complet,prix_min,prix_max FROM evenement WHERE IDcategorie_evenement =:IDcat AND date_debut >= :date_min AND code_postal_evenement = :dept ORDER BY date_debut");
        
        $reponse->execute(array('IDcat' => $_POST['categorie'],
                                'date_min' => $date_min,
                                'dept' => $_POST['departement']
                                ));
        $compte++;
    }
//Cas restant
   // echo $compte;
if($compte===0)
{
    //echo 'autre';
   $reponse= $bdd->prepare("SELECT IDevenement, nom_evenement,ville,DATE_FORMAT(date_debut, '%d/%m/%Y') AS date_debut_fr,nb_de_places_max,gratuit,complet,accessibilite_handicape,IDcategorie_evenement,IDmultimedia,complet,prix_min,prix_max FROM evenement WHERE date_debut >= :date_min ORDER BY date_debut");

$reponse->execute(array('date_min' => $date_min,
                        )); 
}


?>

<?php

$color=0;
while($donnees = $reponse->fetch())
{
    //Définition du gris un affichage sur deux
    $style=' style="background-color: rgba(255,255,255,0.5)"';
    if($color % 2 ==0){$style=' style="background-color: rgba(50,50,50,0.4)"';}
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
        if($donnees['complet']==1){$infos_fin='<div class=complet>Complet</div></td><td>';}
        else
        {
            $imgpayant='';
            if($donnees['gratuit']!=1)
                {
                if($donnees['prix_min']!=0 and $donnees['prix_max']!=0)
                {$imgpayant='<img class="payant" src="Images/payant.png"/>';}
                }
            $infos_fin='Places : '.htmlspecialchars($donnees['nb_de_places_max']).'</td><td>'.$imgpayant;
        }
        
        
        
        //sécurisation de l'affichage
        $titre=htmlspecialchars($donnees['nom_evenement']);
        $date=htmlspecialchars($donnees['date_debut_fr']);
        $ville=htmlspecialchars($donnees['ville']);
        $nb=htmlspecialchars($donnees['nb_de_places_max']);
        
        //gestion de l'affichage des logos accessibilité handicapé
        if($donnees['accessibilite_handicape']==1)
        {$imghandicap='<img class="img_handicap" src="Images/logohandicapeok.png"/>';}
        else{$imghandicap='<img class="img_handicap" src="Images/logohandicapenop.png"/>';}
        
        
    echo '<div class="billet_evenement" '.$style.'>'
            . '<div class="image_evenement" style="background-image:url(\''.$lien_image_evenement.'\')"></div>'
                . '<table id="description">'
                . '<tr>'
                    . '<td>Titre : '.$titre.'</td>'
                    . '<td>Date : '.$date.'</td>'
                    . '<td> Categorie : '.$categorie.'</td>'
                . '</tr>'
                . '<tr>'
                    . '<td>Ville : '.$ville.'</td>'
                    . '<td>'.$infos_fin.$imghandicap.'<a class="lien_evenement" href="voir_evenement2.php?id='.$donnees['IDevenement'].'">voir</a></td>'
                . '</table>'
        . '</div>';   


        }
if($color===0){echo 'Désolé. Il n\'y a aucun résultat correspondant à votre recherche.';}
?>

