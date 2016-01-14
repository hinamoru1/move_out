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
        <title>Forum</title>
        <link rel='stylesheet' href='CSSglobalAccueil.css'>
        <link rel="stylesheet" href="CSS_forum.css">
        <link rel='stylesheet' href='CSSnav.css'>
        <link rel='stylesheet' href='CSSfooter.css'>
		<link rel='stylesheet' href='CSSforum.css'>
        <script type="text/javascript" src="fonctionsJS.js"></script>
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
                include_once 'forum.php';
                ?>
                 </div>
                 <?php
		include_once 'footer.php';
        ?>
        
    </body>
</html>