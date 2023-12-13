<!DOCTYPE html>

<html>
<body>

<form action="geeet.php" method='get'>
	Nom: <input type="text" name="nom"><br>
	 Email: <input type="text" name="email"><br>
    <input type="submit" value="Enviar">
</form>
Hola <?php isset($_GET["nom"]) ? print $_GET["nom"] : ""; ?><br>
El teu e-mail és: <?php isset($_GET["email"]) ? print $_GET["email"] : ""; ?>
</body>

</body>


</html>
