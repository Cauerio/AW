<?php

$i=0;
$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
echo $meses [9]."\n";
echo '<br>';
echo "Tamaño de la array: ".count($meses);
echo '<br>';
for ($i=0; $i<count($meses); ++$i){
	echo "$i)\t{$meses[$i]} <br>";
}



?>
