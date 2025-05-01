<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $password = $_POST['pass_usuario'];


    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $result = $stmt->get_result();


    // $user = $result->fetch_assoc();

    // echo "Usuario ingresado: " . htmlspecialchars($nombre_usuario) . "<br>";
    // echo "Contraseña ingresada: " . htmlspecialchars($password) . "<br>";
    // echo "Contraseña ingresada: " . $password . "<br>";
    // echo "Contraseña en la base de datos: " . $user['pass_usuario'] . "<br>";
    // if (password_verify($password, $user['pass_usuario'])) {
    //     echo "✅ ¡Las contraseñas coinciden!<br>";
    // } else {
    //     echo "❌ ERROR: Las contraseñas NO coinciden.<br>";
    // }


    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        
        if (password_verify($password, $user['pass_usuario'])) {
            $_SESSION['nombre_usuario'] = $user['nombre_usuario'];
            $_SESSION['id_usuario'] = $user['id_usuario'];
            header("Location: menu.php");
            exit();

        } 
        else {
            $_SESSION['error'] = "Contraseña incorrecta";
            header("Location: inicio.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Usuario no encontrado";
        header("Location: inicio.php");
        exit();
    }
}
?>
