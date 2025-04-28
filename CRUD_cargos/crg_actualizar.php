<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACTUALIZAR CARGO</title>
</head>
<body>
    <form action="actualizar.php" method="post" name="form">
        <label for="nom_cargo">CARGO  ACTUALIZAR</label>
        <select name="nom_cargo" required>
            <option value="">Seleccione un cargo</option>
            <?php
            include 'conexion.php';
            $sql = "SELECT nom_cargo FROM cargos";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["nom_cargo"] . "'>" . $row["nom_cargo"] . "</option>";
                }
            } else {
                echo "<option value=''>No hay cargos disponibles</option>";
            }
            $conn->close();
            ?>
        </select>
        <input type="text" name="nuevo_cargo" placeholder="Nuevo nombre del cargo" required>
        <button type="submit" name="actualizar">Actualizar Cargo</button>  
    </form>
</body>
</html>