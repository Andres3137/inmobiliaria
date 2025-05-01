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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Proveedores</title>
    <link rel="stylesheet" href="../estilos.css">
</head>

<body>
    
    <form action="agregar_visita.php" method="POST">
    <h2>Registro de visitas</h2>
        <label>fecha de visita:</label>
        <input type="date" name="fecha_vis" required>

        <label for="cod_cli">Cliente:</label>
        <select id="cod_cli" name="cod_cli" required>
            <option value="">Seleccionar cliente</option>
            <?php
            $clientes = $conn->query("SELECT cod_cli, nom_cli FROM clientes");
            while ($cli = $clientes->fetch_assoc()) {
                echo "<option value='" . $cli['cod_cli'] . "'>" . htmlspecialchars($cli['nom_cli']) . "</option>";
            }
            ?>

        </select>

        <label for="cod_emp">Empleado:</label>
        <select id="cod_emp" name="cod_emp" required>
            <option value="">Seleccionar empleado</option>
            <?php
            $empleados = $conn->query("SELECT cod_emp, nom_emp FROM empleados");
            while ($emp = $empleados->fetch_assoc()) {
                echo "<option value='" . $emp['cod_emp'] . "'>" . htmlspecialchars($emp['nom_emp']) . "</option>";
            }
            ?>

        </select>

        <label for="cod_inm">Inmueble:</label>
        <select id="cod_inm" name="cod_inm" required>
            <option value="">Seleccionar inmueble</option>
            <?php
            $inmuebles = $conn->query("SELECT cod_inm, di_inm FROM inmuebles");
            while ($inm = $inmuebles->fetch_assoc()) {
                echo "<option value='" . $inm['cod_inm'] . "'>" . htmlspecialchars($inm['di_inm']) . "</option>";
            }
            ?>

        </select>


        <label for="comenta_vis">Comentarios:</label><br>
        <textarea name="comenta_vis" rows="4"></textarea><br>

        <input type="submit" value="Agregar">

    </form>

    <form action="" class="consulta-visitas">
    <h2>Lista de visitas</h2>
    <table>
        <tr>
            <th>Fecha visita</th>
            <th>Cliente</th>
            <th>Empleado</th>
            <th>Inmueble (Dirección)</th>
            <th>Comentarios</th>
            <th>Acciones</th>
        </tr>
        <?php
        // Asegúrate de que la conexión $conn esté abierta aquí
        
        $sql = "SELECT 
                visitas.cod_vis,
                visitas.fecha_vis,
                clientes.nom_cli,
                empleados.nom_emp,
                inmuebles.di_inm,
                visitas.comenta_vis
            FROM visitas
            INNER JOIN clientes ON visitas.cod_cli = clientes.cod_cli
            INNER JOIN empleados ON visitas.cod_emp = empleados.cod_emp
            INNER JOIN inmuebles ON visitas.cod_inm = inmuebles.cod_inm";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["fecha_vis"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["nom_cli"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["nom_emp"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["di_inm"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["comenta_vis"]) . "</td>";
                echo "<td>";
                echo '<a href="editar_visita.php?id=' . urlencode($row["cod_vis"]) . '">Editar</a> | ';
                echo '<form action="eliminar_visita.php" method="post" style="display:inline;" onsubmit="return confirm(\'¿Estás seguro de eliminar esta visita?\');">';
                echo '<input type="hidden" name="cod_vis" value="' . htmlspecialchars($row["cod_vis"]) . '">';
                echo '<button type="submit">Eliminar</button>';
                echo '</form>';
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No hay visitas registradas.</td></tr>";
        }

        // Cerrar conexión
        $conn->close();
        ?>
    </table>
    </form>
</body>

</html>