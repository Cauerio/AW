<?php


$con = new mysqli('localhost', 'root', '', 'employees');

$emp_no = $_POST['fempno'];

$query = "DELETE * FROM employees WHERE emp_no = ".$emp_no;

echo $query;

   $res = mysqli_query($con, $query);

echo $res;



?>

