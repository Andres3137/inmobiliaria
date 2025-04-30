<?php
include("conexion.php");

// Recoger datos del formulario
$fechavis = $_POST['fecha_vis'];
$cod_cli = $_POST['cod_cli'];
$cod_emp = $_POST['cod_emp'];
$cod_inm = $_POST['cod_inm'];
$comenta_vis = $_POST['comenta_vis'];

// Preparar la consulta con 5 columnas
$sql = "INSERT INTO visitas (fecha_vis, cod_cli, cod_emp, cod_inm, comenta_vis)
        VALUES (?, ?, ?, ?, ?)";

// Preparar y vincular
$stmt = $conn->prepare($sql);
$stmt->bind_param("siiis", $fechavis, $cod_cli, $cod_emp, $cod_inm, $comenta_vis);

// Ejecutar
if ($stmt->execute()) {
    echo "✅ Visita registrada correctamente.";
} else {
    echo "❌ Error: " . $stmt->error;
}

// Cerrar conexiones
$stmt->close();
$conn->close();
?>
