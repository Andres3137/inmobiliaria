<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inmobiliaria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT cod_inm , di_inm FROM inmuebles";
$result = $conn->query($sql);

$inmuebles = array();

if ($result-> num_rows > 0){
    while ($row = $result->fetch_assoc()){
        $inmueble = array ('cod_inm' => $row['cod_inm'], 'di_inm' => $row['di_inm']);
        $inmuebles[] = $inmueble;
    }
}

$conn->close();
header('Content-Type: application/json');
echo json_encode($inmuebles);



?>


