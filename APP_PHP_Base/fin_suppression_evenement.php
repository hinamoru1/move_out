<?php
session_start();
if(isset($_SESSION['id']))
{
    if(isset($_GET['id']))
    {
try
{
$bdd = new PDO('mysql:host=localhost;dbname=move_out;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
$IDevenement=$_GET['id'];


$reponse= $bdd->prepare("SELECT IDcreateur,IDmultimedia FROM evenement WHERE  IDevenement = :id");
$reponse->execute(array('id' => $IDevenement));
$donnees = $reponse->fetch();
                                
                                
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p>
        <?php
        $idok=0;
        $adminok=0;
        if($donnees['IDcreateur']==$_SESSION['id'])
            {$idok=1;}
        if(isset($_SESSION['admin']))
            {$adminok=1;}
    
        if($idok===1 or $adminok===1)
        {echo 'ok';
        
        
        //On va aussi supprimer l'ancienne photo
            //On utilisa la fonction unlink(lien_du_fichier)
            //Il restera à s'assurer que l'on renomme toutes les photos avec des noms différents
            
            
            $reponse3= $bdd->prepare("SELECT lien FROM multimedia WHERE IDmultimedia =:id");
            $reponse3->execute(array('id' => $donnees['IDmultimedia']));
            $donnees3 = $reponse->fetch();
            
            //Suppression du fichier de l'ancienne photo
        if(isset($donnees3['lien'])){
        unlink($donnees3['lien']);
        }
        
        // Ensuite on supprime l'ancien lien dans la table multimedia
        if(isset($donnees['IDmultimedia']))
        {
        $req = $bdd->prepare('DELETE FROM multimedia WHERE IDmultimedia = :id');
        $req->execute(array('id' => $donnees['IDmultimedia']));
        }
        
        //En enfin on supprime les informations sur l'évènement lui même
        //Suppression  de toutes les informations de ce profil
        $req = $bdd->prepare('DELETE FROM evenement WHERE IDevenement = :id');
        $req->execute(array('id' => $_GET['id']));
        
        header('Location:profil.php');
        exit();
        }else
        {
        //header('Location:voir_evenement2.php?id='.$IDevenement);
        exit();
        }
    }else
        {
        //header('Location:voir_evenement2.php?id='.$IDevenement);
        exit();
        }
        
        }else
        {
        //header('Location:voir_evenement2.php?id='.$IDevenement);
        exit();
        }
        ?>
            }
        </p>
    </body>
</html>
