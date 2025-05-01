<?php
include '../conexion.php';

// Obtener el ID del empleado desde el formulario
if (isset($_POST['cod_emp'])) {
    $cod_emp = $_POST['cod_emp'];

    // SQL para eliminar el registro del empleado por su cod_emp
    $sql = "DELETE FROM empleados WHERE cod_emp = ?";
    
    // Preparar la consulta
    if ($stmt = $conn->prepare($sql)) {
        // Enlazar el parámetro
        $stmt->bind_param("i", $cod_emp);
        
        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Empleado eliminado exitosamente";
        } else {
            echo "Error al eliminar el empleado: " . $stmt->error;
        }

        // Cerrar la consulta
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
} else {
    echo "No se proporcionó el ID del empleado.";
}

$conn->close();
?>
