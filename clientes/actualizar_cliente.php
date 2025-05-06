<?php
include '../conexion.php';

$cod_cli = $_POST['cod_cli'];
$nom_cli = $_POST['nom_cli'];
$tipo_doc_cli = $_POST['tipo_doc_cli'];
$doc_cli = $_POST['doc_cli'];
$dic_cli = $_POST['dic_cli'];
$tel_cli = $_POST['tel_cli'];
$email_cli = $_POST['email_cli'];
$cod_tipoinm = $_POST['cod_tipoinm'];
$valor_maximo = $_POST['valor_maximo'];
$fecha_creacion = $_POST['fecha_creacion'];
$cod_emp = $_POST['cod_emp'];
$notas_cli = $_POST['notas_cli'];

$sql = "UPDATE clientes SET 
    nom_cli = '$nom_cli',
    tipo_doc_cli = '$tipo_doc_cli',
    doc_cli = '$doc_cli',
    dic_cli = '$dic_cli',
    tel_cli = '$tel_cli',
    email_cli = '$email_cli',
    cod_tipoinm = $cod_tipoinm,
    valor_maximo = $valor_maximo,
    fecha_creacion = '$fecha_creacion',
    cod_emp = $cod_emp,
    notas_cli = '$notas_cli'
    WHERE cod_cli = $cod_cli";

if ($conn->query($sql) === TRUE) {
    header("Location: listar_clientes.php");
} else {
    echo "Error al actualizar: " . $conn->error;
}
