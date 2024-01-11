<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilosCine.css">
    <link rel="stylesheet" href="../estilos_cabecera.css">
    <link rel="icon" href="../imagenes/cineLogo.PNG" type="image/jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        crossorigin="anonymous" />
    <title>Formulario de Película</title>
</head>

<body>

    <?php require_once("vista_cabecera_admin.php") ?>

    <div class="container2">
        <h2>INSERTAR ACTOR <i class="fas fa-user"></i></h2>
        <form action="../controlador/controlador_insertar_actor.php" method="post">
            <div class="profile-container">
                <div class="profile-info">
                    <div class="editable-field" id="name-field">
                        <label for="nombre">Nombre:</label>
                        <input class="field-value" type="text" id="nombre" name="nombre"
                            pattern="[A-ZÁÉÍÓÚ][a-záéíóú]{0,23} ([A-ZÁÉÍÓÚ][a-záéíóú]{0,23})?" required>
                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="apellidos">Apellidos:</label>
                        <input class="field-value" type="text" id="apellidos" name="apellidos"
                            pattern="[A-ZÁÉÍÓÚ][a-záéíóú]{0,23} ([A-ZÁÉÍÓÚ][a-záéíóú]{0,23})?" required>
                    </div>
                    <div class="editable-field" id="name-field">
                        <label for="fecha">Fecha de nacimiento:</label>
                        <input class="field-value" type="date" id="fecha" name="fecha" required>
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