<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Película</title>
</head>

<body>

<?php require_once("vista_cabecera.php") ?>

    <form action="../controlador/controlador_insertar_pase.php" method="post">
        <label for="dia">Introduce un día:</label>
        <input type="date" id="dia" name="dia" required>

        <label for="hora">Introduce una hora:</label>
        <input type="time" id="hora" name="hora" required>

        <!-- Botón de envío -->
        <button type="submit">Enviar</button>
    </form>

</body>

</html>