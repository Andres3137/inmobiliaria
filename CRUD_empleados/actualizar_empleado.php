<?php
include '../conexion.php';

// Verificar si se ha enviado el formulario
if (isset($_POST['cod_emp'])) {
    $cod_emp = $_POST['cod_emp'];
    $nom_emp = $_POST['nom_emp']; // Corregido
    $tipo_doc = $_POST['tipo_doc']; // Corregido
    $ced_emp = $_POST['ced_emp']; // Corregido
    $email_emp = $_POST['email_emp']; // Corregido
    $dic_emp = $_POST['dic_emp']; // Corregido
    $tel_emp = $_POST['tel_emp']; // Corregido
    $fecha_nac = $_POST['fecha_nac'];
    $cod_cargo = $_POST['cod_cargo'];
    $rh_emp = $_POST['rh_emp']; // Corregido
    $salario = $_POST['salario'];
    $gastos = $_POST['gastos'];
    $comision = $_POST['comision'];
    $fecha_ing = $_POST['fecha_ing'];
    $fecha_ret = $_POST['fecha_ret'];
    $nom_contacto = $_POST['nom_contacto'];
    $dic_contacto = $_POST['dic_contacto'];
    $tel_contacto = $_POST['tel_contacto'];
    $email_contacto = $_POST['email_contacto'];
    $relacion_contacto = $_POST['relacion_contacto'];
    $cod_ofi = $_POST['cod_ofi'];
    $observaciones = $_POST['observaciones'];

    // Actualizar la base de datos
    $sql = "UPDATE empleados SET 
                nom_emp = ?, 
                tipo_doc = ?, 
                ced_emp = ?, 
                email_emp = ?, 
                dic_emp = ?, 
                tel_emp = ?, 
                fecha_nac = ?, 
                cod_cargo = ?, 
                rh_emp = ?, 
                salario = ?, 
                gastos = ?, 
                comision = ?, 
                fecha_ing = ?, 
                fecha_ret = ?, 
                nom_contacto = ?, 
                dic_contacto = ?, 
                tel_contacto = ?, 
                email_contacto = ?, 
                relacion_contacto = ?, 
                cod_ofi = ? 
            WHERE cod_emp = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param(
            "ssssssssssssssssssssi", 
            $nom_emp, 
            $tipo_doc, 
            $ced_emp, 
            $email_emp, 
            $dic_emp, 
            $tel_emp, 
            $fecha_nac, 
            $cod_cargo, 
            $rh_emp, 
            $salario, 
            $gastos, 
            $comision, 
            $fecha_ing, 
            $fecha_ret, 
            $nom_contacto, 
            $dic_contacto, 
            $tel_contacto, 
            $email_contacto, 
            $relacion_contacto, 
            $cod_ofi, 
            $cod_emp
        );

        if ($stmt->execute()) {
            echo "Empleado actualizado exitosamente";
        } else {
            echo "Error al actualizar el empleado: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error al preparar la consulta.";
    }
}

$conn->close();
?>
