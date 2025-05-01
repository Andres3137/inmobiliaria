<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/estilo.css">
</head>
<body>
    <form id="form" name="form" method="post" action="update_user.php">
        <fieldset>
            <h2>Iniciar Sesion</h2>
            <input type="text" name="nombre_usuario" id="nombre_usuario" placeholder="Usuario" required><br><br>
            <input type="password" name="pass_usuario" id="pass_usuario" placeholder="Contraseña" required><br><br>
            <input type="button" value="Iniciar Sesion" id="iniciar_sesion" name="iniciar_sesion" onclick="document.form.action='login_update.php';document.form.submit()"/>
            <input type="button" value="Registrate Aqui"registrar" name="registrar" onclick="document.form.action='registrarse.php';document.form.submit()"/>

        </fieldset>
    </form>
</body>
</html>


