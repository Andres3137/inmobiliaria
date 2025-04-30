<?php
include ("conexion.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Inmuebles</title>
</head>
<body>
    <h2>Inmuebles</h2>
    <table>
        <tr>
            <th>Nombre del inmueble</th>
            
        </tr>

        <?php
    $sql = "SELECT * FROM tipo_inmueble";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["nom_tipoinm"] . "</td>";
        echo "<td>";
        echo "<a href='editar_inmueble.php?id=" . $row["cod_tipoinm"] . "'>Editar</a> | ";
        echo "<form action='eliminar_inmueble.php' method='post' style='display:inline;' onsubmit='return confirm(\"¿Estás seguro de eliminar este proveedor?\");'>";
        echo "<input type='hidden' name='cod_tipoinm' value='" . $row["cod_tipoinm"] . "'>";
        echo "<button type='submit'>Eliminar</button>";
        echo "</form>";
        echo "</td>";
    }
    ?>
    </table>
</body>
</html> 