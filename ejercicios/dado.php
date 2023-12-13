<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tirada de dau</title>
</head>
<body>

  <h1>Tirada de dado</h1>

  <!-- Formulario para ingresar el número de tiradas -->
  <form method="get">
    <label for="numerotirod">Cauntas veces quieres tirar el dado?:</label>
    <input type="numero" name="numerotiros" min="1" max="1000" value="100">
    <input type="submit" value="Simular">
  </form>

<?php

//GET (pedir variable)

$numerotiros = $_GET['numerotiros'];

//variables

$uno = 0;
$dos = 0;
$tres = 0;
$cuatro = 0;
$cinco = 0;
$seis = 0;

$contador = array(0,0,0,0,0,0);



for ($i = 0; $i < $numerotiros; $i++){
$resultado = rand(1, 6);

if ($resultado == 1){
	$contador[0]++;
}
elseif ($resultado == 2){
	$contador[1]++;
}

elseif ($resultado == 3){ 
        $contador[2]++;
}
elseif ($resultado == 4){ 
        $contador[3]++;
}
elseif ($resultado == 5){ 
        $contador[4]++;
}
elseif ($resultado == 6){
	$contador[5]++;
}
}


$porcentaje1 = $contador[0]/$numerotiros;
$porcentaje2 = $contador[1]/$numerotiros;
$porcentaje3 = $contador[2]/$numerotiros;
$porcentaje4 = $contador[3]/$numerotiros;
$porcentaje5 = $contador[4]/$numerotiros;
$porcentaje6 = $contador[5]/$numerotiros;




echo "El numero 1 salió $contador[0] veces. <br>";
echo "El numero 2 salió $contador[1] veces. <br>";
echo "El numero 3 salió $contador[2] veces. <br>";
echo "El numero 4 salió $contador[3] veces. <br>";
echo "El numero 5 salió $contador[4] veces. <br>";
echo "El numero 6 salió $contador[5] veces. <br>";


echo "<br>";

echo "El porcentaje de veces del dado 1 fue de $porcentaje1%. <br>";
echo "El porcentaje de veces del dado 2 fue de $porcentaje2%. <br>";
echo "El porcentaje de veces del dado 3 fue de $porcentaje3%. <br>";
echo "El porcentaje de veces del dado 4 fue de $porcentaje4%. <br>";
echo "El porcentaje de veces del dado 5 fue de $porcentaje5%. <br>";
echo "El porcentaje de veces del dado 6 fue de $porcentaje6%. <br>";



?>

</body>
</html>
