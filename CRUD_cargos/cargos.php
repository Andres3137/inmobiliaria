<?php
include '../conexion.php';

$sql = "SELECT * FROM cargos";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD DE CARGOS   </title>
    <link rel="stylesheet" href="../estilos.css">
    <style>
        table{
            margin-top: 35px;
        }
    </style>
</head>
<body>
<form id="form" method="post" name="form">
        <fieldset>
            <legend>DATOS DEL CARGO</legend>
            <label>DIGITE NOMBRE DEL CARGO <input type="text" name="nom_cargo" placeholder="XXXXX" size="40"
                    maxlength="15" tabindex="1" autofocus></label><br><br>
        </fieldset>
        <input type="button" value="Insertar datos" id="nuevo" name="nuevo" onclick="document.form.action='insertar.php';
            document.form.submit()" />
        <input type="button" value="Eliminar datos" id="eliminar" name="eliminar" onclick="document.form.action='eliminar.php';
            document.form.submit()" />
        <input type="button" value="Actualiza" id="actualiza" name="actualiza" onclick="document.form.action='crg_actualizar.php';
            document.form.submit()" />
    <table>
        <thead>
            <th>ID</th>
            <th>Nombre del Cargo</th>
            </thead>
            <tbody>
            <?php if ($result -> num_rows > 0) {
                while ($row = $result -> fetch_assoc()) {?>
                    <tr>
                        <td><?php echo $row['cod_cargo']; ?></td>
                        <td><?php echo $row['nom_cargo']; ?></td>
                    </tr>
                <?php } 
                
                }?>
            </tbody>
    </table>
    </form>
</body>
</html>