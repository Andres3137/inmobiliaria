<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
    
<div class="tabla-container">
<h1>Consultar Contrato</h1>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Codigo</th>
            <th>Nombre del Cliente</th>
            <th>Fecha del Contrato</th>
            <th>Fecha de Inicio</th>
            <th>Fecha de Fin</th>
            <th>Meses</th>
            <th>Valor del Contrato</th>
            <th>Deposito del Contrato</th>
            <th>Metodo de Pago</th>
            <th>Dato de Pago</th>
            <th>Archivo del Contrato</th>
            <th>Acciones</th>
        </tr>

        <?php
        include '../conexion.php';

        $sql = "SELECT c.cod_con, cl.nom_cli, c.fecha_con, c.fecha_ini, c.fecha_fin, c.meses, c.valor_con, c.deposito_con, c.metodo_pago_con, c.dato_pago, c.archivo_con FROM contratos c JOIN clientes cl ON c.cod_cli = cl.cod_cli";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['cod_con'] . "</td>";
                echo "<td>" . $row['nom_cli'] . "</td>";
                echo "<td>" . $row['fecha_con'] . "</td>";
                echo "<td>" . $row['fecha_ini'] . "</td>";
                echo "<td>" . $row['fecha_fin'] . "</td>";
                echo "<td>" . $row['meses'] . "</td>";
                echo "<td>" . $row['valor_con'] . "</td>";
                echo "<td>" . $row['deposito_con'] . "</td>";
                echo "<td>" . $row['metodo_pago_con'] . "</td>";
                echo "<td>" . $row['dato_pago'] . "</td>";
                echo "<td><a href='" . $row['archivo_con'] . "' target='_blank'>Ver Archivo</a></td>";
                echo '<td>';
                echo '<a href="editar_co.php?cod_con=' . $row['cod_con'] . '">Editar</a> | ';
                echo '<a href="eliminar_co.php?cod_con=' . $row['cod_con'] . '" onclick="return confirm(\'¿Seguro que deseas eliminar este contrato?\')">Eliminar</a>';
                echo '</td>';
                echo "</tr>";

            }
        } else {
            echo "<tr><td colspan='11'>No se encontraron contratos.</td></tr>";
        }

        $conn->close();
        ?>
        <br><br>
        <a href="contrato_crud.php">Volver</a>
    </table>
</div>
</body>
</html>