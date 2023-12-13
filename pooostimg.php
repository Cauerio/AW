<!DOCTYPE html>

<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {}
    // Verifica si el archivo se cargó correctamente
    if (isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] == UPLOAD_ERR_OK) {
        $nombre_archivo = $_FILES["archivo"]["name"];
        $ruta_destino = "/opt/lampp/htdocs" . $nombre_archivo; // Puedes cambiar esto según tus necesidades

        // Mueve el archivo cargado al destino especificado
        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $ruta_destino)) {
            echo "El archivo se ha cargado correctamente en: " . $ruta_destino;
        } else {
            echo "Error al mover el archivo a la carpeta de destino.";
        }
    } else {
        echo "Error al cargar el archivo.";}

 ?>

<form method="post" action="/pooostimg2.php" enctype="multipart/form-data">
  <div>
    <label for="file">Selecciona un raxiu</label>
    <input type="file" id="file" name="myFile">
  </div>
  <div>
    <input type="submit" value="Enviar">
  </div>
</form>


