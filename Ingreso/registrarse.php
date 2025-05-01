<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/estilo.css">
</head>
<body>
<form id="form" name="form" method="post">
        <fieldset>
            <h2>Registrarse</h2>
            <input type="text" name="nombre_usuario" id="nombre_usuario" placeholder="Crear Usuario" required><br><br>
            <input type="password" name="pass_usuario" id="pass_usuario" placeholder="Crear Una Contraseña" required><br><br>
            <input type="button" value="Registrarse" id="iniciar_seccion" name="iniciar_seccion" onclick="document.form.action='login.php';document.form.submit()"/>
        </fieldset>
    </form>
</body>
</html>