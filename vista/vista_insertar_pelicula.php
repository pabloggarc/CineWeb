<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilosCine.css">
    <link rel="stylesheet" href="../estilos_cabecera.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        crossorigin="anonymous" />
    <link rel="icon" href="../imagenes/cineLogo.PNG" type="image/jpg">

    <script src="../js/imagen_base64.js"></script>
</head>

<body>

    <?php require_once("vista_cabecera_admin.php") ?>
    <div class="container6">
        <h2>INSERTAR PELICULA <i class="fas fa-film"></i></h2>
        <form action="../controlador/controlador_insertar_pelicula.php" method="post">
            <div class="profile-container">
                <div class="profile-info">
                    <div class="editable-field" id="name-field">
                        <label for="nombre_pelicula">Nombre de la Película:</label>
                        <input class="field-value" type="text" id="nombre_pelicula" name="nombre_pelicula"
                            pattern="([A-ZÁÉÍÓÚ0-9][a-záéíóú0-9 ]+){0,29}" required>
                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="sinopsis">Sinopsis:</label>
                        <textarea class="field-value" id="sinopsis" name="sinopsis"
                            pattern="([A-ZÁÉÍÓÚ0-9][a-záéíóú0-9A-ZÁÉÍÓÚ ]+){0,499}" required></textarea>
                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="url_web">URL Web:</label>
                        <input class="field-value" type="url" id="url_web" name="url_web" required>
                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="titulo">Título:</label>
                        <input class="field-value" type="text" id="titulo" name="titulo"
                            pattern="([A-ZÁÉÍÓÚ0-9][a-záéíóú0-9 ]+){0,29}" required>
                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="duracion">Duración:</label>
                        <input class="field-value" type="number" id="duracion" name="duracion" pattern="[1-9][0-9]*"
                            required>
                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="anno">Año:</label>
                        <input class="field-value" type="number" id="anno" name="anno" pattern="[12][0-9][0-9][0-9]"
                            required>
                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="portada">Portada:</label>
                        <input class="field-value" style='display: none' type="text" id="portada" name="portada"
                            required>
                        <button onclick="seleccionarImagen()">Seleccionar imagen</button>
                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="clasificacion">Clasificación por Edad:</label>
                        <select class="field-value" id="clasificacion" name="clasificacion">
                            <?php
                            for ($i = 0; $i < count($lista_clasificacion); $i++) {
                                echo "<option value='" . $lista_clasificacion[$i]['id'] . "'>" . $lista_clasificacion[$i]['edad'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="distribuidora">Distribuidora:</label>
                        <select class="field-value" id="distribuidora" name="distribuidora">
                            <?php
                            for ($i = 0; $i < count($lista_distribuidora); $i++) {
                                echo "<option value='" . $lista_distribuidora[$i]['id'] . "'>" . $lista_distribuidora[$i]['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="editable-field" id="name-field">
                        <label for="nacionalidad">Nacionalidad:</label>
                        <select class="field-value" id="nacionalidad" name="nacionalidad">
                            <?php
                            for ($i = 0; $i < count($lista_nacionalidad); $i++) {
                                echo "<option value='" . $lista_nacionalidad[$i]['id'] . "'>" . $lista_nacionalidad[$i]['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="editable-field" id="name-field">
                        <label for="actores">Actores:</label>
                        <select class="field-value" id="actores" name="actores[]" multiple>
                            <?php
                            for ($i = 0; $i < count($lista_actor); $i++) {
                                echo "<option value='" . $lista_actor[$i]['id'] . "'>" . $lista_actor[$i]['nombre'] . " " . $lista_actor[$i]['apellidos'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="editable-field" id="name-field">
                        <label for="director">Director:</label>
                        <select class="field-value" id="director" name="director[]" multiple>
                            <?php
                            for ($i = 0; $i < count($lista_director); $i++) {
                                echo "<option value='" . $lista_director[$i]['id'] . "'>" . $lista_director[$i]['nombre'] . " " . $lista_director[$i]['apellidos'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="editable-field" id="name-field">
                        <label for="generos">Generos:</label>
                        <select class="field-value" id="generos" name="generos[]" multiple>
                            <?php
                            for ($i = 0; $i < count($lista_genero); $i++) {
                                echo "<option value='" . $lista_genero[$i]['id'] . "'>" . $lista_genero[$i]['tipo'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Botón de envío -->
            <button type="submit">Enviar</button>
        </form>
        <form action="../controlador/controlador_admin_inicio.php" method="post">
            <button type="submit">Volver</button>
        </form>

        <form action="../controlador/controlador_botones_pelicula.php" method="post">
            <?php
            $botones = array("Actor", "Director", "Genero", "Nacionalidad", "Clasificacion", "Distribuidora");
            for ($i = 0; $i < count($botones); $i++) {
                echo "<button name='boton' value=" . $i . " type='submit'>Insertar " . $botones[$i] . "</button>";
            }
            ?>
        </form>
    </div>
</body>

</html>