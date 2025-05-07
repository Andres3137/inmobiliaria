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
$sql = "UPDATE tipo_inmueble SET nom_tipoinm = ? WHERE cod_tipoinm = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $inmueble, $cod_tipoinm);

if ($stmt->execute()) {
    echo "<script>
        alert('Tipo de inmueble actualizado correctamente');
        window.location.href = 'tipo_inmueble_crud.php';
    </script>";
} else {
    echo "<script>
        alert('Error al actualizar el tipo de inmueble: " . addslashes($stmt->error) . "');
        window.history.back();
    </script>";
}

$stmt->close();
$conn->close();
?>