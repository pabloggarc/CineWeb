<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilosCine.css">
    <link rel="stylesheet" href="../css/estilos_cabecera.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        crossorigin="anonymous" />
    <link rel="icon" href="../imagenes/cineLogo.PNG" type="image/jpg">
    <title>INSERTAR SALA</title>
</head>

<body>
    <?php
    if (!(isset($_SESSION['rol_usuario'])) || $_SESSION['rol_usuario'] == 1) {
        header("Location: ../vista/vista_login.php");
    }
    ?>
    <?php require_once("vista_cabecera_admin.php") ?>

    <div class="container4">
        <h2>INSERTAR SALA <i class="fas fa-door-open"></i></i></h2>
        <form action="../controlador/controlador_insertar_sala.php" method="post">
            <div class="profile-container">
                <div class="profile-info">
                    <div class="editable-field" id="name-field">
                        <label for="nombre_sala">Nombre de la Sala:</label>
                        <input class="field-value" type="text" id="nombre_sala" name="nombre_sala"
                            pattern="^[A-Z0-9].{0,19}$" required>
                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="numero_filas">Número de filas:</label>
                        <input class="field-value" type="text" id="n_filas" name="n_filas" pattern="[1-9][0-9]*"
                            required>
                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="numero_columnas">Número de columnas:</label>
                        <input class="field-value" type="text" id="n_col" name="n_col" pattern="[1-9][0-9]*" required>
                    </div>
                </div>
            </div>
            <!-- Botón de envío -->
            <button type="submit">Enviar</button>
        </form>
        <form action="../controlador/controlador_admin_inicio.php" method="post">
            <button type="submit">Volver</button>
        </form>
    </div>
</body>

</html>