<?php
include("conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM tipo_inmueble WHERE cod_tipoinm = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $tipo_inmueble = $result->fetch_assoc(); // Cambiado de $row a $propietario para usarlo luego
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
    <title>Editar Inmuebles</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Editar Inmuebles</h2>
    <form action="actualizar_inmueble.php" method="post">
        <input type="hidden" name="cod_tipoinm" value="<?php echo $tipo_inmueble['cod_tipoinm']; ?>">

        <label>Nombre del inmueble</label>
        <input type="text" name="nombre_inmueble" value="<?php echo $tipo_inmueble['nom_tipoinm']; ?>">

        <input type="submit" value="Actualizar Inmueble">
        <a href="inmueble.php">Cancelar</a>
    </form>
</body>
</html>

<?php
$conn->close();
?>
