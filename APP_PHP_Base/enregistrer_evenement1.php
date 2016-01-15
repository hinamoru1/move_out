<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Erreur de connection</title>
        <link rel='stylesheet' href='CSSerreur.css'>
        <link rel='stylesheet' href='CSSnav.css'>
        <link rel='stylesheet' href='CSSfooter.css'>
    </head>
    <body>
        <div id="global">
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
            
            
            $code_postal_evenement=$_POST['departement'];
				$nom_evenement= $_POST['nom_evenement'];
				$numero_de_rue= $_POST['numero_rue'];
				if (isset($_POST['bis']))
				{
				$bis=$_POST['bis'];
				}
				$rue=$_POST['rue'];
				$ville=$_POST['ville'];
				$complement_adresse=$_POST['complement_adresse'];
				$date_debut=$_POST['date_debut'];
				$date_fin=$_POST['date_fin'];
				$heure_debut=$_POST['heure_debut'];
				$heure_fin=$_POST['heure_fin'];
				$description_lieu_accueil=$_POST['description_lieux'];
				$nb_de_places_max=$_POST['nb_participant_max'];
				if (isset($_POST['gratuit']))
				{
				$gratuit=$_POST['gratuit'];
                                }else{$gratuit=0;}
				$prix_min=$_POST['prix_entree_mini'];
				$prix_max=$_POST['prix_entree_max'];
				if (isset($_POST['accessibilite']))
				{
				$accessibilite=$_POST['accessibilite'];
				}
                                $categorie_evenement=$_POST['categorie_evenement'];
                                $url_auxiliaire=$_POST['url_auxiliere'];
                                $a_propos=$_POST['a_propos'];
            
            
                                //verif prix
                                if ($gratuit==1){
                                    $prix_min=0;
                                    $prix_max=0;
                                }
                                if ($prix_min==$prix_max && $prix_min==0){
                                    $gratuit=1;
                                }
            
            
            
            
$date_now=date("Y-m-d");
$date=0;
$heure=0;
$prix=0;

          
if ($prix_min>$prix_max) {
    echo "<section><h1>Ton prix minimum est supérieur a ton prix maximum !</h1></section> <br>";
    $prix=1;
}
if ($date_debut>$date_fin){
    echo "<section><h1> Ta date de début est après ta date de fin ! </h1></section><br>";
    $date=1;
}
if ($date_now>$date_debut){
    echo "<section><h1> Ton evenement a déjà commencé ! </h1> </section><br>";
    $date=1;
}
if ($date_now>$date_fin){
    echo "<section><h1> Ton évenement est déjà fini ! </h1></section><br>";
    $date=1;
}
if ($heure_debut > $heure_fin && $date_debut===$date_fin){
    echo "<section><h1> Il y a un probleme au niveau de tes horaires de debut et de fin </h1></section> <br>";
    $heure=1;
}
if ($date_debut>$date_now && $date_fin>$date_debut){
$heure=0;

}
            
if($prix!=1 && $date!=1 && $heure!=1){
    $insert = $bdd->prepare("INSERT INTO  evenement(nom_evenement,numero_de_rue,bis,rue,ville,code_postal_evenement,complement_adresse,date_debut,date_fin,heure_debut,heure_fin,description_lieu_accueil,nb_de_places_max,gratuit,prix_min,prix_max,accessibilite_handicape,a_propos,IDcategorie_evenement,IDcreateur)  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $insert->bindParam(1, $nom_evenement);
    $insert->bindParam(2, $numero_de_rue);
    $insert->bindParam(3, $bis);
    $insert->bindParam(4, $rue);
    $insert->bindParam(5, $ville);
    $insert->bindParam(6, $code_postal_evenement);
    $insert->bindParam(7, $complement_adresse);
    $insert->bindParam(8, $date_debut);
    $insert->bindParam(9, $date_fin);
    $insert->bindParam(10, $heure_debut);
    $insert->bindParam(11, $heure_fin);
    $insert->bindParam(12, $description_lieu_accueil);
    $insert->bindParam(13, $nb_de_places_max);
    $insert->bindParam(14, $gratuit);
    $insert->bindParam(15, $prix_min);
    $insert->bindParam(16, $prix_max);
    $insert->bindParam(17, $accessibilite);
    $insert->bindParam(18, $a_propos);
    //$insert->bindParam(20, $url_auxiliaire);
    $insert->bindParam(19, $categorie_evenement);
    $insert->bindParam(20, $_SESSION['id']);
    $insert->execute();
    header('Location:profil.php');
    exit();
}
else 
{ ?>
         
                <section>
                    <a href='creation_evenement.php'>Retour au formulaire</a>
                </section>
        </div>
<?php      

}
?>
   
        