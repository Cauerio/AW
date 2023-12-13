<!DOCTYPE html>
<html>

	<head>
		<title> rentcar </title>
	</head>
	<body>




<?php
$url= "https://catalegdades.caib.cat/resource/rjfm-vxun.xml";
$postal= array();
$municipio = array();
if(!$xml=file_get_contents($url)){
	echo "Algo no salió como debería";
	die();
	var_dump($url);
}else {
	$xml = simplexml_load_string($xml);
}

$datos = $xml->rows;


$municipio = isset($_GET["municipio"]) ? $_GET["municipio"] : "";
$postal = isset($_GET["postal"]) ? $_GET["postal"] : "";
$nombre = isset($_GET["nombre"]) ? $_GET["nombre"] : "";

foreach ($datos->row as $dades){


}


?>

	<form action="rentcar.php" method="get">
		<label for="municipio"> Elije un municipio: </label>
		<select name="municipio" id="municipio">
			<option value= <?php echo $datos; ?> >

	</form>
	</body>

</html>
