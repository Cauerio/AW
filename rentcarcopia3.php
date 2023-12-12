<!DOCTYPE html>
<html>

<head>
    <title>rentcar</title>
    <style>
        .filter-box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        .options-container {
            display: flex;
            flex-wrap: wrap;
        }

        .option {
            margin-right: 10px;
        }

        .highlight {
            background-color: yellow;
            font-weight: bold;
        }
    </style>
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
    ?>

    <h2>Filtros:</h2>
    <form method="post" action="">
        <div class="filter-box">
        <label for="municipi">Municipio:</label>
<select name="municipi">
    <option value="" selected>Seleccionar</option>
    <?php
    // Desplegable para municipios
    $uniqueMunicipios = array_unique((array)$xml->xpath("//row/municipi"));
    sort($uniqueMunicipios); // Ordenar alfabéticamente
    foreach ($uniqueMunicipios as $municipio) {
        echo '<option value="' . $municipio . '">' . $municipio . '</option>';
    }
    ?>
</select>

        </div>

        <div class="filter-box">
            <label>Código Postal:</label>
            <div class="options-container">
                <?php
                // Radiobuttons para códigos postales
                $uniqueCodigosPostales = array();
                foreach ($xml->xpath("//row/adre_a_de_l_establiment") as $direccion) {
                    preg_match('/\b\d{5}\b/', $direccion, $matches);
                    $codigoPostal = isset($matches[0]) ? $matches[0] : '';
                    if (!empty($codigoPostal)) {
                        $uniqueCodigosPostales[] = $codigoPostal;
                    }
                }
                $uniqueCodigosPostales = array_unique($uniqueCodigosPostales);
                sort($uniqueCodigosPostales); // Ordenar de menor a mayor
                foreach ($uniqueCodigosPostales as $codigoPostal) {
                    echo '<label class="option"><input type="checkbox" name="adre_a_de_l_establiment[]" value="' . $codigoPostal . '">' . $codigoPostal . '</label>';
                }
                ?>
            </div>
        </div>

        <div class="filter-box">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" />
        </div>

        <br>
        <input type="submit" value="Filtrar Información">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedMunicipi = isset($_POST['municipi']) ? $_POST['municipi'] : '';
        $selectedCodigosPostales = isset($_POST['adre_a_de_l_establiment']) ? $_POST['adre_a_de_l_establiment'] : array();
        $nombreFilter = isset($_POST['nombre']) ? strtolower($_POST['nombre']) : '';

        if (empty($selectedMunicipi) && empty($selectedCodigosPostales) && empty($nombreFilter)) {
            echo "Por favor, selecciona al menos un municipio, un código postal o ingresa un nombre para filtrar.";
        } else {
            echo "<h2>Información detallada:</h2>";

            foreach ($rows as $row) {
                $nombreEmpresa = strtolower((string)$row->nom_explotador_s);
                $nombreComercio = strtolower((string)$row->denominaci_comercial);
                $codigoPostal = (string)$row->codi_postal; // Extraemos el código postal
            
                if (
                    (!empty($selectedMunicipi) && (string)$row->municipi !== $selectedMunicipi) ||
                    (!empty($selectedCodigosPostales) && !in_array($codigoPostal, $selectedCodigosPostales)) ||
                    (!empty($nombreFilter) && (
                        strpos($nombreEmpresa, $nombreFilter) === false ||
                        strpos($nombreComercio, $nombreFilter) === false ||
                        strpos($row->municipi, $nombreFilter) === false ||
                        strpos($row->adre_a_de_l_establiment, $nombreFilter) === false
                    ))
                ) {
                    continue;
                }
                echo "<ul>";
                echo "<li><strong>Municipio:</strong> " . (string)$row->municipi . "</li>";
                echo "<li><strong>Dirección:</strong> " . (string)$row->adre_a_de_l_establiment . "</li>";
                echo "<li><strong>Signatura:</strong> " . (string)$row->signatura . "</li>";
                echo "<li><strong>Nombre del comercio:</strong> " . highlightFilteredText($nombreComercio, $nombreFilter) . "</li>";
                echo "<li><strong>Cantidad de vehículos disponibles:</strong> " . (string)$row->nombre_de_vehicles . "</li>";
                echo "<li><strong>Nombre de la empresa:</strong> " . highlightFilteredText($nombreEmpresa, $nombreFilter) . "</li>";
                echo "<li><strong>NIF del explotador:</strong> " . (string)$row->nif_cif_explotador_s . "</li>";
                echo "</ul>";
                echo "<hr>"; // Separador visual entre conjuntos de información
            }
        }
    }

    function highlightFilteredText($text, $filter)
    {
        $highlighted = str_replace($filter, '<span class="highlight">' . $filter . '</span>', $text);
        return $highlighted;
    }
    ?>

</body>

</html>









