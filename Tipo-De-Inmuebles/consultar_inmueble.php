<?php
include '../conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Inmuebles</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
    <form action="" class="consultar">
    <h2>Inmuebles</h2>

    <table>
        <tr>
            <th>Nombre del inmueble</th>
            <th>Acciones</th>
        </tr>

        <?php
    $sql = "SELECT * FROM tipo_inmueble";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["nom_tipoinm"] . "</td>";
        echo "<td>";
        echo "<a href='editar_inmueble.php?id=" . $row["cod_tipoinm"] . "'>Editar</a> | ";
        echo "<form action='eliminar_inmueble.php'  method='post'   style='all: unset; background: none !important;color: inherit !important; box-shadow: none !important;border: none !important;margin: 0 !important; padding: 0 !important;font: inherit !important; outline: none !important;appearance: none !important; display: inline;' onsubmit='return confirm(\"¿Estás seguro de eliminar este proveedor?\");'>";
        echo "<input type='hidden' name='cod_tipoinm' value='" . $row["cod_tipoinm"] . "'>";
        echo "<button type='submit'>Eliminar</button>";
        echo "</form>";
        echo "</td>";
    }
    ?>
    </table>
    </form>
</body>
</html> 