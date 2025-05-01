<?php
include '../conexion.php';

// Verificar que los campos existen
if (isset($_POST['nom_cargo']) && isset($_POST['nuevo_cargo'])) {
    $cargo_actual = $_POST['nom_cargo'];
    $cargo_nuevo = $_POST['nuevo_cargo'];

    // Preparar la consulta
    $sql = "UPDATE cargos SET nom_cargo = ? WHERE nom_cargo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $cargo_nuevo, $cargo_actual);

    // Ejecutar y verificar
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Cargo actualizado exitosamente.";
        } else {
            echo "No se encontró el cargo o no hubo cambios.";
        }
    } else {
        echo "Error al actualizar el cargo: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Faltan datos en el formulario.";
}

$conn->close();
?>
