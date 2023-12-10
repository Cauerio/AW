<!DOCTYPE html>
<html>

<head>
    <title>rentcar</title>
    <style>
        body {
            font-family: sans-serif;

        }
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
            <label for="filterByMunicipi">
                <input type="checkbox" name="filterOption" value="municipi" id="filterByMunicipi" onclick="toggleMunicipiDropdown()"> Filtrar por Municipio
            </label>
            <div id="municipiDropdown" style="display: none;">
                <?php
                // Desplegable para municipios
                $uniqueMunicipios = array_unique((array)$xml->xpath("//row/municipi"));
                sort($uniqueMunicipios); // Ordenar alfabéticamente
                echo '<select name="municipi">';
                foreach ($uniqueMunicipios as $municipio) {
                    echo '<option value="' . $municipio . '">' . $municipio . '</option>';
                }
                echo '</select>';
                ?>
            </div>
        </div>

        <div class="filter-box">
            <label for="filterByCodigosPostales">
                <input type="checkbox" name="filterOption" value="adre_a_de_l_establiment" id="filterByCodigosPostales" onclick="toggleCodigosPostalesCheckboxes()"> Filtrar por Código Postal
            </label>
            <div id="codigosPostalesCheckboxes" style="display: none;">
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
            <label for="filterByNombre">
                <input type="checkbox" name="filterOption" value="nombre" id="filterByNombre"> Filtrar por Nombre
            </label>
            <input type="text" name="nombre" />
        </div>

        <br>
        <input type="submit" value="Filtrar Información">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $filterOption = isset($_POST['filterOption']) ? $_POST['filterOption'] : '';
        $selectedMunicipi = isset($_POST['municipi']) ? $_POST['municipi'] : '';
        $selectedCodigosPostales = isset($_POST['adre_a_de_l_establiment']) ? $_POST['adre_a_de_l_establiment'] : array();
        $nombreFilter = isset($_POST['nombre']) ? strtolower($_POST['nombre']) : '';

        if (empty($filterOption)) {
            echo "Por favor, selecciona una opción de filtro.";
        } elseif ($filterOption === 'municipi' && empty($selectedMunicipi)) {
            echo "Por favor, selecciona al menos un municipio para el filtro.";
        } elseif ($filterOption === 'adre_a_de_l_establiment' && empty($selectedCodigosPostales)) {
            echo "Por favor, selecciona al menos un código postal para el filtro.";
        } elseif ($filterOption === 'nombre' && empty($nombreFilter)) {
            echo "Por favor, ingresa un nombre para el filtro.";
        } else {
            echo "<h2>Información detallada:</h2>";

            foreach ($rows as $row) {
                $nombreEmpresa = strtolower((string)$row->nom_explotador_s);
                $nombreComercio = strtolower((string)$row->denominaci_comercial);

                if (
                    ($filterOption === 'municipi' && (string)$row->municipi !== $selectedMunicipi) ||
                    ($filterOption === 'adre_a_de_l_establiment' && !in_array((string)$row->adre_a_de_l_establiment, $selectedCodigosPostales)) ||
                    ($filterOption === 'nombre' && (
                        strpos($nombreEmpresa, $nombreFilter) === false &&
                        strpos($nombreComercio, $nombreFilter) === false &&
                        strpos($row->municipi, $nombreFilter) === false &&
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
                echo "<hr>";
            }
        }
    }

    function highlightFilteredText($text, $filter)
    {
        if ($filter) {
            $text = preg_replace("/\b($filter)\b/i", '<span class="highlight">$1</span>', $text);
        }
        return $text;
    }
    ?>

    <script>
        function toggleMunicipiDropdown() {
            var municipiDropdown = document.getElementById('municipiDropdown');
            municipiDropdown.style.display = document.getElementById('filterByMunicipi').checked ? 'block' : 'none';
        }

        function toggleCodigosPostalesCheckboxes() {
            var codigosPostalesCheckboxes = document.getElementById('codigosPostalesCheckboxes');
            codigosPostalesCheckboxes.style.display = document.getElementById('filterByCodigosPostales').checked ? 'block' : 'none';
        }
    </script>
</body>

</html>

