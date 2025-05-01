<?php
include '../conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos.css">
    <title>Inspecciones</title>
</head>
<body>
    <form action="ingresar_ins.php" method="post">
        <h1>Registro de Inspecciones</h1>
        
        <label>Fecha de inspección:</label>
        <input type="date" name="fecha_ins" required>

        <label for="">Inmueble</label>
        <select id="cod_inm" name="cod_inm" required>
            <option value="">Seleccionar inmueble</option>
            <?php
            $inmuebles = $conn->query("SELECT cod_inm, di_inm FROM inmuebles");
            while ($inm = $inmuebles->fetch_assoc()) {
                echo "<option value='" . $inm['cod_inm'] . "'>" . htmlspecialchars($inm['di_inm']) . "</option>";
            }
            ?>
        </select>

        <label for="">Empleado</label>
        <select id="cod_emp" name="cod_emp" required>
            <option value="">Seleccionar empleado</option>
            <?php
            $empleados = $conn->query("SELECT cod_emp, nom_emp FROM empleados");
            while ($emp = $empleados->fetch_assoc()) {
                echo "<option value='" . $emp['cod_emp'] . "'>" . htmlspecialchars($emp['nom_emp']) . "</option>";
            }
            ?>
        </select>

        <label for="">Comentario</label>
        <textarea name="comentario" id="" cols="30" rows="10"></textarea><br><br>
        <input type="submit" value="Agregar">
        <input type="reset" value="Limpiar">
        <input type="button" value="Consultar" onclick="window.location.href='consultar_ins.php'">
    </form>
</body>
</html>