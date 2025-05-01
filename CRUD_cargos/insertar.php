<?php
include '../conexion.php';

$name1 = $_POST['nom_cargo'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO cargos (nom_cargo) VALUES ('$name1')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo Cargo Agregado Exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
