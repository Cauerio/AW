<?php

	


$con = new mysqli('localhost', 'root', '', 'employees');

$emp_no = $_POST['fempno'];
$surname = $_POST['fsurname'];
$name = $_POST['fname'];

$gender = $_POST['fgender'];

$birth_date = $_POST['fbirthdate'];
$hire_date = $_POST['fhiredate'];



	
	
$query = "UPDATE employees SET first_name = '".$name."', last_name = '".$surname."', birth_date = '".$birth_date."', hire_date = '".$hire_date."'
, gender = '".$gender."' WHERE emp_no = ".$emp_no;

echo $query;

   $res = mysqli_query($con, $query);
 
echo $res;



?>
