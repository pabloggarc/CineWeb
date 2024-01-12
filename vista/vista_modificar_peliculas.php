<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MODIFICAR PELICULA</title>
    <link rel="stylesheet" href="../css/estilosCine.css">
    <link rel="stylesheet" href="../css/estilos_cabecera.css">
    <script src="../js/imagen_base64.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        crossorigin="anonymous" />
    <link rel="icon" href="../imagenes/cineLogo.PNG" type="image/jpg">

</head>

<body>
    <?php
    if (!(isset($_SESSION['rol_usuario'])) || $_SESSION['rol_usuario'] == 1) {
        header("Location: ../vista/vista_login.php");
    }
    ?>
    <?php require_once("vista_cabecera_admin.php") ?>

    <div class="container5">
        <h2>MODIFICAR PELICULA <i class="fas fa-film"></i></h2>
        <form action="../controlador/controlador_update_pelicula.php" method="post">
            <div class="profile-container">
                <div class="profile-info">
                    <div class="editable-field" id="name-field">
                        <label for="nombre_pelicula">Nombre de la Película:</label>
                        <input class="field-value" type="text" id="nombre_pelicula"
                            value="<?php echo $info['nombre'] ?>" name="nombre_pelicula" pattern="^[A-Z].{0,29}$"
                            required>
                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="sinopsis">Sinopsis:</label>
                        <input class="field-value" type="text" id="sinopsis" name="sinopsis"
                            value="<?php echo $info['sinopsis'] ?>" pattern="^[A-Z].{0,499}$" required>
                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="url_web">URL Web:</label>
                        <input class="field-value" type="url" id="url_web" name="url_web"
                            value="<?php echo $info['web'] ?>" required>

                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="titulo">Título:</label>
                        <input class="field-value" type="text" id="titulo" name="titulo"
                            value="<?php echo $info['titulo'] ?>" pattern="^[A-Z].{0,29}$" required>
                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="duracion">Duración:</label>
                        <input class="field-value" type="text" id="duracion" name="duracion"
                            value="<?php echo $info['duracion'] ?>" pattern="[1-9][0-9]*" required>
                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="anno">Año:</label>
                        <input class="field-value" type="number" id="anno" name="anno" value=<?php echo $info['año'] ?>
                            pattern="[12][0-9][0-9][0-9]" required>

                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="portada">Portada:</label>
                        <input class="field-value" style='display: none' type="text" id="portada" name="portada"
                            value=<?php echo $info['portada'] ?> required>
                        <button onclick="seleccionarImagen()">Seleccionar imagen</button>
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

                    <div class="editable-field" id="name-field">
                        <label for="nacionalidad">Nacionalidad:</label>
                        <select class="field-value" id="nacionalidad" name="nacionalidad">
                            <?php
                            for ($i = 0; $i < count($lista_nacionalidad); $i++) {
                                $selected = ($lista_nacionalidad[$i]['id'] == $info_nacionalidad[0]['id_nacionalidad']) ? 'selected' : '';
                                echo "<option value='" . $lista_nacionalidad[$i]['id'] . "' " . $selected . " >" . $lista_nacionalidad[$i]['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="editable-field" id="name-field">
                        <label for="actores">Actores:</label>
                        <select class="field-value2" id="actores" name="actores[]" multiple>
                            <?php
                            for ($i = 0; $i < count($lista_actor); $i++) {
                                foreach ($info_actores as $j) {
                                    if ($lista_actor[$i]['id'] == $j['id_actor']) {
                                        $selected = 'selected';
                                        break;
                                    } else {
                                        $selected = '';
                                    }
                                }
                                echo "<option value='" . $lista_actor[$i]['id'] . "' $selected >" . $lista_actor[$i]['nombre'] . " " . $lista_actor[$i]['apellidos'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="editable-field" id="name-field">
                        <label for="director">Director:</label>
                        <select class="field-value" id="director" name="director[]" multiple>
                            <?php
                            for ($i = 0; $i < count($lista_director); $i++) {
                                foreach ($info_director as $j) {
                                    if ($lista_director[$i]['id'] == $j['id_director']) {
                                        $selected = 'selected';
                                        break;
                                    } else {
                                        $selected = '';
                                    }
                                }
                                echo "<option value='" . $lista_director[$i]['id'] . "' $selected >" . $lista_director[$i]['nombre'] . " " . $lista_director[$i]['apellidos'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="editable-field" id="name-field">
                        <label for="generos">Generos:</label>
                        <select class="field-value2" id="generos" name="generos[]" multiple>
                            <?php
                            for ($i = 0; $i < count($lista_genero); $i++) {
                                foreach ($info_generos as $j) {
                                    if ($lista_genero[$i]['id'] == $j['id_genero']) {
                                        $selected = 'selected';
                                        break;
                                    } else {
                                        $selected = '';
                                    }
                                }
                                echo "<option value='" . $lista_genero[$i]['id'] . "' $selected >" . $lista_genero[$i]['tipo'] . "</option>";
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
</body>

</html>