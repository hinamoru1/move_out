<script type="text/javascript">

// fonction qui permet de verifier que deux element contiennent la meme choses
function verify(element1, element2,faculta){   // La fonction reçois en paramètre les 3 éléments dont un facultatif
        if(typeof faculta === 'undefined'){
		faculta = 'information'}
        
        
        var confirmation=false; //on dit que de base ca va nous retourner false


        //on verifie que le premiere element n'est pas vide
        if (element1.value==''){
                alert("Veuillez entrer votre "+faculta+" dans le premier champ!");
                element1.focus();    //focus sur le champ
        }

        // on fait la meme chose pour le deuxieme element
        else if (element2.value==''){
                alert("Veuillez confirmer votre "+faculta+" dans le second champ!");
                element2.focus();
        }

        else if (element1.value!=element2.value){       // on verifie si les deux champs sont identique
                alert("Les deux "+faculta+" ne condordent pas");
                element1.select();
        }

        else
                confirmation=true;
        return confirmation;
 }
// fin du script -->
</script>


        
        
</head>
<body>

<form name="form" onSubmit="return verify(this.pass,this.pass2,'mdp')">
<!-- Sur l'événement onsSubmit on envoie la valeur des 2 champs à la fonction -->
Entrez votre mot de passe : <input type="text" name="pass">
Confirmez le mot de passe :<input type="password" name="pass2">
<input type="submit" value="submit">
</form>

</body>
</html>