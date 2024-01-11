<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilosCine.css">
    <link rel="stylesheet" href="../css/estilos_cabecera.css">
    <link rel="icon" href="../imagenes/cineLogo.PNG" type="image/jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        crossorigin="anonymous" />
    <title>INSERTAR CALIFICACION</title>
</head>

<body>

    <?php require_once("vista_cabecera_admin.php") ?>
    <div class="container2">
        <h2>INSERTAR CLASIFICACION <i class="fas fa-thumbs-up"></i> </h2>
        <form action="../controlador/controlador_insertar_clasificacion.php" method="post">
            <div class="profile-container">
                <div class="profile-info">
                    <div class="editable-field" id="name-field">
                        <label for="edad">Edad:</label>
                        <input class="field-value" type="numeric" id="edad" name="edad" pattern="[0-9]|[1-9][0-9]"
                            required>
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