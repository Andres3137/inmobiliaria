<?php
include '../conexion.php';

$cod_emp = $_GET['id'];

// Verificar si se recibe el ID del empleado
if (!$cod_emp) {
    die("Empleado no encontrado.");
}

// Obtener los datos del empleado
$sql = "SELECT 
            e.cod_emp, 
            e.nom_emp, 
            e.tipo_doc, 
            e.ced_emp, 
            e.dic_emp, 
            e.tel_emp, 
            e.email_emp, 
            e.rh_emp, 
            e.fecha_nac, 
            e.cod_cargo, 
            e.salario, 
            e.gastos, 
            e.comision, 
            e.fecha_ing, 
            e.fecha_ret, 
            e.nom_contacto, 
            e.dic_contacto, 
            e.tel_contacto, 
            e.email_contacto, 
            e.relacion_contacto, 
            e.cod_ofi
            
        FROM empleados e
        WHERE e.cod_emp = $cod_emp";

$result = $conn->query($sql);
$emp = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Empleado</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
   

    <form action="actualizar_empleado.php" method="POST">
    <h1>Editar empleado</h1>
        <fieldset>
        <legend>Datos del empleado</legend>
        <input type="hidden" name="cod_emp" value="<?php echo htmlspecialchars($emp['cod_emp']); ?>">

        <label>Nombre empleado:</label>
        <input type="text" name="nom_emp" value="<?php echo htmlspecialchars($emp['nom_emp']); ?>" required>

        <label>Tipo de documento:</label>
        <input type="text" name="tipo_doc" value="<?php echo htmlspecialchars($emp['tipo_doc']); ?>">

        <label>Cédula:</label>
        <input type="text" name="ced_emp" value="<?php echo htmlspecialchars($emp['ced_emp']); ?>">

        <label>Email:</label>
        <input type="email" name="email_emp" value="<?php echo htmlspecialchars($emp['email_emp']); ?>">

        <label>Dirección:</label>
        <input type="text" name="dic_emp" value="<?php echo htmlspecialchars($emp['dic_emp']); ?>">

        <label>Teléfono:</label>
        <input type="text" name="tel_emp" value="<?php echo htmlspecialchars($emp['tel_emp']); ?>">

        <label>Fecha nacimiento:</label>
        <input type="date" name="fecha_nac" value="<?php echo htmlspecialchars($emp['fecha_nac']); ?>">

        <label>Cargo:</label>
        <select name="cod_cargo" required>
            <option value="">Seleccionar cargo</option>
            <?php
            $cargos = $conn->query("SELECT cod_cargo, nom_cargo FROM cargos");
            while ($cargo = $cargos->fetch_assoc()) {
                $selected = ($emp['cod_cargo'] == $cargo['cod_cargo']) ? 'selected' : '';
                echo "<option value='" . $cargo['cod_cargo'] . "' $selected>" . htmlspecialchars($cargo['nom_cargo']) . "</option>";
            }
            ?>
        </select>

        <label>RH:</label>
        <input type="text" name="rh_emp" value="<?php echo htmlspecialchars($emp['rh_emp']); ?>">

        <label>Salario:</label>
        <input type="text" name="salario" value="<?php echo htmlspecialchars($emp['salario']); ?>">

        <label>Gastos:</label>
        <input type="text" name="gastos" value="<?php echo htmlspecialchars($emp['gastos']); ?>">

        <label>Comisión:</label>
        <input type="text" name="comision" value="<?php echo htmlspecialchars($emp['comision']); ?>">

        <label>Fecha de ingreso:</label>
        <input type="date" name="fecha_ing" value="<?php echo htmlspecialchars($emp['fecha_ing']); ?>">

        <label>Fecha de retorno:</label>
        <input type="date" name="fecha_ret" value="<?php echo htmlspecialchars($emp['fecha_ret']); ?>">
        </fieldset>
        <fieldset>
        <legend>Contacto</legend>
        <label>Nombre contacto:</label>
        <input type="text" name="nom_contacto" value="<?php echo htmlspecialchars($emp['nom_contacto']); ?>">

        <label>Dirección contacto:</label>
        <input type="text" name="dic_contacto" value="<?php echo htmlspecialchars($emp['dic_contacto']); ?>">

        <label>Teléfono contacto:</label>
        <input type="text" name="tel_contacto" value="<?php echo htmlspecialchars($emp['tel_contacto']); ?>">

        <label>Email contacto:</label>
        <input type="email" name="email_contacto" value="<?php echo htmlspecialchars($emp['email_contacto']); ?>">

        <label>Relación contacto:</label>
        <input type="text" name="relacion_contacto" value="<?php echo htmlspecialchars($emp['relacion_contacto']); ?>">
        </fieldset>
        <label>Oficina:</label>
        <select name="cod_ofi" required>
            <option value="">Seleccionar oficina</option>
            <?php
            $oficinas = $conn->query("SELECT cod_ofi, nom_ofi FROM oficinas");
            while ($ofi = $oficinas->fetch_assoc()) {
                $selected = ($emp['cod_ofi'] == $ofi['cod_ofi']) ? 'selected' : '';
                echo "<option value='" . $ofi['cod_ofi'] . "' $selected>" . htmlspecialchars($ofi['nom_ofi']) . "</option>";
            }
            ?>
        </select>

        <input type="submit" value="Actualizar empleado">
    </form>

</body>
</html>

<?php
$conn->close();
?>
