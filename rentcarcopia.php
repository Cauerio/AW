<!DOCTYPE html>
<html>

<head>
    <title>rentcar</title>
</head>

<body>

    <?php
    $url = "https://catalegdades.caib.cat/resource/rjfm-vxun.xml";

    if (!$xml = file_get_contents($url)) {
        echo "Algo no salió como debería";
        die();
    } else {
        $xml = simplexml_load_string($xml);
    }

    $datos = $xml->xpath('//row/municipi');
    $municipio_parametro = isset($_GET["municipio"]) ? $_GET["municipio"] : "";
    $postal = isset($_GET["postal"]) ? $_GET["postal"] : "";
    $nombre = isset($_GET["nombre"]) ? $_GET["nombre"] : "";

    // Utilizar un conjunto para almacenar valores únicos
    $municipios_unicos = array_unique(iterator_to_array($datos));
    ?>

    <form action="rentcar.php" method="get">
        <label for="municipio">Elige un municipio:</label>
        <select name="municipio" id="municipio">
            <?php foreach ($municipios_unicos as $municipio) : ?>
                <?php
                $municipio = (string)$municipio;
                ?>
                <option value="<?php echo $municipio; ?>" <?php echo ($municipio_parametro == $municipio) ? 'selected' : ''; ?>>
                    <?php echo $municipio; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Enviar">
    </form>
</body>

</html>
