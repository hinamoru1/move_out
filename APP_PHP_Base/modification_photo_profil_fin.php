<?php

session_start();
try
{
$bdd = new PDO('mysql:host=localhost;dbname=move_out;charset=utf8', 'root', '', 
/* La ligne qui suit est à rajouter pour obtenir des informations beaucoup plus précise lors des erreurs SQL*/
array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}


//On définit des variables correspondant aux erreurs potentielles
$erreur=0;
$taille=0;
$extension=0;

//On va commencer par supprimer l'ancienne photo de profil
//On utilisa la fonction unlink(lien_du_fichier)
//Il restera à s'assurer que l'on renomme toutes les photos avec des noms différents
$reponse= $bdd->prepare("SELECT IDimage_profil FROM utilisateur WHERE IDutilisateur =:id");
$reponse->execute(array('id' => $_SESSION['id']));
$donnees = $reponse->fetch();

$reponse= $bdd->prepare("SELECT lien FROM multimedia WHERE IDmultimedia =:id");
$reponse->execute(array('id' => $donnees['IDimage_profil']));
$donnees2 = $reponse->fetch();

//Les insructions de suppression de l'ancienne image de profil et de suppression
//de cette photo de la table multimedia sera faite grâce à ces instruction plus bas,
//De façon à ce que l'ancienne photo ne soit pas modifiée si il y a un problème dans le chargement de la nouvelle


// On teste si le fichier a bien été envoyé et s'il n'y a pas d'erreur
if (isset($_FILES['photo']) AND $_FILES['photo']['error'] == 0)
{
        // On teste si le fichier n'est pas trop gros
        if ($_FILES['photo']['size'] <= 5000000)
        {
                // On teste si l'extension est bien celle d'une image
                $infosfichier = pathinfo($_FILES['photo']['name']);
                $extension_photo = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($extension_photo, $extensions_autorisees))
                {
                    // On stocke le fichier définitivement
                        move_uploaded_file($_FILES['photo']['tmp_name'], 'Images/' . basename($_FILES['photo']['name']));
                    // move_uploaded_file permet de stocker le fichier définitivement
                    //$_FILES['photo']['tmp_name'] permet de représenter l'adresse temporaire de l'image a stocker
                    //On stocke l'image dans Images/nomImage.??? 
                    //$_FILES['photo']['name']  permet de récupére l'adresse de l'image et basename d'en extraire uniquement le nom et l'extension
                        
                        //On définit une variable portant le nom du chemin du fichier
                    $lien='Images/' . basename($_FILES['photo']['name']);
                    echo $lien;
                }else{$extension=1;}
        }else{$taille=1;}
}else{$erreur=1;}




//On execute le changement de photo uniquement si il n'y a eu aucun message d'erreur
if($erreur==0 AND $taille==0 AND $extension==0)
{
    
//Suppression du fichier de l'ancienne photo
if(isset($donnees2['lien'])){
unlink($donnees2['lien']);
}

// Ensuite on supprime l'ancien lien dans la table multimedia
if(isset($donnees['IDimage_profil']))
{
$req = $bdd->prepare('DELETE FROM multimedia WHERE IDmultimedia = :id');
$req->execute(array('id' => $donnees['IDimage_profil']));
}


//On ajoute ensuite le nouveau lien dans la table multimédia de la base de données

$insert = $bdd->prepare("INSERT INTO multimedia (lien,IDcreateur_multimedia) VALUES (?,?)");
        $insert->bindParam(1, $lien);
        //$insert->bindParam(2, 'image');
        $insert->bindParam(2,$_SESSION['id']);
        $insert->execute();

//On met ensuite à jour l'ID de l'image de profil dans la table utilisateur

$reponse= $bdd->prepare("SELECT IDmultimedia FROM multimedia WHERE lien=:lien AND IDcreateur_multimedia =:id");
$reponse->execute(array('lien' => $lien,'id' => $_SESSION['id']));
$donnees = $reponse->fetch();
echo $donnees['IDmultimedia'];

//On met ensuite à jour les informations concernant l'utilisateur
$insert= $bdd->prepare('UPDATE utilisateur SET IDimage_profil=? WHERE IDutilisateur = ? ');
        $insert->bindParam(1,$donnees['IDmultimedia']);
        $insert->bindParam(2, $_SESSION['id']);
        $insert->execute();

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Modification de la photo de profil</title>
    </head>
    <body>
        <?php echo'<p>Votre nouvelle photo de profil a bien été définie.    <a href="profil.php">OK</a></p>';
        header('Location:profil.php');
exit();
}//Fin de la boucle de réussite de changement de photo
//On traite maintenant les différents messages 
elseif ($extension==1) {echo'<p>Votre photo n\'est pas dans un format standard ( .jpg , .jpeg ,.png , .gif). Veuillez <a href="modification_photo_profil.php">reessayer</a></p>';}
elseif ($taille==1) {echo'<p>Votre photo est trop grosse (>5Mo). Veuillez <a href="modification_photo_profil.php">reessayer</a></p>';}
elseif ($erreur==1) {echo'<p>Erreur de chargement de la photo. Veuillez <a href="modification_photo_profil.php">reessayer</a></p>';}
?>
    </body>
</html>
