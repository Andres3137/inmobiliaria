<?php
include '../conexion.php';
$name1 = $_POST['nombre_empleado'];


$sql="SELECT cod_emp, ced_emp, tipo_doc  FROM empleados";
$result=$conn->query($sql);

if($result->num_rows>0){
    //output data of each row//
    while($row=$result->fetch_assoc()){
        echo " Empleado " . $row["nom_emp"]. "<br>";
    }
}else{
    echo "0 results";
}
$conn->close();
?>