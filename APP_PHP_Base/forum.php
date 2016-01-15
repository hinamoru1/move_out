<div id="global">
    
    <?php  
        if(isset($_SESSION['id']))
        {
            echo '
            <div class="nouveau">
                <a href="nouveau_sujet.php"><button id="nouveau_sujet" type=submit name="nouveau_sujet" >Nouveau Sujet</button></a>
            </div>';
        }
        ?>
    <div class="formulaire">
    <form action="corpsforum.php" method="post">
            <p>
                <label>Tapez un mot clé :  
                    <input type="text" name="recherche"/></label>
                <button iname="r" type="submit" value='Valider'>Rechercher</button>    <!--Bouton pour envoyer les informations-->
            </p>
            <p>
        </form>
    </div>
    
    <h1>Derniers sujets :</h1>
        <?php
   
//Gestion de la limitation du nombre de messages affichés
//De base elle vaut 5
//Si on demande plus de massages elle vaudra 40
//Si on en demande encore plus on affiche tout
//Si l'utilisateur s'amuse à mettre tout autre valeur ça ne marchera pas

//On sélectionne le nom de l'auteur, la date, et le texte des différents commentaires
$recherche='%%';
if(isset($_POST['recherche']))
{ $recherche='%'.$_POST['recherche'].'%';
    if(isset($_GET['limit']))
    {
        if($_GET['limit']=='tout')
            {
                $reponse= $bdd->prepare("SELECT IDtopic, topic.titre, utilisateur.pseudo, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin') AS date_creation_fr FROM topic, utilisateur WHERE topic.IDutilisateur = utilisateur.IDutilisateur AND topic.titre LIKE :r ORDER BY date_creation DESC");
                $reponse->execute(array('r' => $recherche));
            }
            else
                {
                    $nb=  intval($_GET['limit']);
                    $reponse= $bdd->prepare("SELECT IDtopic, topic.titre, utilisateur.pseudo, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin') AS date_creation_fr FROM topic, utilisateur WHERE topic.IDutilisateur = utilisateur.IDutilisateur AND topic.titre LIKE :r ORDER BY date_creation DESC LIMIT 0, :limit");
                    $reponse->bindValue('limit', $nb, PDO::PARAM_INT);
                    $reponse->bindValue('r', $recherche);
                    $reponse->execute();
                }
    }
    else
    {
    $reponse= $bdd->prepare("SELECT IDtopic, topic.titre, utilisateur.pseudo, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin') AS date_creation_fr FROM topic, utilisateur WHERE topic.IDutilisateur = utilisateur.IDutilisateur AND topic.titre LIKE :r ORDER BY date_creation DESC LIMIT 0,10");
                $reponse->execute(array('r' => $recherche));
    }
}else
{
    if(isset($_GET['limit']))
    {
        if($_GET['limit']=='tout')
            {
                $reponse= $bdd->prepare("SELECT IDtopic, topic.titre, utilisateur.pseudo, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin') AS date_creation_fr FROM topic, utilisateur WHERE topic.IDutilisateur = utilisateur.IDutilisateur ORDER BY date_creation DESC");
                $reponse->execute(array());
            }
            else
                {
                    $nb=  intval($_GET['limit']);
                    $reponse= $bdd->prepare("SELECT IDtopic, topic.titre, utilisateur.pseudo, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin') AS date_creation_fr FROM topic, utilisateur WHERE topic.IDutilisateur = utilisateur.IDutilisateur ORDER BY date_creation DESC LIMIT 0, :limit");
                    $reponse->bindValue('limit', $nb, PDO::PARAM_INT);     
                    $reponse->execute();
                }
    }
    else
    {
    $reponse = $bdd-> query("SELECT IDtopic, topic.titre, utilisateur.pseudo, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin') AS date_creation_fr FROM topic, utilisateur WHERE topic.IDutilisateur = utilisateur.IDutilisateur ORDER BY date_creation DESC LIMIT 0, 5");
    }
}

//Ancienne requête
//$reponse = $bdd-> query('SELECT IDtopic, topic.titre, utilisateur.pseudo, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr FROM topic, utilisateur WHERE topic.IDutilisateur = utilisateur.IDutilisateur ORDER BY date_creation DESC LIMIT 0, 5');
$cmpt=0;
while ($donnees = $reponse->fetch() )
{
    $suppression='';
    if(isset($_SESSION['admin'])){$suppression='<div class="supprimer"><a href="suppression_topic.php?sujet='.$donnees['IDtopic'].'">Supprimer</a></div>';}
?>

<div class="news">
    <table>
        <tr>
            <td>
                <h4>
                    <?php echo htmlspecialchars($donnees['titre']); ?>		
                    <li>
                        <em>le <?php echo htmlspecialchars($donnees['date_creation_fr']); ?></em> &nbsp;par 
                        <strong><?php echo htmlspecialchars($donnees['pseudo']); ?></strong>
                    </li>
                </h4>
            </td>
            <td class="lien">
                <a href="topic.php?sujet=<?php echo htmlspecialchars($donnees['IDtopic']); ?>" ><em>Afficher le sujet</em></a>
            </td>
        </tr>
    </table>
</div>
    <?php echo $suppression; ?>
        
<?php
$cmpt++;
} // Fin de la boucle des billets
?>
<div class="lien_affichage">
<?php
if($cmpt === 0){
        echo 'Il n\'y a aucun topic, ou aucun topic correspondant à votre recherche';
}

if($cmpt>=1)
{
if(isset($_GET['limit']))
{
    if($_GET['limit']=='tout'){;}
    else
    {
    $plus= intval($_GET['limit']);
    if($plus>=125)
    {echo'<a class="plus" href="corpsforum.php?limit=tout">Afficher tous les topics</a><br/>';}
    else{$plus+=30;
    echo'<a class="plus" href="corpsforum.php?limit='.$plus.'">Afficher plus de topics</a><br/>';}
    }
}
 else 
{
    echo'<a class="plus" href="corpsforum.php?limit=35">Afficher plus de topics</a><br/>';
}
}


$reponse->closeCursor();
?></div>