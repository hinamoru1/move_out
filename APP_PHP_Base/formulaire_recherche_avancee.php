<h1>Recherche Avancée :</h1>

<form id="recherche" action="recherche_avancee.php" method="post">
    <fieldset>
    <h2>Effectuez une recherche selon vos critères :</h2>
        <label for="mot_cle">Rechercher par mot clé :</label>
            <input id="mot_cle" name="mot_cle" type="text" placeholder="Mot clé"/>
        <label for="categorie">Rechercher par catégorie :</label>
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
                    
        <label for="date">Rechercher par date :</label>
            <input type="checkbox" name="date_min_ok" id="date_min_ok" value=1><label for="date_min_ok">Evènements après le :</label>
            <input type="date" id="date" name="date_min"/>
            <input type="checkbox" name="date_max_ok" id="date_max_ok" value=1><label for="date_max_ok"> et/ou évènements avant le :</label>
            <input type="date" id="date" name="date_max"/>
            
        <br/>
        <label for="departement">Rechercher par département :</label>
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
        <label for="">Ou alors par mot clé (Ville) :</label>
            <input type="text" id="lieu" name="lieu" placeholder="Mot clé"/>
        
        <br/>
        <label for="popularite">Rechercher par popularité : Evènements ayant un nombre maximum de participants d'au moins </label>
            <input type="number" name="popularite" min="0" max="300000" id="popularite"/>
            
        
        <br/>    
        <label for="gratuit">Rechercher seulement les évènements gratuits</label>
            <input type="checkbox" id="gratuit" name="gratuit" value="oui"/>
            
        <br/>    
        <label for="handicap">Rechercher seulement les évènements accessibles aux handicapés</label>
            <input type="checkbox" id="handicap" name="handicap" value="oui"/>
            
        <br/>
        <button id="valider" type="submit" name="valider" >Rechercher</button>
        <input type="reset" value="Réinitialiser"></input>
    </fieldset>
</form>

