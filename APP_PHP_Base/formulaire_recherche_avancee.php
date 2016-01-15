<h1>Recherche Avancée :</h1>

<div class="formulaire">
<form class="recherche" action="recherche_avancee.php" method="post">
    <h2>Effectuez une recherche selon vos critères :</h2>
    <label for="mot_cle" class="gra">Rechercher par mot clé :</label>
            <input id="mot_cle" name="mot_cle" type="text" placeholder="Mot clé"/>
            <br/><label for="categorie" class="gra">Rechercher par catégorie :</label>
            <select id="categorie" name='categorie'>
                <option></option>
            <?php
            //On recherche les différentes catégories dans la bdd et on créé une liste déroulante
            //Appel de la BDD
            try
                {
                    $bdd = new PDO('mysql:host=localhost;dbname=move_out;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            
                }
                catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                }
            //Selection des differentes catégories
            $reponse = $bdd->query('SELECT DISTINCT * FROM categorie_evenement');
            //Boucle créant autant de choix que de catégories
            while($donnees =$reponse->fetch())
                    {
                        echo '<option value=' . $donnees['IDcategorie_evenement'] . '>' . $donnees['categorie'] . '</option>';
                    }
            ?>
                
            </select>
        
        <br/>
                    
        <label id="label_date" for="date" class="gra">Rechercher par date :</label> <label>(Cochez la case pour activer)</label><br/>
            <input type="checkbox" name="date_min_ok" id="date_min_ok" value=1><label for="date_min_ok">Evènements après le :</label>
            <input type="date" id="date1" name="date_min"/>
            <br/><input type="checkbox" name="date_max_ok" id="date_max_ok" value=1><label for="date_max_ok"> et/ou évènements avant le :</label>
            <input type="date" id="date2" name="date_max"/>
            
        <br/>
        <label for="departement" class="gra" >Rechercher par département :</label>
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
        $reponse = $bdd->query('SELECT DISTINCT * FROM departement');
        ?>
	    <select name="departement" id="departement">
                <option></option>
            <?php
                while($donnees =$reponse->fetch())
                    {
                        echo '<option value=' . $donnees['departement_id'] . '>' .$donnees['departement_code'].' '. $donnees['departement_nom'] . '</option>';
                    }
	    ?>
            </select>
        <br><label for="lieu" class="gra">Ou alors par mot clé (Ville) :</label>
            <input type="text" id="lieu" name="lieu" placeholder="Mot clé"/>
        
        <br/>
        <label for="popularite" class="gra">Rechercher par popularité : </label><label for="popularite">Evènements ayant un nombre maximum de participants d'au moins </label>
            <input type="number" name="popularite" min="0" max="300000" id="popularite"/>
            
        
        <br/>    
        <label for="gratuit" class="gra">Rechercher seulement les évènements gratuits</label>
            <input type="checkbox" id="gratuit" name="gratuit" value="oui"/>
            
        <br/>    
        <label for="handicap" class="gra">Rechercher seulement les évènements accessibles aux handicapés</label>
            <input type="checkbox" id="handicap" name="handicap" value="oui"/>
            
        <br/>
        <button id="valider" type="submit" name="valider" >Rechercher</button>
        <button type="reset" value="Réinitialiser">Réinitialiser</button>
</form>
</div>

