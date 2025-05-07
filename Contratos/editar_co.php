<?php
include '../conexion.php';

if (isset($_GET['cod_con'])) {
    $id_contrato = $_GET['cod_con'];
    $query = "SELECT * FROM contratos WHERE cod_con = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_contrato);
    $stmt->execute();
    $result = $stmt->get_result();
    $contrato = $result->fetch_assoc();

    if (!$contrato) {
        // Handle the case where the contract ID is not found
        echo "Contrato no encontrado.";
        exit();
    }
} else {
    // Handle the case where 'cod_con' is not set in the URL
    echo "ID de contrato no proporcionado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Contrato</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
    
<form action="actualizar_co.php" enctype="multipart/form-data" method="POST">
    <h1>Editar Contrato</h1><br><br>
    <input type="hidden" name="id_contrato" value="<?php echo $contrato['cod_con']; ?>">

    <fieldset>
        <legend>Empleado</legend>
        <label>Nombre del empleado:</label>
        <select name="cod_cli" required>
            <option value="">Selecciona el empleado</option>
            <?php
            $sqlCat = "SELECT * FROM clientes";
            $resultCat = $conn->query($sqlCat);
            while ($rowCat = $resultCat->fetch_assoc()) {
                $selected = ($rowCat['cod_cli'] == $contrato['cod_cli']) ? "selected" : "";
                echo "<option value='".$rowCat['cod_cli']."' $selected>".$rowCat['nom_cli']."</option>";
            }
            ?>
        </select>
    </fieldset><br>

    <fieldset>
        <legend>Fechas</legend>
        <label>Fecha del Contrato:</label>
        <input type="date" name="fecha_con" value="<?php echo $contrato['fecha_con']; ?>"><br><br>
        <label>Fecha de inicio:</label>
        <input type="date" name="fecha_ini" value="<?php echo $contrato['fecha_ini']; ?>"><br><br>
        <label>Fecha de fin:</label>
        <input type="date" name="fecha_fin" value="<?php echo $contrato['fecha_fin']; ?>"><br><br>
    </fieldset><br>

    <fieldset>
        <legend>Detalles Financieros</legend>
        <label>Meses:</label>
        <input type="number" name="meses" value="<?php echo $contrato['meses']; ?>"><br><br>
        <label>Valor del Contrato:</label>
        <input type="number" name="valor_con" value="<?php echo $contrato['valor_con']; ?>"><br><br>
        <label>Depósito del Contrato:</label>
        <input type="number" name="deposito_con" value="<?php echo $contrato['deposito_con']; ?>"><br><br>
    </fieldset><br>

    <fieldset>
        <legend>Pago</legend>
        <label>Método de Pago:</label>
        <select name="metodo_pago_con">
            <option value="">Selecciona un método</option>
            <?php
            $sqlEnum = "SHOW COLUMNS FROM contratos LIKE 'metodo_pago_con'";
            $resultEnum = $conn->query($sqlEnum);
            $rowEnum = $resultEnum->fetch_assoc();
            preg_match("/^enum\((.*)\)$/", $rowEnum['Type'], $matches);
            $enumValues = explode(",", $matches[1]);
            foreach ($enumValues as $value) {
                $cleanValue = trim($value, "'");
                $selected = ($cleanValue == $contrato['metodo_pago_con']) ? "selected" : "";
                echo "<option value='$cleanValue' $selected>$cleanValue</option>";
            }
            ?>
        </select><br><br>

        <label>Dato de Pago:</label>
        <input type="text" name="dato_pago" value="<?php echo $contrato['dato_pago']; ?>"><br><br>
    </fieldset><br>

    <fieldset>
        <legend>Archivo</legend>
        <label>Archivo del Contrato:</label>
        <input type="file" name="archivo_con"><br><br>
        <small>Archivo actual: <?php echo $contrato['archivo_con']; ?></small>
    </fieldset><br>

    <input type="submit" value="Actualizar">
    <input type="button" value="Cancelar" onclick="location.href='consultar_con.php'">
</form>

</body>
</html>