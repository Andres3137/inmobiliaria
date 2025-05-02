<?php
include '../conexion.php';

$cliente = $_POST['cod_cli'];
$fecha_contrato = $_POST['fecha_contrato'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$meses = $_POST['meses'];
$valor_contrato = $_POST['valor_contrato'];
$deposito_contrato = $_POST['deposito_contrato'];
$metodo_pago = $_POST['metodo_pago'];
$dato_pago = $_POST['dato_pago'];


$archivo_contrato = null;
if (!empty($_FILES['archivo_co']['name'])) {
    $archivo_contrato = "archivos_co/" . basename($_FILES['archivo_co']['name']);
    move_uploaded_file($_FILES['archivo_co']['tmp_name'], $archivo_contrato);
}


$sql="INSERT INTO contratos (cod_cli, fecha_con, fecha_ini, fecha_fin, meses, valor_con, deposito_con, metodo_pago_con, dato_pago, archivo_con) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssiiisss", $cliente, $fecha_contrato, $fecha_inicio, $fecha_fin, $meses, $valor_contrato, $deposito_contrato, $metodo_pago, $dato_pago, $archivo_contrato);

if ($conn->query($sql) === TRUE) {
    echo "<script>
        alert('Contrato registrado correctamente');
        alert('Volviendo al formulario');
        window.location.href = 'contrato_crud.php';
    </script>";
} else {
    echo "<script>
        alert('Error al eliminar: " . addslashes($conn->error) . "');
        window.history.back();
    </script>";
}
$stmt->close();
$conn->close();
?>