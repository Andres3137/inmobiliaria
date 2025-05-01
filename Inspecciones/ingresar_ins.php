<?php 
include '../conexion.php';



    
    $cod_inm = $_POST['cod_inm'];
    $fecha_ins = $_POST['fecha_ins'];
    $cod_emp = $_POST['cod_emp'];
    $comentario = $_POST['comentario'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO inspeccion (cod_ins, fecha_ins, cod_inm, cod_emp, comentario) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $fecha_ins, $cod_inm, $cod_emp, $comentario);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Inspección registrada exitosamente.";
        echo "<br><a href='consultar_ins.php'>Consultar Inspecciones</a>";
        echo "<br><a href='inspeccion_crud.php'>Volver</a>";
    } else {
        echo "Error al registrar la inspección: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();


?>