<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" >
        <title>formulaire de création d'événement</title>
	<!--link rel="stylesheet" href="formulaires.css"-->
    </head>
	
    <body>
		<div id="formulaire_creation_evenement">
			<form action="enregistrer_evenement1.php" method="post"  autocomplete="off">
				<fieldset>
					<legend class="titre"> proposer un événement</legend><br>
					<p>
                                            <label for="nom_evenement">nom de l'événement</label>
                                            <input type="text" name="nom_evenement" placeholder="Ex : sortie au musée du Louvre" size="50" maxlength="100" id="nom_evenement"required>
					</p>
					<p>
                                            <label for="pays">lieux</label>
                                            <select name="pays" id="pays">
                                                    <option value="france">France</option>
                                        <!--        <option value="espagne">Espagne</option>
                                                    <option value="italie">Italie</option>
                                                    <option value="royaume-uni">Royaume-Uni</option>
                                                    <option value="canada">Canada</option>
                                                    <option value="etats-unis">Ã‰tats-Unis</option>
                                                    <option value="chine">Chine</option>
                                                    <option value="japon">Japon</option> -->
                                            </select>
						
                                            <!--<select name="departement" id="departement">
                                                <option value="75">75</option>
                                                <option value="77">77</option>
                                                <option value="78">78</option>
                                                <option value="91">91</option>
                                                <option value="92">92</option>
                                                <option value="93">93</option>
                                                <option value="94">94</option>
                                                <option value="95">95</option>
                                            </select>-->
						
                                            <input type="number" name="departement" id="departement" placeholder="code postal">
                                            <input type="text" name ="ville" placeholder="ville" maxlength="100" id="ville" required>
                                            <input type="text" name="rue" placeholder="rue ... / avenue ..." maxlength="150" id="rue" required>
                                            <input type="number" name="numero_rue" min="1" max="1000" id="numero_rue" placeholder="ex:33" required> numéro
                                            <input type="checkbox" name="bis" id="bis" value="1">bis<br>
                                            <textarea name="complement_adresse" placeholder="informations utilies sur le lieux?" maxlength="150" id="complement_adresse" rows="4" cols="35"></textarea>
					</p>
                                        
                                        <p>
					<?php
                                        //On va aller chercher les différentes valeurs des catégories dans la table appropriée
                                        try
                                        {
                                            $bdd = new PDO('mysql:host=localhost;dbname=move_out;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

                                        }
                                        catch(Exception $e)
                                        {
                                            die('Erreur : '.$e->getMessage());
                                        }
                                        $reponse = $bdd->query('SELECT DISTINCT * FROM categorie_evenement');
                                        ?>
                                        
                                        
					<label for="text">categorie</label>
					<select name="categorie_evenement" id="cathegorie_evenement" required>
                                            <?php
                                            while($donnees =$reponse->fetch())
                                                {
                                                    echo '<option value=' . $donnees['IDcategorie_evenement'] . '>' . $donnees['categorie'] . '</option>';
                                                }
                                            ?>
                                            <!--<option value="sport">sport</option>
                                            <option value="gastronomie">gastronomie</option>
                                            <option value="musique">musique</option>
                                            <option value="soirée">soirée</option>
                                            <option value="culturel">culturel</option>
                                            <option value="autre">autre</option>-->
					</select>
					</p>	
					
					<fieldset>
						<legend class="titre">description de l'événement: </legend>
						<p>
                                                    <label for="date">date debut</label>
                                                    <input type="date" name="date_debut" id="date_debut" required><br/>
                                                    <label for="date">date fin</label>
                                                    <input type="date" name="date_fin" id="date_fin" required><br/>
                                                    <label for="heure_debut">heure de début</label>
                                                    <input type="time" name="heure_debut" id="heure_debut" required><br>
                                                    <label for="heure_fin">heure de fin</label>
                                                    <input type="time" name="heure_fin" id="heure_fin" required>
                                                </p>
                                                <p>
                                                    <label for="nb_participant_max">nombre de participants max</label>
                                                    <input type="number" name="nb_participant_max" min="1" max="1000000" id="nb_participant_max" placeholder="ex:35" required><br> 
                                                    <!-- 1 million de participant max -->
						</p>
                                                <p>
                                                    <label for="prix_entree_mini">prix minimum en €</label>
                                                    <input type="number" name="prix_entree_mini" min="0" max="2000" id="prix_entree_mini" placeholder="ex:12.75">
                                                    <input type="checkbox" name="gratuit" id="gratuit"><label>gratuit</label><br>
                                                    <label for="prix_entree_max">prix maximum en €</label>
                                                    <input type="number" name="prix_entree_max" min="0" max="2000" id="prix_entree_max" placeholder="ex:75.22"><br>
                                                    <label for="url_auxiliaire">lien vers la billeterie</label>
                                                    <input type="url" name="url_auxiliere" placeholder="entrez un url auxilière, de billeterie..." id="url_auxiliere" maxlength="256"><br>
                                                    <p>Accessibilité handicapé :</p>
                                                    <input type="radio" name="accessibilite" id="accessibilite" value="1" required><label>Oui</label>
                                                    <input type="radio" name="accessibilite" id="accessibilite" value="0" required><label>Non</label>&nbsp;&nbsp;&nbsp;
                                                    <img src="Images/logohandicapeok.png" alt="logo andicaper" width="25" >						</p>
						<p>
                                                    <label for="description_lieux">description du lieux</label><br>
                                                    <textarea name="description_lieux" placeholder="ex:parc de 1000hectars avec des fontaines" id="description_lieux" maxlength="1500" rows="6" cols="35"></textarea>
						</p>	
						<p>	
                                                    <label for="a_propos">a propos:</label><br>
                                                    <textarea name="a_propos" id="a_propos" maxlength="1500" rows="4" cols="35" placeholder="(\/)_|°,,,°|_(\/)"></textarea>
						</p>
					</fieldset>
					
                                            <p>
						<label for="photo_evente">photos et videos liées à l'événement</label>
						<input type="file" name="photo_evente" id="photo_evente">
                                            </p>
                                                <input type="submit" value ="proposer">
                                        </fieldset>
			</form>
		</div>		
	</body>
</html>