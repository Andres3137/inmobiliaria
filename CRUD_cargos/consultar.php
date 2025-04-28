<?php
include 'conexion.php';
$name1 = $_POST['nom_cargo'];


$sql="SELECT nom_cargo FROM cargos";
$result=$conn->query($sql);

if($result->num_rows>0){
    //output data of each row//
    while($row=$result->fetch_assoc()){
        echo "cargo " . $row["nom_cargo"]. "<br>";
    }
}else{
    echo "0 results";
}
$conn->close();
?>