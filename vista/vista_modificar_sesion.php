<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MODIFICAR SESION</title>
    <link rel="stylesheet" href="../css/estilosCine.css">
    <link rel="stylesheet" href="../css/estilos_cabecera.css">
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

    <div class="container4">
        <h2>MODIFICAR SESION <i class="fas fa-box"></i></i></i></h2>
        <form action="../controlador/controlador_update_sesion.php" method="post">
            <div class="profile-container">
                <div class="profile-info">
                    <div class="editable-field" id="name-field">
                        <label for="Sala">Selecciona sala:</label>
                        <select class="field-value" id="sala" name="sala">
                            <?php
                            for ($i = 0; $i < count($lista_salas); $i++) {
                                $selected = ($lista_salas[$i]['id'] == $sesion['id_sala']) ? 'selected' : '';
                                echo "<option value='" . $lista_salas[$i]['id'] . "' " . $selected . ">" . $lista_salas[$i]['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="Pelicula">Selecciona pelicula:</label>
                        <select class="field-value" id="pelicula" name="pelicula">
                            <?php
                            for ($i = 0; $i < count($lista_peliculas); $i++) {
                                $selected = ($lista_peliculas[$i]['id'] == $sesion['id_pelicula']) ? 'selected' : '';
                                echo "<option value='" . $lista_peliculas[$i]['id'] . "' " . $selected . ">" . $lista_peliculas[$i]['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="Pase">Selecciona pase:</label>
                        <select class="field-value" id="pase" name="pase">
                            <?php
                            for ($i = 0; $i < count($lista_pases); $i++) {
                                $selected = ($lista_pases[$i]['id'] == $sesion['id_pase']) ? 'selected' : '';
                                echo "<option value='" . $lista_pases[$i]['id'] . "' " . $selected . ">" . $lista_pases[$i]['fecha'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Botón de envío -->
            <?php
            $valor = $sesion['id_sala'] . ";" . $sesion['id_pelicula'] . ";" . $sesion['id_pase'];
            echo "<td><button type='submit' name='boton' value='" . $valor . "''>MODIFICAR</button></td>";
            ?>
        </form>
        <form action="../controlador/controlador_admin_inicio.php" method="post">
            <button type="submit">Volver</button>
        </form>
    </div>
</body>

</html>