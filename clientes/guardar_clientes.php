<?php
include '../conexion.php';

// Verifica si llegaron los datos esperados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capturar datos del formulario
    $nom_cli = $_POST['nombre_cliente'];
    $tipo_doc_cli = $_POST['tipo_doc'];
    $doc_cli = $_POST['cedula_cliente'];
    $dic_cli = $_POST['direccion'];
    $tel_cli = $_POST['telefono_cliente'];
    $email_cli = $_POST['email_cliente'];
    $cod_tipoinm = $_POST['cod_tipoinm'];
    $valor_maximo = $_POST['valor_maximo'];
    $fecha_creacion = $_POST['fecha_creacion'];
    $cod_emp = $_POST['cod_emp'];
    $notas_cli = $_POST['notas_cli'];

    // Construcción de la consulta SQL
    $sql = "INSERT INTO clientes (
                nom_cli, tipo_doc_cli, doc_cli, dic_cli, tel_cli, email_cli,
                cod_tipoinm, valor_maximo, fecha_creacion, cod_emp, notas_cli
            ) VALUES (
                '$nom_cli', '$tipo_doc_cli', '$doc_cli', '$dic_cli', '$tel_cli', '$email_cli',
                $cod_tipoinm, $valor_maximo, '$fecha_creacion', $cod_emp, '$notas_cli'
            )";

    if ($conn->query($sql) === TRUE) {
        echo "Cliente agregado exitosamente.";
        header("Location: clientes.php");
        exit;
    } else {
        echo "Error al guardar el cliente: " . $conn->error;
    }
} else {
    echo "Método de solicitud no válido.";
}
