<?php
include '../conexion.php';

    $cod_inm = $_POST['cod_inm'];
    $fecha_ins = $_POST['fecha_ins'];
    $cod_emp = $_POST['cod_emp'];
    $comentario = $_POST['comentario'];

    // Prepare and bind
    $sql = "INSERT INTO inspeccion (fecha_ins, cod_inm, cod_emp, comentario) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("siss", $fecha_ins, $cod_inm, $cod_emp, $comentario);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>
                alert('Inspección registrada correctamente');
                alert('Volviendo al formulario');
                window.location.href = 'consultar_ins.php';
            </script>";
        } else {
            echo "<script>
                alert('Error al registrar la inspección: " . addslashes($stmt->error) . "');
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
    $conn->close();
?>