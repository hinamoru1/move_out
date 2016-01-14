<?php
session_start();
$idok=0;
$adminok=0;
if(isset($_SESSION['id']))
{
if(isset($_GET['id']))
{

if($_GET['id']==$_SESSION['id'])
            {$idok=1;}
        if(isset($_SESSION['admin']))
            {$adminok=1;}
    
        if($idok===1 or $adminok===1)
        {
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Confirmation de suppression de compte.</title>
        <link rel='stylesheet' href='CSSerreur.css'>
        <link rel='stylesheet' href='CSSnav.css'>
        <link rel='stylesheet' href='CSSfooter.css'>
    </head>
    <body>
        <div id="global">
        <?php
        include_once 'nav_connecte.php';
        ?>
        
        <section>
        <?php
        if(isset($_SESSION['admin']))
        {echo ' <h3>Etes vous bien sur de vouloir supprimer ce compte ?</h3>';}
        else{echo'<h3>Etes vous bien sur de vouloir supprimer votre compte ?</h3>';}?>
        <p><br/><a href="suppression_compte_fin.php?id=<?php echo $_GET['id'];?>">Oui</a></p>
        <p><br/><a href="profil.php">Non</a></p>
        </section>
        </div>
         <?php
         include_once 'footer.php';
         ?>
    </body>
</html>
<?php
}
}else{header('Location:profil.php');}
}else{header('Location:formulaire_connection.php');}
?>

