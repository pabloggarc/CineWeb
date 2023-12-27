<!DOCTYPE html>
<html>
    <head>
        <title>Título de prueba</title>
    </head>
    <body>
        <?php
            foreach ($pruebas as $prueba) {
                echo $prueba["id"] . " " . $prueba["nombre"] . "<br>";
            }
        ?>
    </body>
</html>