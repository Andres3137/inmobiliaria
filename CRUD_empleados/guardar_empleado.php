

<?php
include '../CRUD_cargos/conexion.php';




// Definir variables 
$nom_emp = $_POST['nombre_empleado'];
$tip_doc = $_POST['tipo_doc'];
$ced_emp = $_POST['cedula_empleado'];
$email_emp = $_POST['email_empleado'];
$direccion = $_POST['direccion'];
$tel_emp = $_POST['telefono_empleado'];
$fecha_nac = $_POST['fecha_nacimiento'];
$cod_cargo = $_POST['cod_cargo'];  // Este es el cargo seleccionado
$rh_emp = $_POST['rh_empleado'];
$salario = $_POST['salario'];
$gastos = $_POST['gastos'];
$comision = $_POST['comision'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$fecha_retorno = $_POST['fecha_retorno'];
$nombre_contacto = $_POST['nombre_contacto'];
$direccion_contacto = $_POST['direccion_contacto'];
$telefono_contacto = $_POST['telefono_contacto'];
$email_contacto = $_POST['email_contacto'];
$relacion_contacto = $_POST['relacion_contacto'];
$oficina = $_POST['cod_ofi'];

// Obtener los cargos existentes de la base de datos
$sql_cargos = "SELECT cod_cargo, nom_cargo FROM cargos";
$result = $conn->query($sql_cargos);

$cargos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cargos[] = $row;
    }
}

$sql_oficinas = "SELECT cod_ofi, nom_ofi FROM oficinas";
$result = $conn->query($sql_oficinas);

$oficinas = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $oficinas[] = $row;
    }
}

// Consulta SQL para insertar los datos del empleado
$sql = "INSERT INTO empleados (
     ced_emp, tipo_doc, nom_emp, dic_emp, tel_emp, email_emp, rh_emp, fecha_nac, cod_cargo, salario, gastos, comision, fecha_ing, fecha_ret, nom_contacto, dic_contacto,
    tel_contacto, email_contacto, relacion_contacto, cod_ofi 
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("issssssssiddsssssssi", $ced_emp, $tip_doc, $nom_emp, $direccion, $tel_emp, $email_emp, $rh_emp, $fecha_nac, $cod_cargo, $salario, $gastos, $comision, $fecha_ingreso, $fecha_retorno, $nombre_contacto, $direccion_contacto, $telefono_contacto, $email_contacto, $relacion_contacto, $oficina);

if ($stmt->execute()) {
    //redige a la pagina del formulario denuevo

    header("Location: empleados.php?registro=ok");
exit();
///buena practica para detener la ejecucion despues de redirigir
} else {
    echo "Error al registrar el empleado: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
