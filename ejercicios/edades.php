<?php

$edad = $_GET['edad'];

if ($edad >= 0 && $edad <= 3){
	echo "eres un infantil";
}

elseif ($edad >= 4 && $edad <= 17){
	echo "eres un niño";
}

elseif ($edad >= 18 && $edad <= 64){

	echo "eres un adulto";
}

else {
	echo "eres un señor";
}
?>
