<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Película</title>
</head>

<body>
<?php require_once("vista_cabecera.php") ?>


    <form action="../controlador/controlador_insertar_sesion.php" method="post">
        <label for="Sala">Selecciona sala:</label>
        <select id="sala" name="sala">
            <?php
            for ($i = 0; $i < count($lista_salas); $i++) {
                echo "<option value='" . $lista_salas[$i]['id'] . "'>" . $lista_salas[$i]['nombre'] . "</option>";
            }
            ?>
        </select>

        <label for="Pelicula">Selecciona pelicula:</label>
        <select id="pelicula" name="pelicula">
            <?php
            for ($i = 0; $i < count($lista_peliculas); $i++) {
                echo "<option value='" . $lista_peliculas[$i]['id'] . "'>" . $lista_peliculas[$i]['nombre'] . "</option>";
            }
            ?>
        </select>

        <label for="Pase">Selecciona pase:</label>
        <select id="pase" name="pase">
            <?php
            for ($i = 0; $i < count($lista_pases); $i++) {
                echo "<option value='" . $lista_pases[$i]['id'] . "'>" . $lista_pases[$i]['fecha'] . "</option>";
            }
            ?>
        </select>

        <!-- Botón de envío -->
        <button type="submit">Enviar</button>
    </form>
</body>

</html>