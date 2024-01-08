<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
</head>

<body>

    <h2>Editar usuario</h2>

    <form action="../controlador/controlador_editar_usuario.php" method="post">
        <label for="nick">Nick:</label>
        <input type="text" id="nick" name="nick" value="<?php echo $info['nick'] ?>" required><br><br>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $info['fecha_nacimiento'] ?>" required><br><br>

        <label for="correo">Correo electrónico:</label>
        <input type="email" id="correo" name="correo" value="<?php echo $info['correo'] ?>" required><br><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $info['nombre'] ?>" required><br><br>

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" value="<?php echo $info['apellidos'] ?>" required><br><br>

        <input type="submit" value="Enviar">
    </form>

</body>

</html>