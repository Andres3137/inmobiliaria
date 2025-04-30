<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inmobiliaria";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar que llegaron todos los datos necesarios
if (
    isset($_POST['cod_vis']) &&
    isset($_POST['fecha_vis']) &&
    isset($_POST['comenta_vis']) &&
    isset($_POST['cod_cli']) &&
    isset($_POST['cod_emp']) &&
    isset($_POST['cod_inm'])
) {
    // Recoger datos del formulario
    $cod_vis = $_POST['cod_vis'];
    $fecha_vis = $_POST['fecha_vis'];
    $comenta_vis = $_POST['comenta_vis'];
    $cod_cli = $_POST['cod_cli'];
    $cod_emp = $_POST['cod_emp'];
    $cod_inm = $_POST['cod_inm'];

    // Preparar sentencia SQL
    $sql = "UPDATE visitas 
            SET fecha_vis = ?, comenta_vis = ?, cod_cli = ?, cod_emp = ?, cod_inm = ?
            WHERE cod_vis = ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error al preparar la actualización: " . $conn->error);
    }

    // Enlazar parámetros y ejecutar
    $stmt->bind_param("ssiisi", $fecha_vis, $comenta_vis, $cod_cli, $cod_emp, $cod_inm, $cod_vis);

    if ($stmt->execute()) {
        echo "<p>Visita actualizada correctamente.</p>";
        echo "<a href='visitas.php'>Volver a la lista de visitas</a>";
    } else {
        echo "Error al actualizar la visita: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Faltan datos para actualizar la visita.";
}

$conn->close();
?>
