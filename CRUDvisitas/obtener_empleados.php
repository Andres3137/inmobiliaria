<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inmobiliaria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error)
{
    die("connection failed: " . $conn->connect_error);
}

$sql = "SELECT cod_emp, nom_emp FROM empleados";
$result = $conn->query($sql);

$empleados = array();

if ($result-> num_rows > 0)
{
    while ($row = $result->fetch_assoc()){
        $empleado = array('cod_emp' => $row['cod_emp'], 'nom_emp' => $row['nom_emp']);
        $empleados[] = $empleado;
    }
}

$conn->close();
header('Content-Type: application/json');
echo json_encode($empleados);


?>