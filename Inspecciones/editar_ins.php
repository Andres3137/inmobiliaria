<?php
include '../conexion.php';

if (isset($_GET['cod_ins'])) {
    $cod_ins = $_GET['cod_ins'];

    $sql = "SELECT ins.cod_ins, ins.fecha_ins, ins.cod_inm, i.di_inm AS direccion_inmueble, ins.cod_emp, e.nom_emp AS nombre_empleado, ins.comentario
            FROM inspeccion ins
            JOIN inmuebles i ON ins.cod_inm = i.cod_inm
            JOIN empleados e ON ins.cod_emp = e.cod_emp
            WHERE ins.cod_ins = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cod_ins);
    $stmt->execute();
    $result = $stmt->get_result();
    $inspeccion = $result->fetch_assoc();

    if (!$inspeccion) {
        echo "Inspección no encontrada.";
        exit();
    }
} else {
    echo "ID de inspección no proporcionado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos.css">
    <title>Editar Inspección</title>
</head>
<body>
    <form action="actualizar_ins.php" method="post">
        <h1>Editar Inspección</h1>

        <input type="hidden" name="cod_ins" value="<?php echo $inspeccion['cod_ins']; ?>">

        <label for="fecha_ins">Fecha de inspección:</label>
        <input type="date" name="fecha_ins" value="<?php echo $inspeccion['fecha_ins']; ?>" required>

        <label for="cod_inm">Inmueble:</label>
        <select id="cod_inm" name="cod_inm" required>
            <option value="">Seleccionar inmueble</option>
            <?php
            $inmuebles = $conn->query("SELECT cod_inm, di_inm FROM inmuebles");
            while ($inm = $inmuebles->fetch_assoc()) {
                $selected = ($inm['cod_inm'] == $inspeccion['cod_inm']) ? "selected" : "";
                echo "<option value='" . $inm['cod_inm'] . "' " . $selected . ">" . htmlspecialchars($inm['di_inm']) . "</option>";
            }
            ?>
        </select>

        <label for="cod_emp">Empleado:</label>
        <select id="cod_emp" name="cod_emp" required>
            <option value="">Seleccionar empleado</option>
            <?php
            $empleados = $conn->query("SELECT cod_emp, nom_emp FROM empleados");
            while ($emp = $empleados->fetch_assoc()) {
                $selected = ($emp['cod_emp'] == $inspeccion['cod_emp']) ? "selected" : "";
                echo "<option value='" . $emp['cod_emp'] . "' " . $selected . ">" . htmlspecialchars($emp['nom_emp']) . "</option>";
            }
            ?>
        </select>

        <label for="comentario">Comentario:</label>
        <textarea name="comentario" id="comentario" cols="30" rows="10"><?php echo htmlspecialchars($inspeccion['comentario']); ?></textarea><br><br>

        <input type="submit" value="Guardar Cambios">
        <input type="button" value="Cancelar" onclick="window.location.href='consultar_ins.php'">
    </form>
</body>
</html>