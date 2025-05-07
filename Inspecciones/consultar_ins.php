<?php
include '../conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos.css">
    <title>Consultar Inspecciones</title>
</head>
<body>
    <div class="tabla-container">
        <h2>Listado de Inspecciones</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Inspección</th>
                    <th>Fecha de Inspección</th>
                    <th>Inmueble</th>
                    <th>Empleado</th>
                    <th>Comentario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT 
                            ins.cod_ins,
                            ins.fecha_ins,
                            i.di_inm AS direccion_inmueble,
                            e.nom_emp AS nombre_empleado,
                            ins.comentario
                        FROM 
                            inspeccion ins
                        JOIN 
                            inmuebles i ON ins.cod_inm = i.cod_inm
                        JOIN 
                            empleados e ON ins.cod_emp = e.cod_emp";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["cod_ins"] . "</td>";
                        echo "<td>" . $row["fecha_ins"] . "</td>";
                        echo "<td>" . htmlspecialchars($row["direccion_inmueble"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["nombre_empleado"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["comentario"]) . "</td>";
                        echo "<td>";
                        echo "<a href='editar_ins.php?cod_ins=" . $row["cod_ins"] . "'>Editar</a> | ";
                        echo "<a href='eliminar_ins.php?cod_ins=" . $row["cod_ins"] . "' onclick='return confirm(\"¿Estás seguro de eliminar esta inspección?\");'>Eliminar</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No se encontraron inspecciones registradas.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
    </div>
</body>
</html>