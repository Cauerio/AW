<?php

	



print(
"
<script>

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

if( isset($_POST['salary']) && !empty($_POST['salary']))
{$salary = $_POST['salary'];}
else{
$salary = "";
}

}else{

$post = 'n';
$name = "";
$surname = "";
$emp_no = "";
$salary = "";
$order_select = "";
}


print(
"
<form action \"?\" method=\"post\" id=\"submitForm\">
<label for=\"fname\">Nombre</label>

<input type=text name = \"fname\" value = \"".$name."\">
<label for=\"fsurname\">Apellido</label>
<input type=text name = \"fsurname\" value = \"".$surname."\">

<label for=\"emp_no\">Numero de empleados</label>
<input type=text name = \"emp_no\" value = \"".$emp_no."\">

<label for=\"salary\">Insertar salario</label>
<input type=text name = \"salary\" value = \"".$salary."\"> 

<input type=hidden name = \"campo_order\" id = \"campo_orderid\">
<input type=hidden name = \"dir_order\" id = \"dir_orderid\">
<input type=\"submit\">
</form>
"
);


print("<table border=1>
<tr><td>Nombre

<a href=\"javascript:forder('name','u')\">&uarr;</a>
<a href=\"javascript:forder('name','d')\">&darr;</a>


</td>


<td>
Apellido

<a href=\"javascript:forder('surname','u')\">&uarr;</a>
<a href=\"javascript:forder('surname','d')\">&darr;</a>

</td>
<td>
Numero_empleados

<a href=\"javascript:forder('emp_no','u')\">&uarr;</a>
<a href=\"javascript:forder('emp_no','d')\">&darr;</a>

</td>
<td>
Salario

<a href=\"javascript:forder('salary','u')\">&uarr;</a>
<a href=\"javascript:forder('salary','d')\">&darr;</a>

</td>

</tr>



");

$limit = "";

if($post == 'n'){

$where = "";

$limit = " LIMIT 10";

}else{


if($name == "" && $surname == "" && $emp_no == ""){

	$where = "";
	$limit = " LIMIT 10";

}elseif($name == "" && $surname == ""){
$where = "WHERE emp_no = '".$emp_no."'";

}elseif($name == "" && $emp_no == ""){
$where = "WHERE last_name = '".$surname."'";

}elseif($surname == "" && $emp_no == "" ){
$where = "WHERE last_name = '".$surname."'";


}elseif($name == ""){

$where = "WHERE last_name = '".$surname."' and emp_no = '".$emp_no."'" ;

}elseif($surname == ""){
$where = "WHERE first_name = '".$name."' and emp_no = '".$emp_no."'" ;

}elseif($emp_no == ""){
$where = "WHERE first_name = '".$name."' and last_name = '".$surname."'";


}else{

$where = "WHERE first_name ='".$name."' AND last_name = '".$surname."' AND emp_no = '".$emp_no."'" ;

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


if($order_n == 'emp_no'){

if($order_s == 'u'){
$order_select = "ORDER BY emp_no ASC";

}else{
$order_select = "ORDER BY emp_no DESC";
}


}


}


}



}




}

$query = "SELECT e.first_name, e.last_name, e.emp_no, s.salary FROM employees e JOIN salaries s ON e.emp_no=s.emp_no ".$where." ".$order_select." ".$limit;
$query2 = "Insert salaries (salary) values(".$salary.")";
echo $query2;
echo $query;

   $res = mysqli_query($con, $query, MYSQLI_USE_RESULT);
   if ($res) {
      while ($row = mysqli_fetch_row($res)) {
         print("<tr>");
	 print("<td>".$row[0]."</td>");
         print("<td>".$row[1]."</td>");
	 print("<td>".$row[2]."</td>");
	 print("<td>".$row[3]."</td>");
	 print("</tr>");
      }
   }


print("</table>");

?>
