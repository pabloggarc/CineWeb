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
    <title>INSERTAR DISTRIBUIDORA</title>
</head>

<body>

    <?php require_once("vista_cabecera_admin.php") ?>

    <div class="container2">
        <h2>INSERTAR DISTRIBUIDORA <i class="fas fa-building"></i></h2>
        <form action="../controlador/controlador_insertar_distribuidora.php" method="post">
            <div class="profile-container">
                <div class="profile-info">
                    <div class="editable-field" id="name-field">
                        <label for="nombre">Nombre:</label>
                        <input class="field-value" type="text" id="nombre" name="nombre" pattern="^[A-Z].{0,49}$"
                            required>
                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="correo">Correo:</label>
                        <input class="field-value" type="text" id="correo" name="correo" pattern="^.{0,49}$"
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