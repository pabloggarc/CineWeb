<!DOCTYPE html>
<html>

<head>
    <title>PERFIL</title>
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
    if ($_SESSION['rol_usuario'] == 1) {
        require_once("vista_cabecera.php");
    } else {
        require_once("vista_cabecera_admin.php");
    }
    ?>

    <div class="container2">
        <h2>PERFIL</h2>
        <div class="centrar">
            <img src="../imagenes/perfil.PNG" alt="Imagen de perfil" width="auto" height="115px">
        </div>
        <form action="../controlador/controlador_editar_perfil.php" method="post">
            <div class="profile-container">
                <div class="profile-info">
                    <div class="editable-field" id="name-field">
                        <label><i class="fas fa-id-card"></i> Nombre:</label>
                        <div class="field-value" id="name" contenteditable="false">
                            <?php echo $nombre ?>
                        </div>
                    </div>
                    <div class="editable-field" id="last-name-field">
                        <label><i class="fas fa-id-card"></i> Apellidos:</label>
                        <div class="field-value" id="last-name" contenteditable="false">
                            <?php echo $apellidos ?>
                        </div>
                    </div>
                    <div class="editable-field" id="email-field">
                        <label><i class="fas fa-envelope"></i> Correo Electrónico:</label>
                        <div class="field-value" id="email" contenteditable="false">
                            <?php echo $correo ?>
                        </div>
                    </div>
                    <div class="editable-field" id="username-field">
                        <label><i class="fas fa-user-tag"></i> Nickname:</label>
                        <div class="field-value" id="username" contenteditable="false">
                            <?php echo $nick ?>
                        </div>
                    </div>
                    <div class="editable-field" id="calendar-field">
                        <label><i class="fas fa-calendar"></i> Fecha de nacimiento:</label>
                        <div class="field-value" id="calendar" contenteditable="false">
                            <?php echo $fecha_nacimiento ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="centrar">
                <input type="submit" value="Editar"></input>
            </div>
            <div class="iconos-cerrar-borrar">
                <div class="icono-cb" title="Cerrar Sesión" onclick="cerrarSesion()">
                    <a href="../controlador/controlador_cerrar_sesion.php"><i class="fas fa-sign-out-alt"></i>
                </div>
                <div class="icono-cb" title="Borrar Cuenta" onclick="deleteAccount()">
                    <a href="../controlador/controlador_eliminar_cuenta.php"><i class="fas fa-trash-alt"></i>
                </div>
            </div>
        </form>
    </div>
</body>

</html>