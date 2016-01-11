
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
            <input id="email" name="email" type=email placeholder="exemple@domaine.com" required>
          </li>
		  <li>
            <label for=conf_email>Confirmer Email*</label>
            <input id="conf_email" name="conf_email" type=email required>
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
                        <input id="mot_de_passe" name="mot_de_passe" type=password required>
                    </li>
                    <li>
                        <label for="mdp2">Confirmer le mdp*</label>
                        <input id="mot_de_passe_conf" name="mot_de_passe_conf" type=password required>
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
                <!--label for="numero_departement_de_residence">département</label>
                <select name="numero_departement_de_residence" id="numero_departement_de_residence">
                    <option value="01">01 Ain</option>
                    <option value="02">02 Aisne</option>
                    <option value="03">03 Allier</option>
                    <option value="04">04 Alpes de Haute Provence</option>
                    <option value="05">05 Hautes Alpes</option>
                    <option value="06">06 Alpes Maritimes</option>
                    <option value="07">07 Ardèche</option>
                    <option value="08">08 Ardennes</option>
                    <option value="09">09 Ariège</option>
                    <option value="10">10 Aube</option>
                    <option value="11">11 Aude</option>
                    <option value="12">12 Aveyron</option>
                    <option value="13">13 Bouches du Rhône</option>
                    <option value="14">14 Calvados</option>
                    <option value="15">15 Cantal</option>
                    <option value="16">16 Charente</option>
                    <option value="17">17 Charente Maritime</option>
                    <option value="18">18 Cher</option>
                    <option value="19">19 Corrèze</option>
                    <option value="20">20 Corse</option>
                    <option value="21">21 Côte d'Or</option>
                    <option value="22">22 Côtes d'Armor</option>
                    <option value="23">23 Creuse</option>
                    <option value="24">24 Dordogne</option>
                    <option value="25">25 Doubs</option>
                    <option value="26">26 Drôme</option>
                    <option value="27">27 Eure</option>
                    <option value="28">28 Eure et Loir</option>
                    <option value="29">29 Finistère</option>
                    <option value="30">30 Gard</option>
                    <option value="31">31 Haute Garonne</option>
                    <option value="32">32 Gers</option>
                    <option value="33">33 Gironde</option>
                    <option value="34">34 Hérault</option>
                    <option value="35">35 Ille et Vilaine</option>
                    <option value="36">36 Indre</option>
                    <option value="37">37 Indre et Loire</option>
                    <option value="38">38 Isère</option>
                    <option value="39">39 Jura</option>
                    <option value="40">40 Landes</option>
                    <option value="41">41 Loir et Cher</option>
                    <option value="42">42 Loire</option>
                    <option value="43">43 Haute Loire</option>
                    <option value="44">44 Loire Atlantique</option>
                    <option value="45">45 Loiret</option>
                    <option value="46">46 Lot</option>
                    <option value="47">47 Lot et Garonne</option>
                    <option value="48">48 Lozère</option>
                    <option value="49">49 Maine et Loire</option>
                    <option value="50">50 Manche</option>
                    <option value="51">51 Marne</option>
                    <option value="52">52 Haute Marne</option>
                    <option value="53">53 Mayenne</option>
                    <option value="54">54 Meurthe et Moselle</option>
                    <option value="55">55 Meuse</option>
                    <option value="56">56 Morbihan</option>
                    <option value="57">57 Moselle</option>
                    <option value="58">58 Nièvre</option>
                    <option value="59">59 Nord</option>
                    <option value="60">60 Oise</option>
                    <option value="61">61 Orne</option>
                    <option value="62">62 Pas de Calais</option>
                    <option value="63">63 Puy de Dôme</option>
                    <option value="64">64 Pyrénées Atlantiques</option>
                    <option value="65">65 Hautes Pyrénées</option>
                    <option value="66">66 Pyrénées Orientales</option>
                    <option value="67">67 Bas Rhin</option>
                    <option value="68">68 Haut Rhin</option>
                    <option value="69">69 Rhône</option>
                    <option value="70">70 Haute Saône</option>
                    <option value="71">71 Saône et Loire</option>
                    <option value="72">72 Sarthe</option>
                    <option value="73">73 Savoie</option>
                    <option value="74">74 Haute Savoie</option>
                    <option value="75">75 Paris</option>
                    <option value="76">76 Seine Maritime</option>
                    <option value="77">77 Seine et Marne</option>
                    <option value="78">78 Yvelines</option>
                    <option value="79">79 Deux Sèvres</option>
                    <option value="80">80 Somme</option>
                    <option value="81">81 Tarn</option>
                    <option value="82">82 Tarn et Garonne</option>
                    <option value="83">83 Var</option>
                    <option value="84">84 Vaucluse</option>
                    <option value="85">85 Vendée</option>
                    <option value="86">86 Vienne</option>
                    <option value="87">87 Haute Vienne</option>
                    <option value="88">88 Vosges</option>
                    <option value="89">89 Yonne</option>
                    <option value="90">90 Territoire de Belfort</option>
                    <option value="91">91 Essonne</option>
                    <option value="92">92 Hauts de Seine</option>
                    <option value="93">93 Seine Saint Denis</option>
                    <option value="94">94 Val de Marne</option>
                    <option value="95">95 Val d'Oise</option>
                    <option value="971">971 Guadeloupe</option>
                    <option value="972">972 Martinique</option>
                    <option value="973">973 Guyane</option>
                    <option value="974">974 Réunion</option>
                    <option value="975">975 Saint Pierre et Miquelon</option>
                    <option value="976">976 Mayotte</option>
                </select-->
              <!--<li>
              <label for=pays>Pays</label>
              <input id=pays name=pays type=text >
            </li>-->
          
        <li>
       <fieldset>
           
           <input type="checkbox" name="condition_utilisations" id="condition_utilisations" value="1"><br>
           j'accepte les <a>conditions d'utilisation</a>
           
       </fieldset>
        </li>
        </ol>
        <button id=sub_inscr type=submit name=sub_inscr >connexion</button>
        
        
        </fieldset>
	 </form>


