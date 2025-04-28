<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitas</title>
</head>

<body>
    <h2>Registro de visitas</h2>
    <form action="agregar_visita.php" method="POST">

        <label for="fecha_vis">Fecha de visita:</label>
        <input type="date" name="fecha_vis" required><br>

        <label for="cod_cli">Cliente:</label>
        <select id="cod_cli" name="cod_cli" required>
            <option value="">Seleccionar cliente</option>
        </select>

        <label for="cod_emp">Empleado:</label>
        <select id="cod_emp" name="cod_emp" required>
            <option value="">Seleccionar empleado</option>
        </select>

        <label for="cod_inm">Inmueble:</label>
        <select id="cod_inm" name="cod_inm" required>
            <option value="">Seleccionar inmueble</option>
        </select>

        <label for="comenta_vis">Comentarios:</label><br>
        <textarea name="comenta_vis" rows="4"></textarea><br>

        <input type="submit" value="Agregar">
        <input type="submit" value="eliminar">
        <input type="submit" value="Actualizar">
        <input type="submit" value="editar ">


    </form>

    <script>
        function llenarSelect(selectId, url) {
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const selectElement = document.getElementById(selectId);
                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item[Object.keys(item)[0]]; // Asume que la primera clave es el ID
                        option.textContent = item[Object.keys(item)[1]]; // Asume que la segunda clave es el nombre
                        selectElement.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error al obtener los datos:', error);
                });
        }

        // Llenar los selects al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            llenarSelect('cod_cli', 'obtener_clientes.php');
            llenarSelect('cod_emp', 'obtener_empleados.php');
            llenarSelect('cod_inm', 'obtener_inmuebles.php');
        });
    </script>
</body>

</html>