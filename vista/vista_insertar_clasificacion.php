<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilosCine.css">
    <link rel="stylesheet" href="../estilos_cabecera.css">

    <title>Formulario de Película</title>
</head>

<body>

    <?php require_once("vista_cabecera_admin.php") ?>

    <form action="../controlador/controlador_insertar_clasificacion.php" method="post">
        <div class="profile-container">
            <div class="profile-info">
                <div class="editable-field" id="name-field">
                    <label for="edad">Edad:</label>
                    <input class="field-value" type="numeric" id="edad" name="edad" required>
                </div>
            </div>
        </div>

        <!-- Botón de envío -->
        <button type="submit">Enviar</button>
    </form>

</body>

</html>