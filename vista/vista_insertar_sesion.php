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
    <title>Formulario de Película</title>
</head>

<body>
    <?php require_once("vista_cabecera_admin.php") ?>


    <div class="container4">
        <h2>INSERTAR SESION <i class="fas fa-box"></i></i></i></h2>
        <form action="../controlador/controlador_insertar_sesion.php" method="post">
            <div class="profile-container">
                <div class="profile-info">
                    <div class="editable-field" id="name-field">
                        <label for="Sala">Selecciona sala:</label>
                        <select class="field-value" id="sala" name="sala">
                            <?php
                            for ($i = 0; $i < count($lista_salas); $i++) {
                                echo "<option value='" . $lista_salas[$i]['id'] . "'>" . $lista_salas[$i]['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="Pelicula">Selecciona pelicula:</label>
                        <select class="field-value" id="pelicula" name="pelicula">
                            <?php
                            for ($i = 0; $i < count($lista_peliculas); $i++) {
                                echo "<option value='" . $lista_peliculas[$i]['id'] . "'>" . $lista_peliculas[$i]['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="Pase">Selecciona pase:</label>
                        <select class="field-value" id="pase" name="pase">
                            <?php
                            for ($i = 0; $i < count($lista_pases); $i++) {
                                echo "<option value='" . $lista_pases[$i]['id'] . "'>" . $lista_pases[$i]['fecha'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit">Enviar</button>
        </form>
        <form action="../controlador/controlador_admin_inicio.php" method="post">
            <button type="submit">Volver</button>
        </form>
    </div>
</body>

</html>