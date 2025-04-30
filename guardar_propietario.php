<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inmobiliaria";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
    die("conexión fallida: " . $conn -> connect_error);
}

$tipo_empresa = $_POST['tipo_empresa'];
$tipo_doc = $_POST['tipo_documento'];
$num_doc = $_POST['numero_documento'];
$nomb_propietario = $_POST['nombre_propietario'];
$dic_propietario= $_POST['direccion'];
$tel_propietario = $_POST['telefono_propietario'];
$email_propietario = $_POST['email_propietario'];
$contacto_prop = $_POST['contacto_propietario'];
$tel_contacto = $_POST['telefono_contacto'];
$email_contacto = $_POST['email_contacto'];

$sql = "INSERT INTO propietarios (tipo_empresa, tipo_doc, num_doc, nomb_propietario, dic_propietario, tel_propietario, email_propietario, contacto_prop, tel_contacto, email_contacto)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssss", $tipo_empresa, $tipo_doc, $num_doc, $nomb_propietario, $dic_propietario, $tel_propietario, $email_propietario, $contacto_prop, $tel_contacto, $email_contacto);

if ($stmt->execute()) {
    echo "Propietario resgistradocon exito.";
}else {
    echo "Error al registrar el propietario: " . $conn->error;
}

$stmt->close();
$conn->close();
?>





