<!DOCTYPE html>
<html>
    <!-- 
        Hay que bajarse el archivo xml de 
        
        https://catalegdades.caib.cat/api/views/j2yj-e83g/rows.xml?accessType=DOWNLOAD
        
        y guardarlo en dades/vacacional.xml
    
    -->
    <meta charset="UTF-8">
    <title>Unitats de vacacional</title>
    </head>
    <!-- cos-->

    <body>
        <?php

// cargamos el contenido del archivo

$arxiu = "https://catalegdades.caib.cat/resource/rjfm-vxun.xml";
$pobles = array();


if(!$xml = simplexml_load_file($arxiu)){
    echo "No s'ha pogut carregar l'arxiu";
    die();
    } 
$mis_datos = $xml->row;

// carga los datos en el array
foreach ($mis_datos->row as $dades) {
    $municipi=(string) $dades->municipi;
    $unitats =(int) $dades->unitats;
    if (isset($pobles[$municipi])) {
           $pobles[$municipi] += $unitats;
    } else {
        $pobles[$municipi] = $unitats;
    }
}
ksort($pobles);
?>
        <h1>Unitats de vacacional per poble</h1>
        <table border="1">
            <tr>
                <td>
                    <strong>Municip</strong>
                </td>
                <td><strong>Unitats</strong></td>
            </tr>
            <?php
            foreach ($pobles as $municipi=>$unitats){
                echo "<tr><td>$municipi</td><td>$unitats</td></tr>";
                }
                ?>


        </table>
    </body>

</html>
