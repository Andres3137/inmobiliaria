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
$cod_propietarios = $_POST['cod_propietarios'];
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

//Actualizar los datos de la base de datos
$sql = "UPDATE propietarios SET tipo_empresa = ?, tipo_doc = ?, num_doc = ?, nomb_propietario = ?, dic_propietario = ?, tel_propietario = ?, email_propietario = ?, contacto_prop = ?, tel_contacto = ?, email_contacto = ? WHERE cod_propietarios = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssisssssssi", $tipo_empresa, $tipo_doc, $num_doc, $nomb_propietario, $dic_propietario, $tel_propietario, $email_propietario, $contacto_prop, $tel_contacto, $email_contacto, $cod_propietarios);

if ($conn->query($sql) === TRUE) {
    echo "<script>
        alert('Propietario actualizado correctamente');
        alert('Volviendo al formulario');
        window.location.href = 'propietario_crud.php';
    </script>";
} else {
    echo "<script>
        alert('Error al eliminar: " . addslashes($conn->error) . "');
        window.history.back();
    </script>";
}

$stmt->close();
$conn->close();
?>