<?php 
include '../conexion.php';

$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$latitud = $_POST['latitud'];
$longitud = $_POST['longitud'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];

$foto = null;
if (!empty($_FILES['foto']['name'])) {
    $foto = "uploads/" . basename($_FILES['foto']['name']);
    move_uploaded_file($_FILES['foto']['tmp_name'], $foto);
}

$sql = "INSERT INTO oficinas(nom_ofi, dic_ofi, tel_ofi, email_ofi, latitud, longitud, foto_ofi) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error al preparar la consulta: " . $conn->error);
}

// Vincular parámetros con tipos correctos
// s = string, d = double (para latitud y longitud)
$stmt->bind_param("ssssdds", $nombre, $direccion, $telefono, $email, $latitud, $longitud, $foto);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "<script>
        alert('Oficina registrada correctamente');
        window.location.href = 'oficina_crud.php';
    </script>";
} else {
    echo "<script>
        alert('Error al guardar: " . addslashes($stmt->error) . "');
        window.history.back();
    </script>";
}

$stmt->close();
$conn->close();
?>
