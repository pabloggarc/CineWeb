<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSERTAR PASE</title>
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
        <h2>INSERTAR PASE <i class="fas fa-clock"></i></h2>
        <form action="../controlador/controlador_insertar_pase.php" method="post">
            <div class="profile-container">
                <div class="profile-info">
                    <div class="editable-field" id="name-field">
                        <label for="dia">Introduce un día:</label>
                        <input class="field-value" type="date" id="dia" name="dia" required>
                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="hora">Introduce una hora:</label>
                        <input class="field-value" type="time" id="hora" name="hora" required>
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