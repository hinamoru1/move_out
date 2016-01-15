                    function compare(element1, element2,faculta) {
                                if(typeof faculta === 'undefined'){
                            	faculta = 5;}
    
                                var value_1 = element1.value, 
                                value_2 = element2.value,
                                value_3 = element1.value.length;
                                
                                if (value_1 && value_2) { // Si les deux champs contiennent quelque chose

                                if (value_1 === value_2) {
                                element1.style.backgroundColor = "#cfa"; // on met une couleur de fond verte
                                element2.style.backgroundColor = "#cfa";
                                } else {
                                element1.style.backgroundColor = "#fba";// couleur de fond rouge
                                element2.style.backgroundColor = "#fba";
                                }
                                }
				if (value_3 < faculta) {
                                element1.style.backgroundColor = "#fba";
                                }else{
                                element1.style.backgroundColor = "#cfa";
                                }
                                }
                        
                        
                    /*    function verifDateNaissance(element){
                            var now=new Date();
                            var annee=now.getyear();
                            
                            if ((Number((annee.getTime() - now.getTime()) / 31536000000).toFixed(0))<0 && Number(((annee.getTime() - now.getTime()) / 31536000000).toFixed(0))>-150){
                                
                            }
                            else{
                                
                                alert((Number((annee.getTime() - now.getTime()) / 31536000000).toFixed(0)));
                            }
                        }*/
                        
                        function surligne(champ, erreur)
				{
				if(erreur)
					champ.style.backgroundColor = "#fba";
				else
					champ.style.backgroundColor = "";
				}
				
			function verifPseudo(champ)
				{
				if(champ.value.length < 6 || champ.value.length > 25)
				{
					surligne(champ, true);
					return false;
				}
				else
				{
					surligne(champ, false);
					return true;
				}
				}
				
			function verifMail(champ)
				{
				var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
				if(!regex.test(champ.value))
				{
					surligne(champ, true);
					return false;
				}
				else
				{
					surligne(champ, false);
					return true;
				}
				}
				
			function verifAge(champ)
				{
				var age = parseInt(champ.value);
				if(isNaN(age) || age < 5 || age > 111)
				{
					surligne(champ, true);
					return false;
				}
				else
				{
					surligne(champ, false);
					return true;
				}
				}
				
			function verifForm(f)
				{
				var pseudoOk = verifPseudo(f.pseudo);
				var mailOk = verifMail(f.email);
				var ageOk = verifAge(f.age);
				
				if(pseudoOk && mailOk && ageOk)
					return true;
				else
				{
					alert("Veuillez remplir correctement tous les champs");
					return false;
				}
				}
				



/*<form action="page.php" onsubmit="return verifForm(this)">
  <p>
    Pseudo : <input type="text" name="pseudo" onblur="verifPseudo(this)" /><br />
    E-mail : <input type="text" name="email" size="30" onblur="verifMail(this)" /><br />
    Âge : <input type="text" name="age" size="2" onblur="verifAge(this)" /> ans<br />
    <input type="submit" value="Valider" />
  </p>
</form>

</body>*/