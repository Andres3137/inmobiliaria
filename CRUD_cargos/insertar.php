<?php
include '../conexion.php';

$name1 = $_POST['nom_cargo'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO cargos (nom_cargo) VALUES ('$name1')";


if ($conn->query($sql) === TRUE) {
    echo "<script>
        alert('Nuevo Cargo Agregado Exitosamente');
        alert('Volviendo al formulario');
        window.location.href = 'cargos.php';
    </script>";
} else {
    echo "<script>
        alert('Error: " . addslashes($conn->error) . "');
        window.history.back();
    </script>";
}

$conn->close();
?>

