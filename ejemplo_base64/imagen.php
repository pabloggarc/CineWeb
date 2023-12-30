<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Imagen</title>
</head>
<body>
    <h1>Imagen Cargada</h1>

    <?php
    if (isset($_POST['imagen'])) {
        // Obtiene la imagen base64 desde la solicitud POST
        $base64Image = $_POST['imagen'];

        // Muestra la imagen usando la URL de datos (data URL)
        echo '<img src="' . $base64Image . '" alt="Imagen Cargada">';
    } else {
        echo 'Error al procesar la imagen.';
    }
    ?>
</body>
</html>
