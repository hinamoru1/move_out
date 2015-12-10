



<div class="titre">
    <h1>Formulaire de modification de vos informations</h1>
	</div>
    <form id=inscription action ="validation_modification_profil.php" method="post">
	
      <fieldset>
        <legend>Votre identité</legend>
        <ol>
          <li>
            <label for=nom>Nom</label>
            <input id=nom name=nom type=text value="<?php echo $nom ;?>" autofocus>
          </li>
		   <li>
            <label for=prenom>Prénom</label>
            <input id=prenom_utilisateur name=prenom_utilisateur type=text value="<?php echo $prenom ;?>">
		  <li>
            <label for=email>Email*</label>
            <input id=email name=email type=email value="<?php echo $mail ;?>" required>
          </li>
		  <li>
            <label for=conf_email>Confirmer Email*</label>
            <input id=conf_email name=conf_email value="<?php echo $mail ;?>" type=email required>
          </li>
          <!--<li>
            <label for=telephone>Téléphone</label>
            <input id=telephone name=telephone type=tel placeholder="par ex&nbsp;: +3375500000000" >
          </li>-->
		   <li>
            <label for=date_naissance>Date de Naissance*</label>
            <input id=date_naissance name=date_naissance value="<?php echo $date_naissance ;?>" type=date required>
          </li>
	<li>
                <fieldset>
                    <label id='unPeuPlusBas'>Sexe*:</label>
                    <ol>
                        <li>
                            <input id=sexe name=sexe value=1 type=radio required <?php if($sexe==1){echo'checked';}?>>
                            <label for=homme>Homme</label>
                        </li>
                        <li>
                            <input id=sexe name=sexe value=0 type=radio required <?php if($sexe==0){echo'checked';}?>>
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
                            <input id=accepte_newsletter name="accepte_newsletter" value="1" type=radio <?php if($newsletter==1){echo'checked';}?>>
                            <label for=homme>Oui</label>
                        </li>
                        <li>
                            <input id=accepte_newsletter name="accepte_newsletter" value="0" type=radio <?php if($newsletter==0){echo'checked';}?>>
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
            <input id=pseudo name=pseudo type=tel value="<?php echo $pseudo ;?>" required>
          </li>
	  </fieldset>
      <fieldset>
        <legend>Adresse</legend>
          <ol>
            <!--<li>
              <label for=adresse>Adresse</label>
              <textarea id=adresse name=adresse rows=1 ></textarea>
            </li>-->
            <li>
              <label for=codepostal>Code postal</label>
              <input id=numero_departement_de_residence value="<?php echo $dept_residence ;?>" name=numero_departement_de_residence type=text >
            </li>
              <!--<li>
              <label for=pays>Pays</label>
              <input id=pays name=pays type=text >
            </li>-->
          </ol>
		  <button id=sub_inscr type=submit name=sub_inscr >Valider</button>
        </fieldset>
	 </form>
