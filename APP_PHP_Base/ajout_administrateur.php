<?php
session_start();
if(isset($_SESSION['id']))
{
    if(isset($_SESSION['admin']))
    {
        if(isset($_GET['id']))
        {
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
            $insert= $bdd->prepare('UPDATE utilisateur SET admin=1 WHERE IDutilisateur = ? ');
            $insert->bindParam(1,$_GET['id']);
            $insert->execute();
            header('Location:back_office.php');
        }
    }else{header('Location:profil.php');}
}else{header('Location:formulaire_connection.php');}