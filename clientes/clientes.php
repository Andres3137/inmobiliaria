<?php
include '../conexion.php';

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Empleados</title>
    <link rel="stylesheet" href="../estilos.css"> <!-- Usa tu mismo CSS -->
</head>

<body>
    
    <form action="guardar_clientes.php" method="POST">
    <h2>Registro de clientes</h2>
        <label>Nombre del cliente:</label>
        <input type="text" name="nombre_cliente" required>

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

        <label>Número de documento:</label>
        <input type="text" name="cedula_cliente">

        <label>Dirección:</label>
        <input type="text" name="direccion">

        <label>Teléfono:</label>
        <input type="text" name="telefono_cliente">

        <label>Email:</label>
        <input type="email" name="email_cliente">

        <label>Tipo de inmueble: </label>
        <select name="cod_tipoinm" required>
            <option value="">Seleccione un tipo de inmueble</option>
            <?php
                // Obtener tipos de inmueble
                $sqlinmueble = "SELECT cod_tipoinm, nom_tipoinm FROM tipo_inmueble";
                $resultinmueble = $conn->query($sqlinmueble);
                while ($rowinmueble = $resultinmueble->fetch_assoc()){
                    echo "<option value='".$rowinmueble['cod_tipoinm']."'>".$rowinmueble['nom_tipoinm']."</option>";
                }
            ?>
        </select>

        <label>Valor maximo del inmueble: </label>
        <input type="number" name="valor_maximo">

        <label>Fecha de creación: </label>
        <input type="date" name="fecha_creacion">
        
        <label>Seleccione al empleado: </label>
        <select name="cod_emp">
            <option value="">seleccione al empleado a asignar...</option>
            <?php
                $sqlempleado = "SELECT cod_emp, nom_emp FROM empleados";
                $resultempleado = $conn->query($sqlempleado);
                while ($rowempleado = $resultempleado->fetch_assoc()){
                    echo "<option value='".$rowempleado['cod_emp'] . "'>" . $rowempleado['nom_emp'] . "</option>";
                }
            ?>
        </select>

        <label>Notas cliente:</label><br>
        <textarea name="notas_cli"></textarea><br>

        <input type="submit" value="Agregar cliente">
    </form>
    
    <?php


$sql = "SELECT c.*, t.nom_tipoinm, e.nom_emp
        FROM clientes c
        JOIN tipo_inmueble t ON c.cod_tipoinm = t.cod_tipoinm
        JOIN empleados e ON c.cod_emp = e.cod_emp";
$result = $conn->query($sql);
?>
<div class="tabla">
<h2>Lista de clientes</h2>
<table border="1">
    <tr>
        <th>Nombre</th>
        <th>Tipo Doc</th>
        <th>Documento</th>
        <th>Dirección</th>
        <th>Teléfono</th>
        <th>Email</th>
        <th>Tipo Inmueble</th>
        <th>Valor Máximo</th>
        <th>Fecha Creación</th>
        <th>Empleado</th>
        <th>Notas</th>
        <th>Acciones</th>
    </tr>

<?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['nom_cli'] ?></td>
        <td><?= $row['tipo_doc_cli'] ?></td>
        <td><?= $row['doc_cli'] ?></td>
        <td><?= $row['dic_cli'] ?></td>
        <td><?= $row['tel_cli'] ?></td>
        <td><?= $row['email_cli'] ?></td>
        <td><?= $row['nom_tipoinm'] ?></td>
        <td><?= $row['valor_maximo'] ?></td>
        <td><?= $row['fecha_creacion'] ?></td>
        <td><?= $row['nom_emp'] ?></td>
        <td><?= $row['notas_cli'] ?></td>
        <td>
            <a href="editar_cliente.php?cod_cli=<?= $row['cod_cli'] ?>">Editar</a> |
            <a href="eliminar_cliente.php?cod_cli=<?= $row['cod_cli'] ?>" onclick="return confirm('¿Seguro que deseas eliminar este cliente?')">Eliminar</a>
        </td>
    </tr>
<?php endwhile; ?>

</table>
</div>
</body>

</html>