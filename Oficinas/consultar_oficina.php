<?php 
include '../conexion.php';
$sql = "SELECT * FROM oficinas";
$result = $conn->query($sql);

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
    
    <table>
    
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Ubicaion</th>
                <th>Foto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if ($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {?>
                    <tr>
                        <td><?php echo $row['cod_ofi'];?></td>
                        <td><?php echo $row['nom_ofi'];?></td>
                        <td><?php echo $row['dic_ofi'];?></td>
                        <td><?php echo $row['tel_ofi'];?></td>
                        <td><?php echo $row['email_ofi'];?></td>
                        <td>
                            <a href="https://www.google.com/maps/search/?api=1&query=<?php echo $row['latitud'];?>, <?php echo $row['longitud'];?>" target="_blank">Ver en maps</a>
                        </td>
                        <td>
                            <?php if ($row['foto_ofi']){ ?>
                                <img src="<?php echo $row['foto_ofi'];?>" alt="Foto del Almacen" width="100" height="100" />
                            <?php } else{ ?>
                                Sin foto

                            <?php } ?>
                        </td>
                       <td><a href="">eliminar</a>
                        </td>
                    </tr>
                <?php }
            }else{ ?>
                <tr>
                    <td colspan="5">No hay almacenes registrados</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="oficina_crud.php">Volver</a>
</body>
</html>
<?php $conn->close(); ?>