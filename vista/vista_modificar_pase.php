<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Película</title>
</head>

<body>

    <form action="../controlador/controlador_update_pase.php" method="post">
        <label for="dia">Introduce un día:</label>
        <input type="date" id="dia" name="dia" value=<?php echo $info['dia'] ?> required>

        <label for="hora">Introduce una hora:</label>
        <input type="time" id="hora" name="hora" value=<?php echo $info['hora'] ?> required>

        <!-- Botón de envío -->
        <button type="submit" name="boton" value=<?php echo $info['id'] ?>>Modificar</button>
    </form>

</body>

</html>