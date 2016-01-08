 <div class="titre">
    <h1>Formulaire de creation evenement :</h1>
</div>
 
 
 <form class="formulaire" action="enregistrer_evenement1.php" method="post"  autocomplete="off">
 
	<fieldset>
	    <legend class="titre"> proposer un événement</legend><br>
	    <ol>
	        <li>
                <label for="nom_evenement">nom de l'événement</label>
                <input type="text" name="nom_evenement" placeholder="Ex : sortie au musée du Louvre" size="50" maxlength="100" id="nom_evenement"required>
	        </li>
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
	        <li>
	        	<label for="text">categorie</label>
	        	<select name="categorie_evenement" id="cathegorie_evenement" required>
	        </li>
            <?php
                while($donnees =$reponse->fetch())
                    {
                        echo '<option value=' . $donnees['IDcategorie_evenement'] . '>' . $donnees['categorie'] . '</option>';
                    }
	        ?>
	        <li>
	        	<label for="nb_participant_max">nombre de participants max</label>
	        	<input type="number" name="nb_participant_max" min="1" max="1000000" id="nb_participant_max" placeholder="nombre de participant" required><br> 
	        	<!-- 1 million de participant max -->
	        </li>
	        <label>accessibilité handicapé</label>
	        <li>
	        	<fieldset>
	        	<ol>
	        		<li>
	        			<input type="radio" name="accessibilite" id="accessibilite" value="1" required>
	        			<label for="accessibilite_ok"><img src="Images/logohandicapeok.png" alt="logo andicaper" width="25" >accessible</label>&nbsp;&nbsp;&nbsp;
	        		</li>
	        		<li>
	        			<input type="radio" name="accessibilite" id="accessibilite" value="0" required>
	        			<label for="accessibilite_nop"><img src="Images/logohandicapenop.png" alt="logo andicaper" width="25" >pas accessible</label>&nbsp;&nbsp;&nbsp;
	        		</li>
	        
	        			<!--label>Accessibilité handicapé :</label>
	        			<input type="radio" name="accessibilite" id="accessibilite" value="1" required><label>Oui</label>
	        			<input type="radio" name="accessibilite" id="accessibilite" value="0" required><label>Non</label>&nbsp;&nbsp;&nbsp;
	        			<img src="Images/logohandicapeok.png" alt="logo andicaper" width="25" -->
	        
	        
	        	</ol>
	        	</fieldset>
	        </li>
        </ol>
    </fieldset>
    <fieldset>
        <legend>quand?</legend>
        <ol>        	
            <li>
                <label for="date">date debut</label>
                <input type="date" name="date_debut" id="date_debut" required><br/>
                <label for="date">date fin</label>
                <input type="date" name="date_fin" id="date_fin" required><br/>
            </li>
            <li>
                <label for="heure_debut">heure de début</label>
                <input type="time" name="heure_debut" id="heure_debut" required><br>
                <label for="heure_fin">heure de fin</label>
                <input type="time" name="heure_fin" id="heure_fin" required>
            </li>
        </ol>            
    </fieldset>
            
     <fieldset>
        <legend>où?</legend>
        <ol>
            <li>
                <!--label for="pays">lieux</label>
                    <select name="pays" id="pays">
                        <option value="france">France</option>
                        <option value="suisse">suisse</option>
                        <option value="belgique">belgique</option>
                        <option value="royaume-uni">Royaume-Uni</option>
                        <option value="italie">italie</option>
                        <option value="espagne">espagne</option>
                        <option value="allemagne">allemagne</option>
                        <option value="japon">Japon</option>
                    </select-->
                    <input type="number" name="departement" id="departement" placeholder="code postal">
                    <input type="text" name ="ville" placeholder="ville" maxlength="100" id="ville" required>
                    <input type="text" name="rue" placeholder="rue ... / avenue ..." maxlength="150" id="rue" required>
                    <input type="number" name="numero_rue" min="1" max="1000" id="numero_rue" placeholder="numero" required>
                    <fieldset>
                            <input type="checkbox" name="bis" id="bis" value="1"><label for='bis'>bis</label>
                    </fieldset>
                    <textarea name="complement_adresse" placeholder="informations utilies sur le lieux?" maxlength="150" id="complement_adresse" rows="4" cols="35"></textarea>
            </li>   
        </ol>
     </fieldset>
     <fieldset>
        <legend class="titre">information complementaires </legend>
        <ol>
            <li>
                <fieldset>
                    <input type="checkbox" name="gratuit" id="bis" value="1"><label for='gratuit'>gratuit</label>
                </fieldset>
            </li>
            <li>
                <label for="prix_entree_mini">prix minimum en €</label>
                <input type="number" name="prix_entree_mini" min="0" max="2000" id="prix_entree_mini" placeholder="ex:12.75">
                <label for="prix_entree_max">prix maximum en €</label>
                <input type="number" name="prix_entree_max" min="0" max="2000" id="prix_entree_max" placeholder="ex:75.22">
            </li>
            <li>
                <label for="url_auxiliaire">lien auxiliere/billeterie</label>
                <input type="url" name="url_auxiliere" placeholder="entrez un url auxilière, de billeterie..." id="url_auxiliere" maxlength="256"><br>
            </li>
            <li>
                <label for="description_lieux">description du lieux</label><br>
                <textarea name="description_lieux" placeholder="ex:parc de 1000hectars avec des fontaines" id="description_lieux" maxlength="1500" rows="6" cols="35"></textarea>
            </li>
            <li>
                <label for="a_propos">a propos:</label>
                <textarea name="a_propos" id="a_propos" maxlength="1500" rows="4" cols="35" placeholder="(\/)_|°,,,°|_(\/)"></textarea>
            </li>
            <li>
				<label for="photo_evente">photos et videos liées à l'événement</label>
				<input type="file" name="photo_evente" id="photo_evente">
            </li>
                <button id="sub_cre_eve" type="submit" name="sub_inscr">Valider</button>
    
         </ol>
     </fieldset>
		 
 </form>
