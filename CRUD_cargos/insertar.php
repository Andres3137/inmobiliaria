<?php
include '../conexion.php';

$name1 = $_POST['nom_cargo'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Preparar la consulta SQL
$sql = "INSERT INTO cargos (nom_cargo) VALUES (?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Vincular el parámetro
    $stmt->bind_param("s", $name1);

    // Ejecutar la sentencia preparada
    if ($stmt->execute()) {
        echo "<script>
            alert('Nuevo Cargo Agregado Exitosamente');
            alert('Volviendo al formulario');
            window.location.href = 'cargos.php';
        </script>";
    } else {
        echo "<script>
            alert('Error al agregar el cargo: " . addslashes($stmt->error) . "');
            window.history.back();
        </script>";
    }

    // Cerrar la sentencia
    $stmt->close();
} else {
    echo "<script>
        alert('Error al preparar la consulta: " . addslashes($conn->error) . "');
        window.history.back();
    </script>";
}

// Cerrar la conexión
$conn->close();
?>