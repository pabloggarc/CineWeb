<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Título de la Página</title>
        <link rel="stylesheet" href="estilos.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="script.js"></script>
    </head>
    <body>
        <?php
            session_start();
            require_once("config.php");
            require_once("modelo/Datos.php");
            require_once("controlador/controlador_butacas.php");
        ?>
    </body>
</html>