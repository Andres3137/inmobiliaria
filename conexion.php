<?php
$host = "localhost";
$usuario = "root";
$contrasena = ""; 
$base_de_datos = "inmobiliaria";

// Crear conexión
$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
