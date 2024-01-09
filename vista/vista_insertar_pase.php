<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Película</title>
    <link rel="stylesheet" href="../estilosCine.css">
    <link rel="stylesheet" href="../estilos_cabecera.css">
</head>

<body>

    <?php require_once("vista_cabecera_admin.php") ?>

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

</body>

</html>