<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inmobiliaria";

$conn = new mysqli ($servername, $username, $password ,$dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT cod_cli , nom_cli FROM clientes";
$result = $conn->query($sql);

$clientes = array();

if ($result->num_rows > 0){
    while ($row = $result->fetch_assoc()){
        $cliente = array ('cod_cli' => $row['cod_cli'],'nom_cli' => $row['nom_cli']);
        $clientes[] = $cliente;
    }
}

$conn->close();
header('Content-Type: application/json');
echo json_encode($clientes);

?>
