<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inmuebles</title>
    <link reel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Inmuebles</h2>

    <form action="guardar_inmueble.php" method="post">

        <label>Nombre del inmueble</label>
        <input type="text" name="nombre_inmueble">

        <input type="submit" value="Guardar inmueble">

    </form>

    <form action="consultar_inmueble.php" method="post">
        <input type="submit" value="Consultar inmueble">
    </form>
    

</body>
</html>