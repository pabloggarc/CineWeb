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

    <title>INSERTAR GENERO</title>
</head>

<body>

    <?php require_once("vista_cabecera_admin.php") ?>

    <div class="container2">
        <h2>INSERTAR GENERO <i class="fas fa-tags"></i></h2>
        <form action="../controlador/controlador_insertar_genero.php" method="post">
            <div class="profile-container">
                <div class="profile-info">
                    <div class="editable-field" id="name-field">
                        <label for="tipo">Tipo:</label>
                        <input class="field-value" type="text" id="tipo" name="tipo"
                            pattern="[A-ZÁÉÍÓÚ][a-záéíóú]{0,19}" required>
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