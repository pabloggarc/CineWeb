<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Película</title>
</head>

<body>

    <form action="../controlador/controlador_update_sesion.php" method="post">
        <label for="Sala">Selecciona sala:</label>
        <select id="sala" name="sala">
            <?php
            for ($i = 0; $i < count($lista_salas); $i++) {
                $selected = ($lista_salas[$i]['id'] == $sesion['id_sala']) ? 'selected' : '';
                echo "<option value='" . $lista_salas[$i]['id'] . "' " . $selected . ">" . $lista_salas[$i]['nombre'] . "</option>";
            }
            ?>
        </select>

        <label for="Pelicula">Selecciona pelicula:</label>
        <select id="pelicula" name="pelicula">
            <?php
            for ($i = 0; $i < count($lista_peliculas); $i++) {
                $selected = ($lista_peliculas[$i]['id'] == $sesion['id_pelicula']) ? 'selected' : '';
                echo "<option value='" . $lista_peliculas[$i]['id'] . "' " . $selected . ">" . $lista_peliculas[$i]['nombre'] . "</option>";
            }
            ?>
        </select>

        <label for="Pase">Selecciona pase:</label>
        <select id="pase" name="pase">
            <?php
            for ($i = 0; $i < count($lista_pases); $i++) {
                $selected = ($lista_pases[$i]['id'] == $sesion['id_pase']) ? 'selected' : '';
                echo "<option value='" . $lista_pases[$i]['id'] . "' " . $selected . ">" . $lista_pases[$i]['fecha'] . "</option>";
            }
            ?>
        </select>

        <!-- Botón de envío -->
        <?php
        $valor = $sesion['id_sala'] . ";" . $sesion['id_pelicula'] . ";" . $sesion['id_pase'];
        echo "<td><button type='submit' name='boton' value='" . $valor . "''>MODIFICAR</button></td>";
        ?>
    </form>
</body>

</html>