<?php
//Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inmobiliaria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: ". $conn->connect_error); 
}

//Obtener datos del formulario
$cod_tipoinm = $_POST['cod_tipoinm'];
$inmueble = $_POST['nombre_inmueble'];

//Actualizar los datos de la base de datos
$sql = "UPDATE tipo_inmueble SET nom_tipoinm = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $inmueble);

if ($stmt->execute()) {
    echo "Proveedor actualizado correctamente";
    echo "<br><a href='inmueble.php'>Volver a la lista</a>";
}else {
    echo "Error al actualizar el proveedor: " . $conn->error;
}

$stmt->close();
$conn->close();
?>