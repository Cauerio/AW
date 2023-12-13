<!DOCTYPE html>

<html>
<body>
<form action="pooost.php9" method="post">
    Nom: <input type="text" name="nom"><br>
    Email: <input type="text" name="email"><br>
    <input type="submit" value="Enviar">
</form>
Hola <?php isset($_POST["nom"]) ? print $_POST["nom"] : ""; ?><br>
Email: <?php isset($_POST["email"]) ? print $_POST["email"] : ""; ?>
</body>
</html>
