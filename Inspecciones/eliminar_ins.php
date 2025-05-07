<?php
include '../conexion.php';

if (isset($_GET['cod_ins'])) {
    $cod_ins = $_GET['cod_ins'];

    $sql = "DELETE FROM inspeccion WHERE cod_ins = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $cod_ins);
        if ($stmt->execute()) {
            echo "<script>
                alert('Inspección eliminada correctamente.');
                window.location.href = 'consultar_ins.php';
            </script>";
        } else {
            echo "<script>
                alert('Error al eliminar la inspección: " . addslashes($stmt->error) . "');
                window.history.back();
            </script>";
        }
        $stmt->close();
    } else {
        echo "<script>
            alert('Error al preparar la consulta: " . addslashes($conn->error) . "');
            window.history.back();
        </script>";
    }
} else {
    echo "<script>
        alert('Error: No se proporcionó un ID de inspección válido.');
        window.location.href = 'consultar_ins.php';
    </script>";
}

$conn->close();
?>