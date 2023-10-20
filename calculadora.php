<?php
        $op1 =  $_GET ['op1'];
        $op2 =  $_GET ['op2'];
        $operador = $_GET ['operador'];

if (!is_numeric($op1) || !is_numeric($op2)) {
    $op1 = "cambia el op1 a un número";
    $op2 = "cambia el op2 a un número";}
  else {
        switch ($operador) {
            case 'suma':
                $resultado = $op1 + $op2;
                break;
            case 'resta':
                $resultado = $op1 - $op2;
                break;
            case 'multiplicacion':
                $resultado = $op1 * $op2;
                break;
            case 'division':
                if ($op2 != 0) {
                    $resultado = $op1 / $op2;
                } else {
                    $resultado = "Error: División por cero";
                }}}
               
	  
        echo "Resultado de $op1 $operador $op2 es igual a: $resultado";
    ?>



