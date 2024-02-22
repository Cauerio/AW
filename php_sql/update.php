<?php

	
print(
"
<iframe name=\"dummyframe\" id=\"dummyframe\" style=\"display: none;\"></iframe>



<script>


function wait(ms){
   var start = new Date().getTime();
   var end = start;
   while(end < start + ms) {
     end = new Date().getTime();
  }
}


function fsubmit(emp){
	
document.getElementById(\"submitForm\").submit();



wait(2000);

parent.document.getElementById('list').src = 'list.php'
	
	
	
}


</script>
"
);


$con = new mysqli('localhost', 'root', '', 'employees');

$gender = 'F';
$name = "";
$surname = "";
$birthdate = "";
$hiredate = "";


if($_SERVER['REQUEST_METHOD'] == "GET"){

if( isset($_GET['empleado']) && !empty($_GET['empleado'])){


$empleado = $_GET['empleado'];
}else{
	
$empleado = 0;	
	
}
}else{

$empleado = 0;

}
$query = "SELECT first_name, last_name, birth_date, hire_date, gender FROM employees WHERE emp_no = ".$empleado;

   $res = mysqli_query($con, $query, MYSQLI_USE_RESULT);
   if ($res) {
      while ($row = mysqli_fetch_row($res)) {
       
		$name = $row[0];
		$surname = $row[1];
		$birthdate = $row[2];
		$hiredate = $row[3];
		$gender = $row[4];
		
	

		 
	
      }
   }

if($gender == 'M'){
	
$gender_m = "selected";
$gender_f = "";	
	
}else{
	
$gender_m = "";
$gender_f = "selected";		
	
	
}

// target=\"_blank\"
// target=\"dummyframe\"


print(
"
<form action=\"update_backend.php\" method=\"post\" id=\"submitForm\" target=\"dummyframe\">
<input type=hidden name = \"fempno\" value = \"".$empleado."\"><p>
<label for=\"fname\">Nombre</label>

<input type=text name = \"fname\" value = \"".$name."\"><p>
<label for=\"fsurname\">Apellido</label>

<input type=text name = \"fsurname\" value = \"".$surname."\"><p>
<label for=\"fbirthdate\">Fecha de Nacimiento</label>
<input type=date name = \"fbirthdate\" value = \"".$birthdate."\"><p>
<label for=\"fgender\">Género</label>



<select name=\"fgender\">

  <option value=\"F\" ".$gender_f.">Mujer</option>
  <option value=\"M\" ".$gender_m.">Hombre</option>

</select><p>


<label for=\"fhiredate\">Fecha de Contratación</label>
<input type=date name = \"fhiredate\" value = \"".$hiredate."\"><p>


</form>
<button onclick=\"fsubmit(".$empleado.")\">Actualizar</button>
"
);





?>
