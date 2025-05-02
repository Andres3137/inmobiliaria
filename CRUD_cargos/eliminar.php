<?php
include '../conexion.php';

//sql to delete a record//
$sql="DELETE FROM cargos WHERE nom_cargo='".$_POST['nom_cargo']."'";

if ($conn->query($sql) === TRUE) {
    echo "<script>
        alert('Cargo eliminado correctamente');
        alert('Volviendo al formulario');
        window.location.href = 'cargos.php';
    </script>";
} else {
    echo "<script>
        alert('Error al eliminar: " . addslashes($conn->error) . "');
        window.history.back();
    </script>";
}

$conn->close();
?>
