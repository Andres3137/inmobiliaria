<?php
include '../conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Propietario</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
<div class="tabla-container">
    <table>
    <h2>Propietarios</h2>
        <tr>
            <th>Tipo de empresa</th>
            <th>Tipo de documento</th>
            <th>Numero de documento</th>
            <th>Nombre del propietario</th>
            <th>Dirección del propietario</th>
            <th>Telefono del propietario</th>
            <th>Email del propietario</th>
            <th>Contacto del propietario</th>
            <th>Telefono contacto</th>
            <th>Email contacto</th>
            <th>Acciones</th>
        </tr>

        <?php
    $sql = "SELECT * FROM propietarios";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["tipo_empresa"] . "</td>";
        echo "<td>" . $row["tipo_doc"] . "</td>";
        echo "<td>" . $row["num_doc"] . "</td>";
        echo "<td>" . $row["nomb_propietario"] . "</td>";
        echo "<td>" . $row["dic_propietario"] . "</td>";
        echo "<td>" . $row["tel_propietario"] . "</td>";
        echo "<td>" . $row["email_propietario"] . "</td>";
        echo "<td>" . $row["contacto_prop"] . "</td>";
        echo "<td>" . $row["tel_contacto"] . "</td>";
        echo "<td>" . $row["email_contacto"] . "</td>";
        echo "<td>";
        echo "<a href='editar_propietario.php?id=" . $row["cod_propietarios"] . "'>Editar</a> | ";
        echo "<a href='eliminar_propietario.php?cod_propietarios=" . $row["cod_propietarios"] . "' onclick='return confirm(\"¿Estás seguro de eliminar este proveedor?\");'>Eliminar</a>";
        echo "</td>";
        echo "</tr>";
    }
    ?>
    </table>
</div>
</body>
</html>