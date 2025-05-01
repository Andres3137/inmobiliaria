<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inmuebles</title>
    
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
   

    <form action="guardar_inmueble.php" method="post">
    <h2>Registro Tipo De Inmueble</h2>
        <label>Nombre del inmueble</label>
        <input type="text" name="nombre_inmueble">

        <input type="submit" value="Guardar inmueble">

        <input type="button" value="Consultar" onclick="window.location.href='consultar_inmueble.php'">
        <input type="button" value="Volver" onclick="window.location.href='../menu.php'">
    </form>

   

   
    

</body>
</html>