<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Sala</title>
</head>

<body>

<?php require_once("vista_cabecera.php") ?>

    <form action="../controlador/controlador_update_sala.php" method="post">
        <label for="nombre_sala">Nombre de la Sala:</label>
        <input type="text" id="nombre_sala" name="nombre_sala" value=<?php echo $info['nombre'] ?> pattern="[a-zA-Z0-9]{0,19}" required>

        <label for="numero_filas">Número de filas:</label>
        <input type="text" id="n_filas" name="n_filas" value=<?php echo $info['filas'] ?> pattern="[0-9]+" required>

        <label for="numero_columnas">Número de columnas:</label>
        <input type="text" id="n_col" name="n_col" value=<?php echo $info['columnas'] ?> pattern="[0-9]+" required>

        <!-- Botón de envío -->
        <button type="submit" name="boton" value=<?php echo $info['id'] ?>>Enviar</button>
    </form>

</body>

</html>