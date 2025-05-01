<?php
include '../conexion.php';

//sql to delete a record//
$sql="DELETE FROM cargos WHERE nom_cargo='".$_POST['nom_cargo']."'";
if($conn->query($sql)===TRUE){
    echo "cargo eliminado exitosamente";
}else{
    echo "error deleting record: ". $conn->error;
}

$conn->close();
?>