<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inmobiliaria";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Empleados</title>
    <link rel="stylesheet" href="../estilos.css"> <!-- Usa tu mismo CSS -->
</head>

<body>
    
    <form action="guardar_empleado.php" method="POST">
    <h2>Registro de empleados</h2>
        <label>Nombre empleado:</label>
        <input type="text" name="nombre_empleado" required>

        <label>Tipo de documento:</label>
        <select name="tipo_doc" id="tipo_doc">
            <option value="">Selecciona</option>
            
            <?php
            $sqlEnum = "SHOW COLUMNS FROM empleados LIKE 'tipo_doc'";
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

        <label>Cédula:</label>
        <input type="text" name="cedula_empleado">

        <label>Email:</label>
        <input type="email" name="email_empleado">

        <label>Dirección:</label>
        <input type="text" name="direccion">

        <label>Teléfono:</label>
        <input type="text" name="telefono_empleado">

        <label>Fecha nacimiento:</label>
        <input type="date" name="fecha_nacimiento">

        <label>Cargo:</label>
        <select name="cod_cargo" required>
            <option value="">Seleccionar cargo</option>
            <?php
            $cargos = $conn->query("SELECT cod_cargo, nom_cargo FROM cargos");
            while ($cargo = $cargos->fetch_assoc()) {
                echo "<option value='" . $cargo['cod_cargo'] . "'>" . htmlspecialchars($cargo['nom_cargo']) . "</option>";
            }
            ?>
        </select>

        <label>RH:</label>
        <input type="text" name="rh_empleado">

        <label>Salario:</label>
        <input type="text" name="salario">

        <label>Gastos:</label>
        <input type="text" name="gastos">

        <label>Comisión:</label>
        <input type="text" name="comision">

        <label>Fecha de ingreso:</label>
        <input type="date" name="fecha_ingreso">

        <label>Fecha de retorno:</label>
        <input type="date" name="fecha_retorno">

        <label>Nombre contacto:</label>
        <input type="text" name="nombre_contacto">

        <label>Dirección contacto:</label>
        <input type="text" name="direccion_contacto">

        <label>Teléfono contacto:</label>
        <input type="text" name="telefono_contacto">

        <label>Email contacto:</label>
        <input type="email" name="email_contacto">

        <label>Relación contacto:</label>
        <input type="text" name="relacion_contacto">

        <label>Oficina:</label>
        <select name="cod_ofi" required>
            <option value="">Seleccionar oficina</option>
            <?php
            $oficinas = $conn->query("SELECT cod_ofi, nom_ofi FROM oficinas");
            while ($ofi = $oficinas->fetch_assoc()) {
                echo "<option value='" . $ofi['cod_ofi'] . "'>" . htmlspecialchars($ofi['nom_ofi']) . "</option>";
            }
            ?>
        </select>

        <label>Observaciones:</label><br>
        <textarea name="observaciones"></textarea><br>

        <input type="submit" value="Agregar empleado">
    </form>
    
    <form action="" class="consulta-empleado" >
    <h2>Lista de empleados</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Cargo</th>
            <th>Oficina</th>
            <th>Acciones</th>
        </tr>
        <?php
        $sql = "SELECT 
                    e.cod_emp, 
                    e.nom_emp, 
                    e.email_emp, 
                    e.tel_emp,
                    c.nom_cargo,
                    o.nom_ofi
                FROM empleados e
                LEFT JOIN cargos c ON e.cod_cargo = c.cod_cargo
                LEFT JOIN oficinas o ON e.cod_ofi = o.cod_ofi";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($emp = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($emp["nom_emp"]) . "</td>";
                echo "<td>" . htmlspecialchars($emp["email_emp"]) . "</td>";
                echo "<td>" . htmlspecialchars($emp["tel_emp"]) . "</td>";
                echo "<td>" . htmlspecialchars($emp["nom_cargo"]) . "</td>";
                echo "<td>" . htmlspecialchars($emp["nom_ofi"]) . "</td>";
                echo "<td>";
                echo '<a href="editar_empleado.php?id=' . urlencode($emp["cod_emp"]) . '">Editar</a> | ';
                echo '<form action="eliminar.php" method="post" class="boton-form" style=" all: unset;
                            background: none !important;
                            color: inherit !important;
                            box-shadow: none !important;
                            border: none !important;
                            margin: 0 !important;
                            padding: 0 !important;
                            font: inherit !important;
                            outline: none !important;
                            appearance: none !important;
                            display: inline; " onsubmit="return confirm(\'¿Estás seguro de eliminar este empleado?\');">';
                echo '<input type="hidden" name="cod_emp" value="' . htmlspecialchars($emp["cod_emp"]) . '">';
                echo '<button type="submit">Eliminar</button>';
                echo '</form>';
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No hay empleados registrados.</td></tr>";
        }

        $conn->close();
        ?>
    </table>
    </form>
    
</body>

</html>
