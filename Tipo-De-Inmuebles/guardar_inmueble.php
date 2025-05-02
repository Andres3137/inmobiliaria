<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inmobiliaria";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
    die("conexión fallida: " . $conn -> connect_error);
}

$inmueble = $_POST['nombre_inmueble'];

$sql = "INSERT INTO tipo_inmueble (nom_tipoinm)
        VALUES (?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $inmueble);

if ($stmt->execute()) {
    echo "Inmueble resgistrado con exito.";
    
}else {
    echo "Error al registrar el propietario: " . $conn->error;
}

$stmt->close();
$conn->close();
?>






