<?php


print(
"

<script>


function wait(ms){
   var start = new Date().getTime();
   var end = start;
   while(end < start + ms) {
     end = new Date().getTime();
  }
}


function fsubmit(){
	
document.getElementById(\"submitForm\").submit();



wait(4000);

parent.document.getElementById('list').src = 'list.php'
	
	
	
}


</script>

<iframe name=\"dummyframe\" id=\"dummyframe\" style=\"display: none;\"></iframe>

<form action=\"insert_backend.php\" method=\"post\" id=\"submitForm\" target=\"dummyframe\">
<label for=\"fname\">Nombre</label>

<input type=text name = \"fname\"><p>
<label for=\"fsurname\">Apellido</label>
<input type=text name = \"fsurname\"><p>
<label for=\"fbirthdate\">Fecha Nacimiento</label>

<input type=date name = \"fbirthdate\"><p>
<label for=\"fgender\">Género</label>

<select name= \"fgender\" id=\"gender\">
  <option selected value=\"\" disabled=\"disabled\">Elegir género</option>
  <option value=\"M\">Masculino</option>
  <option value=\"F\">Femenino</option>
  
</select><p>



<label for=\"fhiredate\">Contratación</label>
<input type=date name = \"fhiredate\"><p>


</form>
<button onclick=\"fsubmit()\">Guardar</button>
"
);





?>
