<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propietarios</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <h2>Propietario: </h2>

    <form action="guardar_propietario.php" method="post">

        <label>Tipo de empresa:</label>
        <input type="text" name="tipo_empresa">

        <label>Tipo de documento:</label>
        <input type="text" name="tipo_documento">

        <label>Numero de documento:</label>
        <input type="text" name="numero_documento">

        <label>Nombre del propietario:</label>
        <input type="text" name="nombre_propietario">

        <label>Dirección:</label>
        <input type="text" name="direccion">

        <label>Telefono del propietario:</label>
        <input type="text" name="telefono_propietario">

        <label>Email del propietario:</label>
        <input type="email" name="email_propietario">

        <label>Contacto del propietario:</label>
        <input type="text" name="contacto_propietario">

        <label>Telefono contacto:</label>
        <input type="text" name="telefono_contacto">

        <label>Email contacto:</label>
        <input type="email" name="email_contacto">

        <input type="submit" value="Guardar Propietario">

    </form>

    <form action="consultar_propietario.php" method="post">
        <input type="submit" value="Consultar propietario">
    </form>

</body>

</html>