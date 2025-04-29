<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inmobiliaria";
$fechavis = $_POST['fecha_vis'];
$cod_cli = $_POST['cod_cli'];
$cod_emp = $_POST['cod_emp'];
$cod_inm = $_POST['cod_inm'];
$comenta_vis = $_POST['comenta_vis'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die("connection failed:" . $conn->connect_error);
}

$sql = "DELETE FROM visitas  WHERE fecha_vis='$fechavis'";

if($conn->query($sql)=== TRUE) {
    echo "listo a eliminado los datos de la visita";
}else{
    echo"error no funciono :" . $conn->error;
}
$conn->close();

?>