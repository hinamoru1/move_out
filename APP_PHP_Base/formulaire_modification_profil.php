    <h1 classe="titre">Formulaire de modification de vos informations</h1>
    
    <form class="formulaire" id="formulaire_modification_profil" action ="validation_modification_profil.php" method="post" onSubmit="return verify(this.email,this.conf_email,'mail')">
	
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
	    </li>
            <li>
            <label for=email>Email*</label>
            <input id=email name=email type=email value="<?php echo $mail ;?>" onkeyup="verifMail(this)" required>
          </li>
		  <li>
            <label for=conf_email>Confirmer Email*</label>
            <input id=conf_email name=conf_email value="<?php echo $mail ;?>" type=email onkeyup="compare(email,conf_email)" required>
          </li>
            <li>
            <label for=date_naissance>Date de Naissance*</label>
            <input id=date_naissance name=date_naissance value="<?php echo $date_naissance ;?>" type=date required>
          </li>
            <li>
                <fieldset>
                    <label id='unPeuPlusBas'>Sexe*:</label>
                    <ol>
                        <li>
                            <input id="sexe" name="sexe" value=1 type=radio required <?php if($sexe==1){echo'checked';}?>>
                            <label for=homme>Homme</label>
                        </li>
                        <li>
                            <input id="sexe" name="sexe" value=0 type=radio required <?php if($sexe==0){echo'checked';}?>>
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
                  <li>
                    <label for=ville>Ville*</label>
                    <input id=ville name=ville type=text value="<?php echo $ville ;?>" required>
                  </li>
            <!--<li>
              <label for=adresse>Adresse</label>
              <textarea id=adresse name=adresse rows=1 ></textarea>
            </li>-->
                <li>
	        	<label for="text">departement</label>
	        	<select name="departement" id="departement" required>
	        </li>
                    <?php 
                $reponse1 = $bdd->query('SELECT DISTINCT * FROM departement');
                $increment=1;
                while($donnees1 =$reponse1->fetch())
                        {
                            if ($increment != $dept_residence){
                            echo '<option value='.$donnees1['departement_id'].'>'.$donnees1['departement_code'].' '.$donnees1['departement_nom'].'</option>';
                		$increment++;
                        }
                        else{
                            echo '<option value=' . $donnees1['departement_id'] . ' selected >' . $donnees1['departement_nom'] . '</option>';
                            $increment++;
                        }
                        }  ?>
                
                <li>
       <fieldset>
           
           <input type="checkbox" name="condition_utilisations" id="condition_utilisations" value="1" required><br>
           j'accepte les <a>conditions d'utilisation</a>
           
       </fieldset>
        </li>
                
          </ol>
        
        </fieldset>
                 <button id=sub_inscr type=submit name=sub_inscr >valider</button>
                
               </form>
