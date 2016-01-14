   function compare(element1, element2,faculta) {
        if(typeof faculta === 'undefined'){
	faculta = 5;}
    
        var value_1 = element1.value, 
        value_2 = element2.value,
        value_3 = element1.value.length;

     if (value_1 && value_2) { // Si les deux champs contiennent quelque chose
            if (value_1 === value_2) {
                element1.className = "green";
                element2.className = "green";
            } else {
                element1.className = "red";
                element1.className = "red";
            }
        }
    
   
     if (value_3 < faculta) {
        element1.className= "red";
    }else{
        element1.className="green";
    }
}   



function test(){
    var sub = document.getElementById('submit'),
        email_1 = document.getElementById('email-1'),
        email_2 = document.getElementById('email-2'),
        pseudo = document.getElementById('pseudo'),
        email_ok=0,
        pseudo_ok=0;

var value_1 = email_1.value, 
    value_2 = email_2.value,
    value_3 = pseudo.value.length;

if (value_1 && value_2) { // Si les deux champs contiennent quelque chose
            if (value_1 === value_2) {
               email_ok=1;
            } else {
                email_ok=0;
            }}

 if (value_3 < faculta) {
        pseudo_ok=0;
    }else{
        pseudo_ok=1;
    }
    
if(pseudo_ok===1& email_ok===1){sub.className="afficher";sub.disabled="false";}
else{sub.className="cacher";sub.disabled="true";}
}


        
        
        
  

    