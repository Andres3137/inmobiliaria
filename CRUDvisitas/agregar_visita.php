<?php
include("conexion.php");

$fechavis = $_POST['fecha_vis'];
$comenta_vis = $_POST['comenta_vis'];

$sql = "INSERT INTO visitas (fecha_vis, comenta_vis)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("siiis", $fechavis, $cod_cli, $cod_emp, $cod_inm, $comenta_vis);

if ($stmt->execute()) {
    echo "✅ Visita registrada correctamente.";
} else {
    echo "❌ Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>
