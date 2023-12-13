<?php
$nom = $_GET ['nom'];
$edat = $_GET ['edat'];
$ara =  date("Y");
$edadcalc = 2050 - $ara + $edat;
echo "En 2050 $nom tendrá $edadcalc años";
?>
