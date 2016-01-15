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
        <title>Move-out: Accueil</title>
        <link rel='stylesheet' href='CSSprofil.css'>
        <link rel='stylesheet' href='CSSnav.css'>
        <link rel='stylesheet' href='CSSfooter.css'>
    </head>
    <body>
        <div id="global">
        
        <?php
        if (isset($_SESSION['id']))
        {
         include_once 'nav_connecte.php';   
        }
        else 
        {
         include_once 'nav_non_connecte.php';  
        }
        ?>
        <form action="Rechercher.php" method="post">
            <p>
                <label>Tapez un mot clé: 
                    <input type="text" name="recherche"/></label>
                <input type="submit" value='Valider'/>    <!--Bouton pour envoyer les informations-->
            </p>
            <p>
        </form>
        
        <?php
        if(isset($_POST['recherche']))
        {
        ?>
        
        
<section class="affichage_liste">
    <h1>Resultats :</h1>
    <div>   
<?php


$reponse2= $bdd->prepare("SELECT * FROM evenement WHERE nom_evenement LIKE :a ORDER BY evenement.date_debut");
$reponse2->execute(array('a' => '%'.$_POST['recherche'].'%'));
//On écrit une boucle qui affiche tous les évènements créés par l'utilisateur
//On définit une variable qui s'incrémentera de 1 à chaque boucle, les lignes paires seront grises, les impaires sblanches
$color=0;
while($donnees2 =$reponse2->fetch())
{
    $style='';
    if($color % 2 ==0){$style=' style="background-color: silver"';}
    echo '<p'.$style.'>'.$donnees2['nom_evenement'].' &nbsp&nbsp&nbsp&nbsp&nbsp--&nbsp&nbsp&nbsp&nbsp&nbsp '.$donnees2['date_debut'].' &nbsp&nbsp&nbsp&nbsp&nbsp--&nbsp&nbsp&nbsp&nbsp&nbsp '.$donnees2['numero_de_rue'].' '.$donnees2['rue'].', '.$donnees2['ville'].', '.$donnees2['pays'].' &nbsp&nbsp&nbsp&nbsp&nbsp<a class="bouton" href="voir_evenement2.php?id='.$donnees2['IDevenement'].'">&nbsp&nbspVoir&nbsp&nbsp</a></p>';
    $color+=1;
    }
//Si aucune boucle n'a été effectuée, on affiche que la requête est vide
if($color==0){echo '<p>Aucun évènement ne correspond à votre recherche. </p>';}
?>  
    </div>
</section>
        
        
        
        
    </div>
        <?php
        }
        include_once 'footer.php';
        ?>
    </body>
</html>
