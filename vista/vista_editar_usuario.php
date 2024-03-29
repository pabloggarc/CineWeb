<!DOCTYPE html>
<html lang="es">

<head>
    <title>EDITAR USUARIO</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilosCine.css">
    <link rel="stylesheet" href="../css/estilos_cabecera.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        crossorigin="anonymous" />
    <link rel="icon" href="../imagenes/cineLogo.PNG" type="image/jpg">

</head>

<body>
    <?php
    if (!(isset($_SESSION['rol_usuario']))) {
        header("Location: ../vista/vista_login.php");
    }
    ?>
    <?php
    if ($_SESSION['rol_usuario'] == 1) {
        require_once("vista_cabecera.php");
    } else {
        require_once("vista_cabecera_admin.php");
    }
    ?>


    <div class="container2">
        <h2>EDITAR PERFIL</h2>
        <div class="centrar">
            <img src="../imagenes/editarPerfil.PNG" alt="Imagen de perfil" width="auto" height="130px">
        </div>
        <form action="../controlador/controlador_editar_usuario.php" method="post">
            <div class="profile-container">
                <div class="profile-info">
                    <div class="editable-field" id="name-field">
                        <label><i class="fas fa-id-card"></i> Nombre:</label>
                        <input type="text" name="nombre" id="nombre" value="<?php echo $info['nombre'] ?>"
                            class="field-value">
                    </div>
                    <div class="editable-field" id="last-name-field">
                        <label><i class="fas fa-id-card"></i> Apellidos:</label>
                        <input type="text" name="apellidos" id="apellidos" value="<?php echo $info['apellidos'] ?>"
                            class="field-value">
                    </div>
                    <div class="editable-field" id="email-field">
                        <label><i class="fas fa-envelope"></i> Correo Electrónico:</label>
                        <input type="text" name="correo" id="correo" value="<?php echo $info['correo'] ?>"
                            class="field-value">
                    </div>
                    <div class="editable-field" id="username-field">
                        <label><i class="fas fa-user-tag"></i> Nickname:</label>
                        <input type="text" name="nick" id="nick" value="<?php echo $info['nick'] ?>"
                            class="field-value">
                    </div>
                    <div class="editable-field" id="calendar-field">
                        <label><i class="fas fa-calendar"></i> Fecha de nacimiento:</label>
                        <input type="text" name="fecha_nacimiento" id="fecha_nacimiento"
                            value="<?php echo $info['fecha_nacimiento'] ?>" class="field-value">
                    </div>
                </div>
            </div>
            <button class="back-button" onclick="goBack()">
                <i class="fas fa-arrow-left"></i> Volver
            </button>
            <input type="submit" value="Enviar">

        </form>
    </div>
</body>

</html>