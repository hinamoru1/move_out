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
//On regarde si on doit rendre l'évènement complet ou non
$complet=$_GET['complet'];
//echo $complet;
//Si l'utilisateur ne s'est pas amusé à modifier l'URL
if($complet == 1 OR $complet== 0){
//Si l'utilisateur est connecté:
if (isset($_SESSION['id']))
{
    // On vérifie que l'utilisateur est le créateur de l'évènement.
    //Pour cela on rechere le créateur de l'évènement dans la BDD
    $reponse= $bdd->prepare("SELECT IDcreateur FROM evenement WHERE  IDevenement = :id");
    $reponse->execute(array('id' => $id));
    $donnes = $reponse->fetch();
    $IDcreateur=$donnes['IDcreateur'];
    
$idok=0;
$adminok=0;
if($IDcreateur == $_SESSION['id'])
{$idok=1;}
if(isset($_SESSION['admin']))
{$adminok=1;}

if($idok===1 or $adminok===1)
        {
        //On modifie la valeur voulue
            $reponse= $bdd->prepare("UPDATE evenement SET complet=:complet WHERE IDevenement=:id");
            $reponse->execute(array('complet' => $complet,'id' => $id));
        }
header('Location:voir_evenement2.php?id='.$id);
}
}
 else {
    header('Location:voir_evenement2.php?id='.$id);
}
