<?php
include '../conexion.php'
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propietarios</title>
    <link rel="stylesheet" href="../estilos.css">
</head>

<body>

    

    <form action="guardar_propietario.php" method="post">
     <h2>Formulario Propietario</h2>
        <label>Tipo de empresa:</label>
        
        <select name="tipo_empresa" id="tipo_empresa">
            <option value="">Selecciona</option>
            
            <?php
            $sqlEnum = "SHOW COLUMNS FROM propietarios LIKE 'tipo_empresa'";
            $resultEnum = $conn->query($sqlEnum);
            $rowEnum = $resultEnum->fetch_assoc();
            preg_match("/^enum\((.*)\)$/", $rowEnum['Type'], $matches);
            $enumValues = explode(",", $matches[1]);
            foreach ($enumValues as $value) {
                $cleanValue = trim($value, "'");
                echo "<option value='$cleanValue'>$cleanValue</option>";
            }
            ?>
            
        </select>

        <label>Tipo de documento:</label>
        <select name="tipo_doc" id="tipo_doc">
            <option value="">Selecciona</option>
            
            <?php
            $sqlEnum = "SHOW COLUMNS FROM propietarios LIKE 'tipo_doc'";
            $resultEnum = $conn->query($sqlEnum);
            $rowEnum = $resultEnum->fetch_assoc();
            preg_match("/^enum\((.*)\)$/", $rowEnum['Type'], $matches);
            $enumValues = explode(",", $matches[1]);
            foreach ($enumValues as $value) {
                $cleanValue = trim($value, "'");
                echo "<option value='$cleanValue'>$cleanValue</option>";
            }
            ?>
            
        </select>

        <label>Numero de documento:</label>
        <input type="text" name="numero_documento">

        <label>Nombre del propietario:</label>
        <input type="text" name="nombre_propietario">

        <label>Dirección:</label>
        <input type="text" name="direccion">

        <label>Telefono del propietario:</label>
        <input type="text" name="telefono_propietario">

        <label>Email del propietario:</label>
        <input type="email" name="email_propietario">

        <label>Contacto del propietario:</label>
        <input type="text" name="contacto_propietario">

        <label>Telefono contacto:</label>
        <input type="text" name="telefono_contacto">

        <label>Email contacto:</label>
        <input type="email" name="email_contacto">

        <input type="submit" value="Guardar Propietario">

        <input type="button" value="Consultar" onclick="location.href='consultar_propietario.php'">
    </form>

</body>

</html>