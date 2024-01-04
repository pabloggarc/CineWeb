<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Película</title>
</head>

<body>

    <form action="../controlador/controlador_update_pelicula.php" method="post">
        <label for="nombre_pelicula">Nombre de la Película:</label>
        <input type="text" id="nombre_pelicula" value=<?php echo $info['nombre'] ?> name="nombre_pelicula" required>

        <label for="sinopsis">Sinopsis:</label>
        <input type="text" id="sinopsis" name="sinopsis" value=<?php echo $info['sinopsis'] ?> required></textarea>

        <label for="url_web">URL Web:</label>
        <input type="url" id="url_web" name="url_web" value=<?php echo $info['web'] ?> required>

        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value=<?php echo $info['titulo'] ?> required>

        <label for="duracion">Duración:</label>
        <input type="text" id="duracion" name="duracion" value=<?php echo $info['duracion'] ?> required>

        <label for="anno">Año:</label>
        <input type="number" id="anno" name="anno" value=<?php echo $info['año'] ?> required>

        <label for="portada">Portada:</label>
        <!--<input type="file" id="portada" name="portada" accept="image/*" required>-->
        <input type="text" id="portada" name="portada" value=<?php echo $info['portada'] ?> required>


        <label for="clasificacion">Clasificación por Edad:</label>
        <select id="clasificacion" name="clasificacion">
            <?php
            for ($i = 0; $i < count($lista_clasificacion); $i++) {
                $selected = ($lista_clasificacion[$i]['id'] == $info['id_clasificacion']) ? 'selected' : '';
                echo "<option value='" . $lista_clasificacion[$i]['id'] . "' " . $selected . ">" . $lista_clasificacion[$i]['edad'] . "</option>";
            }
            ?>
        </select>

        <label for="distribuidora">Distribuidora:</label>
        <select id="distribuidora" name="distribuidora">
            <?php
            for ($i = 0; $i < count($lista_distribuidora); $i++) {
                $selected = ($lista_distribuidora[$i]['id'] == $info['id_distribuidora']) ? 'selected' : '';
                echo "<option value='" . $lista_distribuidora[$i]['id'] . "' " . $selected . ">" . $lista_distribuidora[$i]['nombre'] . "</option>";
            }
            ?>
        </select>

        <!-- Botón de envío -->
        <button type="submit">Enviar</button>
    </form>
</body>

</html>