<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inmobiliaria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica si se pasó el ID de la visita por la URL
if (!isset($_GET['id'])) {
    die("No se proporcionó el ID de la visita.");
}

$id_visita = $_GET['id'];

// Consulta con JOIN para obtener datos relacionados
$sql = "SELECT v.*,
               c.nom_cli AS nombre_cliente,
               e.nom_emp AS nombre_empleado,
               i.di_inm AS direccion
        FROM visitas v
        JOIN clientes c ON v.cod_cli = c.cod_cli
        JOIN empleados e ON v.cod_emp = e.cod_emp
        JOIN inmuebles i ON v.cod_inm = i.cod_inm
        WHERE v.cod_vis = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error en prepare: " . $conn->error);
}

$stmt->bind_param("i", $id_visita);
$stmt->execute();
$result = $stmt->get_result();

// Verifica si se encontró la visita
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
    <title>Editar Visita</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
    
    <form action="actualizar_visita.php" method="post">
    <h2>Editar Visita</h2>
        <!-- Campo oculto con el ID de la visita -->
        <input type="hidden" name="cod_vis" value="<?php echo $visita['cod_vis']; ?>">

        <!-- Cliente -->
        <label>Cliente:</label>
        <select name="cod_cli">
            <?php
            $clientes = $conn->query("SELECT cod_cli, nom_cli FROM clientes");
            while ($cli = $clientes->fetch_assoc()) {
                $selected = ($cli['cod_cli'] == $visita['cod_cli']) ? 'selected' : '';
                echo "<option value='{$cli['cod_cli']}' $selected>{$cli['nom_cli']}</option>";
            }
            ?>
        </select><br>

        <!-- Empleado -->
        <label>Empleado:</label>
        <select name="cod_emp">
            <?php
            $empleados = $conn->query("SELECT cod_emp, nom_emp FROM empleados");
            while ($emp = $empleados->fetch_assoc()) {
                $selected = ($emp['cod_emp'] == $visita['cod_emp']) ? 'selected' : '';
                echo "<option value='{$emp['cod_emp']}' $selected>{$emp['nom_emp']}</option>";
            }
            ?>
        </select><br>

        <!-- Inmueble -->
        <label>Inmueble (Dirección):</label>
        <select name="cod_inm">
            <?php
            $inmuebles = $conn->query("SELECT cod_inm, di_inm FROM inmuebles");
            while ($inm = $inmuebles->fetch_assoc()) {
                $selected = ($inm['cod_inm'] == $visita['cod_inm']) ? 'selected' : '';
                echo "<option value='{$inm['cod_inm']}' $selected>{$inm['di_inm']}</option>";
            }
            ?>
        </select><br>

        <!-- Fecha -->
        <label>Fecha:</label>
        <input type="date" name="fecha_vis" value="<?php echo $visita['fecha_vis']; ?>"><br>

        <!-- Comentario -->
        <label>Comentario:</label>
        <textarea name="comenta_vis"><?php echo $visita['comenta_vis']; ?></textarea><br>

        <!-- Botón de enviar -->
        <input type="submit" value="Actualizar visita">
    </form>
</body>
</html>


<?php
$conn->close();
?>
