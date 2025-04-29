<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMPLEADOS</title>
    <link  rel="stylesheet" href="estilos.css">
</head>
<body>

    <form action="guardar_empleado.php" method="POST">
    <h2>GESTION DE EMPLEADOS</h2>
        <label>Nombre del empleado:</label>
        <input type="text" name="nombre_empleado" required>

        <label>tipo de documento</label>
        <input type="text" name="tipo_documento">

        <label>cedula de empleado</label>
        <input type="text" name="cedula_empleado">

        <label>Email de contacto empleado:</label>
        <input type="email" name="email_empleado">

        <label>Dirección:</label>
        <input type="text" name="direccion">

        <label>Telefono de empleado:</label>
        <input type="text" name="telefono_empleado">

        <label>Fecha Nacimiento</label>
        <input type="text" name="fecha_nacimiento">

        <label>CARGO</label>
        <select name="cargo" required>
            <?php
            // Establecemos la conexión a la base de datos
            include '../CRUD_cargos/conexion.php';

            // Consulta para obtener los cargos de la base de datos
            $sql_cargos = "SELECT cod_cargo, nom_cargo FROM cargos";
            $result = $conn->query($sql_cargos);

            // Comprobamos si existen cargos y generamos las opciones
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['cod_cargo'] . "'>" . $row['nom_cargo'] . "</option>";
                }
            } else {
                echo "<option value=''>No hay cargos disponibles</option>";
            }

            // Cerramos la conexión
            $conn->close();
            ?>
        </select>


        <label>RH de empleado</label>
        <input type="text" name="rh_empleado">

        <label>SALARIO</label>
        <input type="text" name="salario">

        <label>Gastos</label>
        <input type="text" name="gastos">

        <label>Comision</label>
        <input type="text" name="comision">

        <label>Fecha de ingreso</label>
        <input type="date" name="fecha_ingreso">

        <label>Fecha retorno</label>
        <input type="date" name="fecha_retorno">

        <label> Nombre contacto</label>
        <input type="text" name="nombre_contacto">

        <label>direccion contacto</label>
        <input type="text" name="direccion_contacto">

        <label>Telefono contacto</label>
        <input type="text" name="telefono_contacto">

        <label>email Contacto</label>
        <input type="text" name="email_contacto">

        <label>Relacion contacto</label>
        <input type="text" name="relacion_contacto">

        <label>Oficina</label>
        <select name="oficina" required>

            <?php
            // Establecemos la conexión a la base de datos
            include '../CRUD_cargos/conexion.php';

            // Consulta para obtener los cargos de la base de datos
            $sql = "SELECT cod_ofi, nom_ofi FROM oficinas";
            $result = $conn->query($sql);

            // Comprobamos si existen cargos y generamos las opciones
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['cod_ofi'] . "'>" . $row['nom_cargo'] . "</option>";
                }
            } else {
                echo "<option value=''>No hay oficinas registradas</option>";
            }

            // Cerramos la conexión
            $conn->close();
            ?>
        </select>


        <label>Observaciones:</label>
        <textarea name="observaciones"></textarea>

        <input type="submit" value="Guardar Proveedor">
    </form>
</body>
</html>




