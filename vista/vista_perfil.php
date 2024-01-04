<!DOCTYPE html>
<html>

<head>
    <title>Información del usuario</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilosPerfil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        crossorigin="anonymous" />
</head>

<body>
    <nav>
        <img src="./imagenes/CINE+.png" class="logo" alt="Logo de la página">
        <div class="opciones">
            <a href="../controlador/controlador_perfil.php">PERFIL</a>
            <a href="../controlador/controlador_mostrar_cartelera.php">CARTELERA</a>
        </div>
    </nav>

    <div class="container">
        <h2>PERFIL</h2>
        <div class="imagen-perfil">
            <img src="../imagenes/usuarioLogin.PNG" alt="alt" width="auto" height="100px">
        </div>
        <form id="profile-form" method="POST">
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
                    <div class="editable-field" id="password-field">
                        <label><i class="fas fa-key"></i> Clave de Acceso:</label>
                        <div class="field-value" id="password" contenteditable="false">
                            <?php echo $clave ?>
                        </div>
                    </div>
                    <div class="editable-field" id="calendar-field">
                        <label><i class="fas fa-calendar"></i> Fecha de nacimiento:</label>
                        <div class="field-value" id="calendar" contenteditable="false">
                            <?php echo $fecha_nacimiento ?>
                        </div>
                    </div>
                    <div class="editable-field" id="user-field">
                        <label><i class="fas fa-user-check"></i> Rol:</label>
                        <div class="field-value" id="user" contenteditable="false">
                            <?php echo $id_rol ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="parking-icons">
            <div class="parking-icon" title="Cerrar Sesión" onclick="cerrarSesion()">
                <a href="../controlador/controlador_cerrar_sesion.php"><i class="fas fa-sign-out-alt"></i>
            </div>
            <div class="parking-icon" title="Borrar Cuenta" onclick="deleteAccount()">
                <a href="../controlador/controlador_eliminar_cuenta.php"><i class="fas fa-trash-alt"></i>
            </div>
        </div>
    </div>
</body>

</html>