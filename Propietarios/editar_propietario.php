<?php
include '../conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM propietarios WHERE cod_propietarios = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $propietario = $result->fetch_assoc(); // Cambiado de $row a $propietario para usarlo luego
    } else {
        echo "Propietario no encontrado.";
        exit;
    }
} else {
    echo "ID no proporcionado.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Propietario</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
   
    <form action="actualizar_propietario.php" method="post">
    <h2>Editar Propietario</h2>
        <input type="hidden" name="cod_propietarios" value="<?php echo $propietario['cod_propietarios']; ?>">

        <label>Nombre del propietario</label>
        <input type="text" name="nombre_propietario" value="<?php echo $propietario['nomb_propietario']; ?>">

        <label>Tipo de empresa:</label>
        <input type="text" name="tipo_empresa" value="<?php echo $propietario['tipo_empresa']; ?>">

        <label>Tipo de documento:</label>
        <input type="text" name="tipo_documento" value="<?php echo $propietario['tipo_doc']; ?>">

        <label>Numero de documento:</label>
        <input type="text" name="numero_documento" value="<?php echo $propietario['num_doc']; ?>">

        <label>Dirección del propietario:</label>
        <input type="text" name="direccion" value="<?php echo $propietario['dic_propietario']; ?>">

        <label>Telefono del propietario:</label>
        <input type="text" name="telefono_propietario" value="<?php echo $propietario['tel_propietario']; ?>">

        <label>Email del propietario:</label>
        <input type="email" name="email_propietario" value="<?php echo $propietario['email_propietario']; ?>">

        <label>Contacto del propietario:</label>
        <input type="text" name="contacto_propietario" value="<?php echo $propietario['contacto_prop']; ?>">

        <label>Telefono contacto:</label>
        <input type="text" name="telefono_contacto" value="<?php echo $propietario['tel_contacto']; ?>">

        <label>Email contacto:</label>
        <input type="email" name="email_contacto" value="<?php echo $propietario['email_contacto']; ?>">

        <input type="submit" value="Actualizar Propietario">
        <a href="propietario.php">Cancelar</a>
    </form>
</body>
</html>

<?php
$conn->close();
?>
