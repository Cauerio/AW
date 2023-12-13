<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vocales</title>
</head>
<body>

<h1>Contador de vocales</h1>

    <!-- Formulario para ingresar el número de tiradas -->
  <form method="get">
    <label for="numerotirod">Pon una frase:</label>
    <input type="text" name="frase">
    <input type="submit" value="Simular">
  </form>



<?php

function contar_vocales($cadena){
$frase = $_GET['frase'];

$vocales= ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'];

$contador = 0;


    for ($i = 0; $i < strlen($cadena); $i++) {
        if (in_array($cadena[$i], $vocales)) {
            $contador++;
        }
    }

return $contador;

echo "La frase tiene $contador vocales.";

}



?>
