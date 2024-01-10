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

    <form action="../controlador/controlador_insertar_distribuidora.php" method="post">
        <div class="profile-container">
            <div class="profile-info">
                <div class="editable-field" id="name-field">
                    <label for="nombre">Nombre:</label>
                    <input class="field-value" type="text" id="nombre" name="nombre" required>
                </div>
            </div>
        </div>
        <div class="profile-container">
            <div class="profile-info">
                <div class="editable-field" id="name-field">
                    <label for="correo">Correo:</label>
                    <input class="field-value" type="text" id="correo" name="correo" required>
                </div>
            </div>
        </div>

        <!-- Botón de envío -->
        <button type="submit">Enviar</button>
    </form>

</body>

</html>