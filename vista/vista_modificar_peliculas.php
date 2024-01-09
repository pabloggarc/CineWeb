<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Película</title>
    <link rel="stylesheet" href="../estilosCine.css">
    <link rel="stylesheet" href="../estilos_cabecera.css">
</head>

<body>

    <?php require_once("vista_cabecera_admin.php") ?>

    <form action="../controlador/controlador_update_pelicula.php" method="post">
        <div class="profile-container">
            <div class="profile-info">
                <div class="editable-field" id="name-field">
                    <label for="nombre_pelicula">Nombre de la Película:</label>
                    <input class="field-value" type="text" id="nombre_pelicula" value=<?php echo $info['nombre'] ?>
                        name="nombre_pelicula" required>
                </div>
                <div class="editable-field" id="name-field">
                    <label for="sinopsis">Sinopsis:</label>
                    <input class="field-value" type="text" id="sinopsis" name="sinopsis" value=<?php echo $info['sinopsis'] ?> required></textarea>
                </div>
                <div class="editable-field" id="name-field">
                    <label for="url_web">URL Web:</label>
                    <input class="field-value" type="url" id="url_web" name="url_web" value=<?php echo $info['web'] ?>
                        required>

                </div>
                <div class="editable-field" id="name-field">
                    <label for="titulo">Título:</label>
                    <input class="field-value" type="text" id="titulo" name="titulo" value=<?php echo $info['titulo'] ?>
                        required>
                </div>
                <div class="editable-field" id="name-field">
                    <label for="duracion">Duración:</label>
                    <input class="field-value" type="text" id="duracion" name="duracion" value=<?php echo $info['duracion'] ?> required>
                </div>
                <div class="editable-field" id="name-field">
                    <label for="anno">Año:</label>
                    <input class="field-value" type="number" id="anno" name="anno" value=<?php echo $info['año'] ?>
                        required>

                </div>
                <div class="editable-field" id="name-field">
                    <label for="portada">Portada:</label>
                    <input class="field-value" type="text" id="portada" name="portada" value=<?php echo $info['portada'] ?> required>
                </div>
                <div class="editable-field" id="name-field">
                    <label for="clasificacion">Clasificación por Edad:</label>
                    <select class="field-value" id="clasificacion" name="clasificacion">
                        <?php
                        for ($i = 0; $i < count($lista_clasificacion); $i++) {
                            $selected = ($lista_clasificacion[$i]['id'] == $info['id_clasificacion']) ? 'selected' : '';
                            echo "<option value='" . $lista_clasificacion[$i]['id'] . "' " . $selected . ">" . $lista_clasificacion[$i]['edad'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="editable-field" id="name-field">
                    <label for="distribuidora">Distribuidora:</label>
                    <select class="field-value" id="distribuidora" name="distribuidora">
                        <?php
                        for ($i = 0; $i < count($lista_distribuidora); $i++) {
                            $selected = ($lista_distribuidora[$i]['id'] == $info['id_distribuidora']) ? 'selected' : '';
                            echo "<option value='" . $lista_distribuidora[$i]['id'] . "' " . $selected . ">" . $lista_distribuidora[$i]['nombre'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <!-- Botón de envío -->
        <button type="submit">Enviar</button>
    </form>
</body>

</html>