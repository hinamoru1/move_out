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


if(isset($_SESSION['id']))
    {
        if(isset($_POST['submit']))
        {
            if(isset($_POST['reponse']))
                {
                    $req = $bdd->prepare('INSERT INTO messages (texte , date_creation , IDreponse, IDutilisateur, IDtopic) VALUES( :txt, CURTIME(), :idr, :idu, :idt)');
                    $req->execute(array('txt' => $_POST['message'], 'idr' => $_POST['reponse'], 'idu' => $_SESSION['id'],'idt' => $_GET['sujet']));
                }
                else
                {
                    $req = $bdd->prepare('INSERT INTO messages (texte , date_creation , IDreponse, IDutilisateur, IDtopic) VALUES( :txt, CURTIME(), :idr, :idu, :idt)');
                    $req->execute(array('txt' => $_POST['message'], 'idr' => 0, 'idu' => $_SESSION['id'],'idt' => $_GET['sujet']));
                }
                    
        }
        
    }
header('Location: topic.php?sujet='.$_GET['sujet']);
?>