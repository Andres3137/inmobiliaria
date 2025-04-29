<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inmobiliaria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica si se envió la fecha por POST
if (!isset($_POST['fecha_vis'])) {
    die("No se proporcionó la fecha de la visita.");
}

$fecha_vis = $_POST['fecha_vis'];

// Obtener datos de la visita
$sql = "SELECT * FROM visitas WHERE fecha_vis = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $fecha_vis);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Visita no encontrada.");
}

$visita = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Visita</title>
</head>
<body>
    <h2>Editar Visita</h2>
    <form action="actualizar_visita.php" method="post">
        <!-- Este campo oculto asegura que la fecha se mantenga al actualizar -->
        <input type="hidden" name="fecha_vis" value="<?php echo $visita['fecha_vis']; ?>">

        <label>Cliente:</label>
        <input type="text" name="cod_cli" value="<?php echo $visita['cod_cli']; ?>" required>

        <label>Empleado:</label>
        <input type="text" name="cod_emp" value="<?php echo $visita['cod_emp']; ?>" required>

        <label>Inmueble:</label>
        <input type="text" name="cod_inm" value="<?php echo $visita['cod_inm']; ?>" required>

        <label>Comentarios:</label><br>
        <textarea name="comenta_vis" rows="4"><?php echo $visita['comenta_vis']; ?></textarea><br>

        <input type="submit" value="Actualizar Visita">
        <a href="visitas_crud.php">Cancelar</a>
    </form>
</body>
</html>

<?php
$conn->close();
?>
