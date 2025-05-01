<?php
include '../conexion.php';

$nombre_usuario=$_POST['nombre_usuario'];

$contraseña=$_POST['pass_usuario'];
$hash_password = password_hash($contraseña, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nombre_usuario, pass_usuario) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $nombre_usuario, $hash_password);

if($stmt->execute()){
    header("Location: inicio.php");
    exit();
}else {
    echo "Error al registrar usuario";
}
$stmt->close();
$conn->close();

?>
