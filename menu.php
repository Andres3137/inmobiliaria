<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Navegación</title>
    <link rel="stylesheet" href="estilos.css">

</head>
<body>
<fieldset class="menu-navegacion">
    <legend>Menú</legend>
    <h1>Menú de navegación</h1>

    <div class="botones-menu">
        <input type="button" value="Oficinas" id="oficinas"
        onclick="location.href='Oficinas/oficina_crud.php'"><br>

        <input type="button" value="Cargos" id="cargos" onclick="location.href='CRUD_cargos/cargos.php'"><br>

        <input type="button" value="Empleados" id="empleados" onclick="location.href='CRUD_empleados/empleados.php'"><br>

        <input type="button" value="Clientes" id="clientes" onclick="location.href='clientes/clientes.php'"><br>

        <input type="button" value="Inmuebles" id="inmuebles" onclick="location.href='Inmuebles/inmueble_crud.php'" ><br>

        <input type="button" value="Tipo de inmuebles" id="tipo_inmuebles" onclick="location.href='Tipo-De-Inmuebles/tipo_inmueble_crud.php'"><br>
        
        <input type="button" value="Propietarios" id="propietarios" onclick="location.href='Propietarios/propietario_crud.php'"><br>

        <input type="button" value="Contratos" id="contratos" onclick="location.href='Contratos/contrato_crud.php'"><br>

        <input type="button" value="Visitas" id="visitas" onclick="location.href='Visitas/visita_crud.php'"><br>

        <input type="button" value="Inspecciones" id="inspecciones" onclick="location.href='Inspecciones/inspeccion_crud.php'">
    </div>
</fieldset>

</body>
</html>
