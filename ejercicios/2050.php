<?php
$fecha_actual = new DateTime();
$fecha_objetivo = new DateTime('2050-01-01');
$diferencia = $fecha_actual->diff($fecha_objetivo);
echo "Días faltantes para el año 2050: " . $diferencia->days;
?>
