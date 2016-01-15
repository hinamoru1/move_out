<?php
session_start();
//BDD-----------------
try
{
$bdd = new PDO('mysql:host=localhost;dbname=move_out;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
//-----------------------
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Move-out: Accueil</title>
        <link rel='stylesheet' href='CSSprofil.css'>
        <link rel='stylesheet' href='CSSnav.css'>
        <link rel='stylesheet' href='CSSfooter.css'>
    </head>
    <body>
        <div id="global">
        
        <?php
        if(isset($_SESSION['admin']))
        {
         include_once 'nav_connecte.php';   
        }
        else 
        {
         header('Location:formulaire_connection.php');  
        }
        ?>
        <form action="back_office_recherche_utilisateur.php?action=<?php echo $_GET['action'];?>" method="post">
            <p>
                <label>Tapez un mot clé: 
                    <input type="text" name="recherche"/></label>
                <input type="submit" value='Valider'/>    <!--Bouton pour envoyer les informations-->
            </p>
            <p>
        </form>
        
        <?php
        if(isset($_POST['recherche']) and isset($_GET['action']))
        {
        if($_GET['action']=='voir')
        {
        ?>
        
        
<section class="affichage_liste">
    <h1>Resultats :</h1>
    <table>   
<?php


$reponse2= $bdd->prepare("SELECT * FROM utilisateur WHERE pseudo LIKE :a ORDER BY pseudo");
$reponse2->execute(array('a' => '%'.$_POST['recherche'].'%'));
//On écrit une boucle qui affiche tous les évènements créés par l'utilisateur
//On définit une variable qui s'incrémentera de 1 à chaque boucle, les lignes paires seront grises, les impaires sblanches
$color=0;
while($donnees2 =$reponse2->fetch())
{
    if($donnees2['IDimage_profil'] != 0)
    {
    $reponse3= $bdd->prepare("SELECT lien FROM multimedia WHERE  IDmultimedia = :idm");
    $reponse3->execute(array('idm' => $donnees2['IDimage_profil']));
    $donnees3 = $reponse3->fetch();
    $lien=$donnees3['lien'];
    }else{$lien='Images/profil.png';}
    $style='';
    if($color % 2 ==0){$style=' style="background-color: silver"';}
    echo '<tr '.$style.'><td class="image_recherche" style="background-image:url(\''.$lien.'\')"></td><td>Pseudo :'.htmlspecialchars($donnees2['pseudo']).'</td><td>Nom :'.htmlspecialchars($donnees2['nom_utilisateur']).'</td><td>Prénom :'.htmlspecialchars($donnees2['prenom_utilisateur']).'</td><td><a class="bouton" href="profil.php?id='.$donnees2['IDutilisateur'].'">&nbsp&nbspVoir&nbsp&nbsp</a></td>';
    $color+=1;
    }
//Si aucune boucle n'a été effectuée, on affiche que la requête est vide
if($color==0){echo '<p>Aucun évènement ne correspond à votre recherche. </p>';}
?>  
    </table>
</section>
        
        
        
        
        
        <?php
        }
        if($_GET['action']=='admin')
        {
        ?>
        
        
<section class="affichage_liste">
    <h1>Resultats :</h1>
    <table>   
<?php


$reponse2= $bdd->prepare("SELECT * FROM utilisateur WHERE pseudo LIKE :a ORDER BY pseudo");
$reponse2->execute(array('a' => '%'.$_POST['recherche'].'%'));
//On écrit une boucle qui affiche tous les évènements créés par l'utilisateur
//On définit une variable qui s'incrémentera de 1 à chaque boucle, les lignes paires seront grises, les impaires sblanches
$color=0;
while($donnees2 =$reponse2->fetch())
{
    if($donnees2['IDimage_profil'] != 0)
    {
    $reponse3= $bdd->prepare("SELECT lien FROM multimedia WHERE  IDmultimedia = :idm");
    $reponse3->execute(array('idm' => $donnees2['IDimage_profil']));
    $donnees3 = $reponse3->fetch();
    $lien=$donnees3['lien'];
    }else{$lien='Images/profil.png';}
    $style='';
    if($color % 2 ==0){$style=' style="background-color: silver"';}
    echo '<tr '.$style.'><td class="image_recherche" style="background-image:url(\''.$lien.'\')"></td><td>Pseudo :'.htmlspecialchars($donnees2['pseudo']).'</td><td>Nom :'.htmlspecialchars($donnees2['nom_utilisateur']).'</td><td>Prénom :'.htmlspecialchars($donnees2['prenom_utilisateur']).'</td><td><a class="bouton" href="ajout_administrateur.php?id='.$donnees2['IDutilisateur'].'">&nbsp&nbspAjouter en tant qu\'administrateur&nbsp&nbsp</a></td>';
    $color+=1;
    }
//Si aucune boucle n'a été effectuée, on affiche que la requête est vide
if($color==0){echo '<p>Aucun évènement ne correspond à votre recherche. </p>';}
?>  
    </table>
</section>
        
        
        
        
        </div>
        <?php
        }
        
        
        }
        include_once 'footer.php';
        ?>
    </body>
</html>