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

//On définit l'ID de l'évènement
$id=$_GET['id'];

//Si l'utilisateur est connecté:
if (isset($_SESSION['id']))
{
    // On vérifie que l'utilisateur est le créateur de l'évènement.
    //Pour cela on rechere le créateur de l'évènement dans la BDD
    $reponse= $bdd->prepare("SELECT IDcreateur FROM evenement WHERE  IDevenement = :id");
    $reponse->execute(array('id' => $id));
    $donnes = $reponse->fetch();
    $IDcreateur=$donnes['IDcreateur'];

    if($IDcreateur == $_SESSION['id'])
        {
        
           //On définit des variables correspondant aux erreurs potentielles
            $erreur=0;
            $taille=0;
            $extension=0;
                    
            //On va commencer par supprimer l'ancienne photo
            //On utilisa la fonction unlink(lien_du_fichier)
            //Il restera à s'assurer que l'on renomme toutes les photos avec des noms différents
            $reponse= $bdd->prepare("SELECT IDmultimedia FROM evenement WHERE IDevenement=:id");
            $reponse->execute(array('id' => $id));
            $donnees = $reponse->fetch();
            
            $reponse= $bdd->prepare("SELECT lien FROM multimedia WHERE IDmultimedia =:id");
            $reponse->execute(array('id' => $donnees['IDmultimedia']));
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
        if(isset($donnees['IDmultimedia']))
        {
        $req = $bdd->prepare('DELETE FROM multimedia WHERE IDmultimedia = :id');
        $req->execute(array('id' => $donnees['IDmultimedia']));
        }
        
        
        //On ajoute ensuite le nouveau lien dans la table multimédia de la base de données
        
        $insert = $bdd->prepare("INSERT INTO multimedia (lien,IDcreateur_multimedia) VALUES (?,?)");
                $insert->bindParam(1, $lien);
                //$insert->bindParam(2, 'image');
                $insert->bindParam(2,$_SESSION['id']);
                $insert->execute();
                
        //On met ensuite à jour l'ID de l'image de couverture de l'évènement dans la table evenement
                
        $reponse= $bdd->prepare("SELECT IDmultimedia FROM multimedia WHERE lien=:lien AND IDcreateur_multimedia =:id");
        $reponse->execute(array('lien' => $lien,'id' => $_SESSION['id']));
        $donnees2 = $reponse->fetch();
        echo $donnees2['IDmultimedia'];
        
        //On met ensuite à jour les informations concernant l'évènement
        $insert= $bdd->prepare('UPDATE evenement SET IDmultimedia=? WHERE IDevenement = ? ');
            $insert->bindParam(1,$donnees2['IDmultimedia']);
                $insert->bindParam(2, $id);
                $insert->execute();
               header('Location:voir_evenement2.php?id='.$id);
        }
        
}
else
    {
        header('Location:voir_evenement2.php?id='.$id);
    }

}
else 
    {
        header('Location:formulaire_connection.php');
    }

