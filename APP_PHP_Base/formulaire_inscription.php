
	<div class="titre">
    <h1>Formulaire d'Inscription :</h1>
	</div>
    <form id="inscription" action="validation_inscription1.php" method="post" onSubmit="return verify(this.mot_de_passe,this.mot_de_passe_conf,'mdp'),verify(this.email,this.conf_email,'mail')">
	
      <fieldset>
        <legend>Votre identité</legend>
        <ol>
          <li>
            <label for=nom>Nom</label>
            <input id="nom" name="nom" type=text placeholder="par ex&nbsp;: Duval" autofocus>
          </li>
		   <li>
            <label for=prenom>Prénom</label>
            <input id="prenom_utilisateur" name="prenom_utilisateur" type=text placeholder="par exemple: Antonin">
		  <li>
            <label for=email>Email*</label>
            <input id="email" name="email" type=email placeholder="exemple@domaine.com" onkeyup="verifMail(this)" required>
          </li>
		  <li>
            <label for=conf_email>Confirmer Email*</label>
            <input id="conf_email" name="conf_email" type=email onkeyup="compare(email,conf_email)" required>
          </li>
          <!--<li>
            <label for=telephone>Téléphone</label>
            <input id=telephone name=telephone type=tel placeholder="par ex&nbsp;: +3375500000000" >
          </li>-->
		   <li>
            <label for=date_naissance>Date de Naissance*</label>
            <input id="date_naissance" name="date_naissance" type=date required>
            </li>
            <li>
                <fieldset>
                    <label id='unPeuPlusBas'>Sexe*:</label>
                    <ol>
                        <li>
                            <input id="homme" name="sexe" value=1 type=radio required>
                            <label for="homme">Homme</label>
                        </li>
                        <li>
                            <input id="femme" name="sexe" value=0 type=radio required>
                            <label for="femme">Femme</label>
                        </li>
                    </ol>
                </fieldset>
            </li>
        </ol>
        </fieldset>
	    <fieldset>
		<legend>Votre Compte</legend>
		<ol>	  
                    <li>
                        <label for=pseudo>Pseudo*</label>
                        <input id="pseudo" name="pseudo" type=tel placeholder="par ex&nbsp;: Rikum" required>
                    </li>
		    <li>
                        <label for="mdp">Mot de Passe*</label>
                        <input id="mot_de_passe" name="mot_de_passe" type=password maxlength=25 minlength="6" onkeyup="verifPseudo(mot_de_passe)" required>
                    </li>
                    <li>
                        <label for="mdp2">Confirmer le mdp*</label>
                        <input id="mot_de_passe_conf" name="mot_de_passe_conf" type=password maxlength=25 minlength="6" onkeyup="compare(mot_de_passe,mot_de_passe_conf)" required>
                    </li>
			<li>
			<fieldset>
			
                <label>Acceptez-vous de recevoir la newsletter ? :</label>
                <ol>
                        <li>
                            <input id=accepte_newsletter name="accepte_newsletter" value="1" type=radio checked>
                            <label for=homme>Oui</label>
                        </li>
                        <li>
                            <input id=accepte_newsletter name="accepte_newsletter" value="0" type=radio>
                            <label for=femme>Non</label>
                        </li>
                </ol>
            </fieldset>
			</li>
	    </fieldset>
        <fieldset>
        <legend>Localisation</legend>
          <ol>
            <!--<li>
              <label for=adresse>Adresse</label>
              <textarea id=adresse name=adresse rows=1 ></textarea>
            </li>-->
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
                <li>
                        <label for=pseudo>Ville*</label>
                        <input id="ville" name="ville" type=text placeholder="par ex&nbsp;: Paris" required>
                </li>
	        <li>
	        	<label for="text">Departement :</label>
	        	<select name="departement" id="departement" required>
	        </li>
            <?php
                while($donnees =$reponse->fetch())
                    {
                        echo '<option value=' . $donnees['departement_id'] . '>' .$donnees['departement_code'].' '. $donnees['departement_nom'] . '</option>';
                    }
	        ?>
                
          
        <li>
       <fieldset>
           
           <input type="checkbox" name="condition_utilisations" id="condition_utilisations" value="1" required><br>
           j'accepte les <a>conditions d'utilisation</a>
           
       </fieldset>
        </li>
        </ol>
        <button id=sub_inscr type=submit name=sub_inscr >connexion</button>
        
        
        </fieldset>
	 </form>


