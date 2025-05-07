<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_contrato = $_POST['id_contrato'];
    $cod_cli = $_POST['cod_cli'];
    $fecha_contrato = $_POST['fecha_con'];
    $fecha_inicio = $_POST['fecha_ini'];
    $fecha_fin = $_POST['fecha_fin'];
    $meses = $_POST['meses'];
    $valor_contrato = $_POST['valor_con'];
    $deposito_contrato = $_POST['deposito_con'];
    $metodo_pago = $_POST['metodo_pago_con'];
    $dato_pago = $_POST['dato_pago'];

    $archivo_nombre = $_FILES['archivo_con']['name'];
    $archivo_temporal = $_FILES['archivo_con']['tmp_name'];
    $ruta_archivo = "archivos_co/" . basename($archivo_nombre);

    if ($archivo_nombre) {
        if (move_uploaded_file($archivo_temporal, $ruta_archivo)) {
            // File uploaded successfully, $archivo_nombre now contains the new filename
        } else {
            // Handle file upload error
            header("Location: consultar_con.php?error=Error+al+subir+el+archivo");
            exit();
        }
    } else {
        // If no new file is uploaded, keep the existing filename
        $sql_archivo_actual = "SELECT archivo_con FROM contratos WHERE cod_con = ?";
        $stmt_archivo_actual = $conn->prepare($sql_archivo_actual);
        $stmt_archivo_actual->bind_param("i", $id_contrato);
        $stmt_archivo_actual->execute();
        $result_archivo_actual = $stmt_archivo_actual->get_result();
        if ($fila_archivo_actual = $result_archivo_actual->fetch_assoc()) {
            $archivo_nombre = $fila_archivo_actual['archivo_con'];
        }
        $stmt_archivo_actual->close();
    }

    $query = "UPDATE contratos SET
        cod_cli = ?,
        fecha_con = ?,
        fecha_ini = ?,
        fecha_fin = ?,
        meses = ?,
        valor_con = ?,
        deposito_con = ?,
        metodo_pago_con = ?,
        dato_pago = ?,
        archivo_con = ?
        WHERE cod_con = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "isssiiisssi",
        $cod_cli,
        $fecha_contrato,
        $fecha_inicio,
        $fecha_fin,
        $meses,
        $valor_contrato,
        $deposito_contrato,
        $metodo_pago,
        $dato_pago,
        $archivo_nombre,
        $id_contrato
    );

    if ($stmt->execute()) {
        header("Location: consultar_con.php?success=Contrato+actualizado+correctamente");
    } else {
        header("Location: consultar_con.php?error=Error+al+actualizar+el+contrato: " . $stmt->error);
    }
    $stmt->close();
    $conn->close();
} else {
    // If the script is accessed directly without a POST request
    header("Location: consultar_con.php");
    exit();
}
?>