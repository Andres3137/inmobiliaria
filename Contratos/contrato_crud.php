<?php
include '../conexion.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
    
<form action="insertar_contrato.php" enctype="multipart/form-data" method="POST">
    <h1>Contratos</h1><br><br>

    <fieldset>
        <legend>Empleado</legend>
        <label>Nombre del empleado:</label>
        <select name="cod_cli" required>
            <option value="">Selecciona el empleado</option>
            <?php
            $sqlCat = "SELECT * FROM clientes";
            $resultCat = $conn->query($sqlCat);
            while ($rowCat = $resultCat->fetch_assoc()) {
                echo "<option value='".$rowCat['cod_cli']."'>".$rowCat['nom_cli']."</option>";
            }
            ?>
        </select>
    </fieldset><br>

    <fieldset>
        <legend>Fechas</legend>
        <label>Fecha del Contrato:</label>
        <input type="date" name="fecha_contrato"><br><br>
        <label>Fecha de inicio:</label>
        <input type="date" name="fecha_inicio"><br><br>
        <label>Fecha de fin:</label>
        <input type="date" name="fecha_fin"><br><br>
    </fieldset><br>

    <fieldset>
        <legend>Detalles Financieros</legend>
        <label>Meses:</label>
        <input type="number" name="meses"><br><br>
        <label>Valor del Contrato:</label>
        <input type="number" name="valor_contrato"><br><br>
        <label>Depósito del Contrato:</label>
        <input type="number" name="deposito_contrato"><br><br>
    </fieldset><br>

    <fieldset>
        <legend>Pago</legend>
        <label>Método de Pago:</label>
        <select name="metodo_pago">
            <option value="">Selecciona un método</option>
            <?php
            $sqlEnum = "SHOW COLUMNS FROM contratos LIKE 'metodo_pago_con'";
            $resultEnum = $conn->query($sqlEnum);
            $rowEnum = $resultEnum->fetch_assoc();
            preg_match("/^enum\((.*)\)$/", $rowEnum['Type'], $matches);
            $enumValues = explode(",", $matches[1]);
            foreach ($enumValues as $value) {
                $cleanValue = trim($value, "'");
                echo "<option value='$cleanValue'>$cleanValue</option>";
            }
            ?>
        </select><br><br>

        <label>Dato de Pago:</label>
        <input type="text" name="dato_pago"><br><br>
    </fieldset><br>

    <fieldset>
        <legend>Archivo</legend>
        <label>Archivo del Contrato:</label>
        <input type="file" name="archivo_co"><br><br>
    </fieldset><br>

    <input type="submit" value="Enviar">
    <input type="reset" value="Limpiar">
    <input type="button" value="Consultar" onclick="location.href='consultar_con.php'">
</form>

</body>
</html>