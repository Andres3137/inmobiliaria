<?php
include '../conexion.php';

// Recibir datos del formulario
$cod_inm = $_POST['cod_inm'];
$di_inm = $_POST['di_inm'];
$barrio_inm = $_POST['barrio_inm'];
$ciudad_inm = $_POST['ciudad_inm'];
$departamento_inm = $_POST['departamento_inm'];
$latitud = $_POST['latitud'];
$longitud = $_POST['longitud'];
$web_p1 = $_POST['web_p1'];
$web_p2 = $_POST['web_p2'];
$cod_tipoinm = $_POST['cod_tipoinm'];
$num_hab = $_POST['num_hab'];
$precio_alq = $_POST['precio_alq'];
$cod_propietarios = $_POST['cod_propietarios'];
$caracteristica_inm = $_POST['caracteristica_inm'];
$notas_inm = $_POST['notas_inm'];
$cod_emp = $_POST['cod_emp'];
$cod_ofi = $_POST['cod_ofi'];

// Manejo de foto si se actualiza
$foto_sql = "";
if (!empty($_FILES['foto']['name'])) {
    $foto = "uploads/" . basename($_FILES['foto']['name']);
    move_uploaded_file($_FILES['foto']['tmp_name'], $foto);
    $foto_sql = ", foto = '$foto'";
}

// Crear la consulta SQL
$sql = "UPDATE inmuebles SET 
    di_inm = '$di_inm',
    barrio_inm = '$barrio_inm',
    ciudad_inm = '$ciudad_inm',
    departamento_inm = '$departamento_inm',
    latitud = '$latitud',
    longitud = '$longitud'
    $foto_sql,
    web_p1 = '$web_p1',
    web_p2 = '$web_p2',
    cod_tipoinm = $cod_tipoinm,
    num_hab = $num_hab,
    precio_alq = $precio_alq,
    cod_propietarios = $cod_propietarios,
    caracteristicas_inm = '$caracteristica_inm',
    notas_inm = '$notas_inm',
    cod_emp = $cod_emp,
    cod_ofi = $cod_ofi
    WHERE cod_inm = $cod_inm";

if ($conn->query($sql) === TRUE) {
    header("Location: consultar_inmueble.php");
    exit;
} else {
    echo "Error al actualizar: " . $conn->error;
}

$conn->close();
?>
