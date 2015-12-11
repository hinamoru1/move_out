<?php

session_start();

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
                }
        }
}
//On définit une variable portant le nom du chamin du fichier
$lien='Images/' . basename($_FILES['photo']['name']);
echo $lien;


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


//On ajoute ensuite ce lien dans la table multimédia de la base de données

$insert = $bdd->prepare("INSERT INTO multimedia (lien,type,IDcreateur_miltimedia) VALUES (?,?,?)");
        $insert->bindParam(1, $lien);
        $insert->bindParam(2, 'image');
        $insert->bindParam(3,$_SESSION['id']);
        $insert->execute();

//On met ensuite à jour l'ID de l'image de profil dans la table utilisateur

$reponse= $bdd->prepare("SELECT IDmultimedia FROM multimedia WHERE lien=:lien AND IDcreateur_miltimedia =:id");
$reponse->execute(array('id' => $_SESSION['id'],'lien' => $lien));
$donnees = $reponse->fetch();

$insert= $bdd->prepare('UPDATE utilisateur SET IDimage_profil=? WHERE IDutilisateur = ? ');
        $insert->bindParam(1,$reponse[IDmultimedia]);
        $insert->bindParam(2, $_SESSION['id']);
        $insert->execute();

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p>Votre nouvelle photo de profil a bien été définie.     <a href="profil.php">OK</a></p>
    </body>
</html>
