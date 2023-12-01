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

    $rows = $xml->xpath('//row');
    $municipio_parametro = isset($_GET["municipio"]) ? $_GET["municipio"] : "";
    $postal = isset($_GET["postal"]) ? $_GET["postal"] : "";
    $nombre = isset($_GET["nombre"]) ? $_GET["nombre"] : "";

    // Utilizar un conjunto para almacenar valores únicos
    $municipios_unicos = array_unique(iterator_to_array($xml->xpath('//row/municipi')));
    ?>

    <form action="rentcarcopia2.php" method="get">
        <label for="seleccionar">Selecciona la información a mostrar:</label><br>
        <input type="radio" name="seleccionar" value="municipio" <?php echo (isset($_GET['seleccionar']) && $_GET['seleccionar'] == 'municipio') ? 'checked' : ''; ?>> Municipio<br>
        <input type="radio" name="seleccionar" value="signatura" <?php echo (isset($_GET['seleccionar']) && $_GET['seleccionar'] == 'signatura') ? 'checked' : ''; ?>> Signatura<br>
        <input type="radio" name="seleccionar" value="denominacio_comercial" <?php echo (isset($_GET['seleccionar']) && $_GET['seleccionar'] == 'denominacio_comercial') ? 'checked' : ''; ?>> Denominación Comercial<br>
        <input type="submit" value="Seleccionar">
    </form>

    <?php if (isset($_GET['seleccionar'])) : ?>
        <form action="rentcarcopia2.php" method="get">
            <label for="municipio">Elige un municipio:</label>
            <select name="municipio" id="municipio">
                <?php foreach ($rows as $row) : ?>
                    <?php
                    $municipio = (string)$row->municipi;
                    $signatura = (string)$row->signatura;
                    $denominacio_comercial = (string)$row->denominaci_comercial;
                    ?>
                    <option value="<?php echo $municipio; ?>" <?php echo ($municipio_parametro == $municipio) ? 'selected' : ''; ?>>
                        <?php
                        switch ($_GET['seleccionar']) {
                            case 'municipio':
                                echo $municipio;
                                break;
                            case 'signatura':
                                echo $signatura;
                                break;
                            case 'denominacio_comercial':
                                echo $denominacio_comercial;
                                break;
                        }
                        ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Enviar">
        </form>
    <?php endif; ?>

</body>

</html>
