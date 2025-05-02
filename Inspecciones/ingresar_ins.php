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
    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert('Inspeccion registrado correctamente');
            alert('Volviendo al formulario');
            window.location.href = 'inspeccion_crud.php';
        </script>";
    } else {
        echo "<script>
            alert('Error al eliminar: " . addslashes($conn->error) . "');
            window.history.back();
        </script>";
    }
    $stmt->close();
    $conn->close();


?>