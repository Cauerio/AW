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

function fupdate(emp){
	
a = 'update.php?empleado='+emp;

parent.document.getElementById('update').src = a;
	
	
	
}

function fdelete(emp){

document.getElementById('emp_id').value = emp;
document.getElementById('deleteForm').submit();


parent.document.getElementById('list').src = 'list_delete.php';


}


function forder(n,d){




document.getElementById(\"campo_orderid\").value = n;
document.getElementById(\"dir_orderid\").value = d;

document.getElementById(\"submitForm\").submit();






}
</script>
"
);


$con = new mysqli('localhost', 'root', '', 'employees');


if($_SERVER['REQUEST_METHOD'] == "POST"){

$post = 'y';	

if( isset($_POST['campo_order']) && !empty($_POST['campo_order'])){

$order_n = $_POST['campo_order'];
$order_s = $_POST['dir_order'];

}
else{

$order_n = 0;
}


if( isset($_POST['fsurname']) && !empty($_POST['fsurname']))
{$surname = $_POST['fsurname'];}
else{
$surname = "";
}


if( isset($_POST['fname']) && !empty($_POST['fname']))
{$name = $_POST['fname'];}
else{
$name = "";
}

if( isset($_POST['emp_no']) && !empty($_POST['emp_no']))
{$emp_no = $_POST['emp_no'];}
else{
$emp_no = "";
}


}else{

$post = 'n';
$name = "";	
$surname = "";
$order_select = "ORDER BY emp_no DESC";
}


print(
"
<form action \"?\" method=\"post\" id=\"submitForm\">
<label for=\"fname\">Nombre</label>

<input type=text name = \"fname\" value = \"".$name."\">
<label for=\"fsurname\">Apellido</label>
<input type=text name = \"fsurname\" value = \"".$surname."\">

<input type=hidden name = \"campo_order\" id = \"campo_orderid\">
<input type=hidden name = \"dir_order\" id = \"dir_orderid\">
<input type=\"submit\">
</form>


<form action \"?\" method=\"post\" id=\"submitForm\">
<label for=\"emp_no\">Borrar</label>

<input type=hidden name = \"emp_no\" id = \"emp_no\">

<input type=\"submit\">
</form>
"
);

print("<table border=1>
<tr><td>Número de Empleado</td>
<td>Nombre

<a href=\"javascript:forder('name','u')\">&uarr;</a>
<a href=\"javascript:forder('name','d')\">&darr;</a>


</td>


<td>
Apellido 

<a href=\"javascript:forder('surname','u')\">&uarr;</a>
<a href=\"javascript:forder('surname','d')\">&darr;</a>

</td>
<td>Salario</td>
<td>Actualizar</td>
<td>Borrar</td>
</tr>

");

$limit = "";

if($post == 'n'){

$where = "";

$limit = " LIMIT 200";

}else{
	
	
if($name == "" && $surname == ""){
	
	$where = "";
	$limit = " LIMIT 200";

}elseif($name == ""){   

$where = "WHERE last_name = '".$surname."'" ;

}elseif($surname == ""){
	
$where = "WHERE first_name = '".$name."'" ;
	
	

	
}else{
	
$where = "WHERE first_name ='".$name."' AND last_name = '".$surname."'" ;	
	
}



if($order_n == 0){ 

$order_select = "";

}else{

if($order_n == 'name'){
	
	

if($order_s == 'u'){

$order_select = "ORDER BY first_name ASC";	
}else{
	
$order_select = "ORDER BY first_name DESC";	

	
}


}

if($order_n == 'surname'){
	
	

if($order_s == 'u'){

$order_select = "ORDER BY last_name ASC";	
}else{
	
$order_select = "ORDER BY last_name DESC";	

	
}


}



}




}

$where2 = " AND s.to_date = '9999-01-01'";

$query = "SELECT e.emp_no, first_name, last_name, salary FROM employees e LEFT JOIN salaries s ON s.emp_no = e.emp_no ".$where." ".$where2." ".$order_select." ".$limit;

$sum_salarios = 0;
$cuenta = 0;

$link_update = "";

   $res = mysqli_query($con, $query, MYSQLI_USE_RESULT);
   if ($res) {
      while ($row = mysqli_fetch_row($res)) {
         print("<tr>");
	 print("<td>".$row[0]."</td>");
         print("<td>".$row[1]."</td>");
		 print("<td>".$row[2]."</td>");
		 if($row[3]>0){
		 print("<td align=\"right\">".number_format($row[3],2,',','.')."</td>");
		 }else{print("<td align=\"right\"></td>");}
		 print("<td align=\"center\"><a href=\"javascript:fupdate(".$row[0].")\">X</a></td>");
                 print("<td align=\"center\"><a href=\"javascript:fdelete(".$row[0].")\">X</a></td>");
	 print("</tr>");
	 $cuenta++;
	 $sum_salarios = $sum_salarios + $row[3];

}
   }

print("<tr><td>Total Empleados</td><td colspan=\"2\"></td><td align=\"right\">".$cuenta."</td></tr>");
print("<tr><td>Total Salarios</td><td colspan=\"2\"></td><td align=\"right\">".number_format($sum_salarios,'2',',','.')."</td></tr>");


print("</table>");

?>
