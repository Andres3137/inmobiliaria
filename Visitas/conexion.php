<?php
$host = "localhost";
$usuario = "root";
$contrasena = ""; 
$base_de_datos = "inmobiliaria";

$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
