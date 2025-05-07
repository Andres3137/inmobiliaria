<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cod_ins = $_POST['cod_ins'];
    $fecha_ins = $_POST['fecha_ins'];
    $cod_inm = $_POST['cod_inm'];
    $cod_emp = $_POST['cod_emp'];
    $comentario = $_POST['comentario'];

    $sql = "UPDATE inspeccion SET fecha_ins = ?, cod_inm = ?, cod_emp = ?, comentario = ? WHERE cod_ins = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sissi", $fecha_ins, $cod_inm, $cod_emp, $comentario, $cod_ins);

        if ($stmt->execute()) {
            echo "<script>
                alert('Inspección actualizada correctamente');
                window.location.href = 'consultar_ins.php';
            </script>";
        } else {
            echo "<script>
                alert('Error al actualizar la inspección: " . addslashes($stmt->error) . "');
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
    echo "Acceso no permitido.";
}

$conn->close();
?>