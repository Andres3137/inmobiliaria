<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inmobiliaria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("error de conexion: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cod_propietarios']) && is_numeric($_POST['cod_propietarios'])) {
    $cod_propietarios = intval($_POST['cod_propietarios']); // Convertir entero por seguridad

    $stmt_check = $conn->prepare($sql_check);

    $row_check = ["total" => 0]; // Se inicializa para evitar errores si `prepare()` falla

    if ($stmt_check) {
        $stmt_check->bind_param("i", $cod_propietarios);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        $row_check = $result_check->fetch_assoc();
        $stmt_check->close();
    }

    if ($row_check['total'] > 0) {
        die("<script>alert('No se puede eliminar el proveedor porque tiene órdenes de compra asociadas'); window.location.href='eliminar_propietario.php';</script>"); 
    }
} else {
    die("error en la consulta de verificación: " . $conn->error);
}

$sql = "DELETE FROM propietarios WHERE cod_propietarios = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $cod_propietarios);
    if ($stmt->execute()) {
        echo "<script>alert('Proveedor eliminado correctamente.'); window.location.href='propietario.php';</script>";
    } else {
        echo "Error al eliminar el proveedor: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "<script>alert('Error: No se proporciona un ID de proveedor válido.'); window.location.href='eliminar_propietario.php';</script>";
}

$conn->close();
?>
