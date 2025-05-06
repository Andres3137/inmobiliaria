<?php
include '../conexion.php';

if (!isset($_GET['cod_cli'])) {
    echo "ID de cliente no especificado.";
    exit;
}

$cod_cli = $_GET['cod_cli'];

$sql = "DELETE FROM clientes WHERE cod_cli = $cod_cli";
if ($conn->query($sql) === TRUE) {
    header("Location: listar_clientes.php");
} else {
    echo "Error al eliminar: " . $conn->error;
}
