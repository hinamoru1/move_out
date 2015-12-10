
	<div class="titre">
    <h1>Formulaire d'Inscription :</h1>
	</div>
    <form id=inscription action ="validation_inscription.php" method="post">
	
      <fieldset>
        <legend>Votre identité</legend>
        <ol>
          <li>
            <label for=nom>Nom</label>
            <input id=nom name=nom type=text placeholder="par ex&nbsp;: Duval" autofocus>
          </li>
		   <li>
            <label for=prenom>Prénom</label>
            <input id=prenom_utilisateur name=prenom_utilisateur type=text placeholder="par ex&nbsp;: Antonin">
		  <li>
            <label for=email>Email*</label>
            <input id=email name=email type=email placeholder="exemple@domaine.com" required>
          </li>
		  <li>
            <label for=conf_email>Confirmer Email*</label>
            <input id=conf_email name=conf_email type=email required>
          </li>
          <!--<li>
            <label for=telephone>Téléphone</label>
            <input id=telephone name=telephone type=tel placeholder="par ex&nbsp;: +3375500000000" >
          </li>-->
		   <li>
            <label for=date_naissance>Date de Naissance*</label>
            <input id=date_naissance name=date_naissance type=date required>
            </li>
            <li>
                <fieldset>
                    <label id='unPeuPlusBas'>Sexe*:</label>
                    <ol>
                        <li>
                            <input id=sexe name=sexe value=1 type=radio required>
                            <label for=homme>Homme</label>
                        </li>
                        <li>
                            <input id=sexe name=sexe value=0 type=radio required>
                            <label for=femme>Femme</label>
                        </li>
                    </ol>
                </fieldset>
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
            </li>
            </fieldset>
        </ol>
        </fieldset>
	    <fieldset>
		<legend>Votre Compte</legend>
		<ol>	  
                    <li>
                        <label for=pseudo>Pseudo*</label>
                        <input id=pseudo name=pseudo type=tel placeholder="par ex&nbsp;: Rikum" required>
                    </li>
		    <li>
                        <label for=mdp>Mot de Passe*</label>
                        <input id=mot_de_passe name=mot_de_passe type=password required>
                    </li>
                    <li>
                        <label for=mdp2>Confirmer le mdp*</label>
                        <input id=mot_de_passe_conf name=mot_de_passe_conf type=password required>
                    </li>
	    </fieldset>
        <fieldset>
        <legend>Localisation</legend>
          <ol>
            <!--<li>
              <label for=adresse>Adresse</label>
              <textarea id=adresse name=adresse rows=1 ></textarea>
            </li>-->
            <li>
              <label for=codepostal>Code postal</label>
              <input id=numero_departement_de_residence name=numero_departement_de_residence type=text >
            </li>
              <!--<li>
              <label for=pays>Pays</label>
              <input id=pays name=pays type=text >
            </li>-->
          </ol>
		  <button id=sub_inscr type=submit name=sub_inscr >Valider</button>
        </fieldset>
	 </form>


