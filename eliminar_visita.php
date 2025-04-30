<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inmobiliaria";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar que se recibió cod_vis
if (isset($_POST['cod_vis'])) {
    $cod_vis = $_POST['cod_vis'];

    $stmt = $conn->prepare("DELETE FROM visitas WHERE cod_vis = ?");
    $stmt->bind_param("i", $cod_vis);

    if ($stmt->execute()) {
        echo "<p>✅ Visita eliminada correctamente.</p>";
    } else {
        echo "<p>❌ Error al eliminar la visita: " . $stmt->error . "</p>";
    }

    $stmt->close();
} else {
    echo "<p>❌ No se recibió el código de la visita para eliminar.</p>";
}

$conn->close();
?>
<a href="visitas.php">Volver a la lista</a>
