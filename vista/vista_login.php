<!DOCTYPE html>
<html lang="es">

<head>
    <title>LOGIN</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Indicamos la hoja de estilos para el login -->
    <link rel="stylesheet" href="../css/estilos_cabecera.css">
    <link rel="stylesheet" href="../css/estilosCine.css">
    <link rel="stylesheet" href="../css/estilosLogin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="icon" href="../imagenes/cineLogo.PNG" type="image/jpg">
</head>

<body>
    <div class="container-form register" id="iniciarSesion">
        <div class="information">
            <div class="info-childs">
                <h2>Bienvenido</h2>
                <img src="../imagenes/cine2.png" alt="alt" width="auto" height="150px">
                <p>Para unirte a nuestra comunidad crea una cuenta con tus datos</p>
                <button onclick="mostrarContenedor('registro', 'iniciarSesion')"> Crear una cuenta</button>
            </div>
        </div>

        <div class="form-information">
            <div class="form-information-childs">
                <h2>Iniciar Sesión</h2>
                <img src="../imagenes/usuarioLogin.PNG" alt="alt" width="100px" height="100px">
                <form class="form" action="../controlador/controlador_iniciar_sesion.php" method="POST">
                    <label>
                        <i class='bx bx-envelope'></i>
                        <input type="text" placeholder="Nick" name="nick">
                    </label>
                    <label>
                        <i class='bx bx-lock-alt'></i>
                        <input type="password" placeholder="Clave de acceso" name="clave">
                    </label>
                    <input type="submit" value="Iniciar Sesión">
                </form>
            </div>
        </div>
    </div>

    <div class="container-form2 login hide" id="registro">
        <div class="information">
            <div class="info-childs">
                <h2>¡¡Bienvenido nuevamente!!</h2>
                <img src="../imagenes/registro.png" height="200px" width="auto">
                <p>Para unirte a nuestra comunidad por favor Inicia sesión con tus datos</p>
                <button onclick="mostrarContenedor('iniciarSesion', 'registro')"> Iniciar Sesión</button>
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h3>Crear una Cuenta</h3>
                <form class="formR" action="../controlador/controlador_registro.php" method="POST">
                    <div class="form-group">
                        <label for="nick"><i class="fas fa-user-tag"></i> Nick</label>
                        <div class="editable-field" id="caja-nombre">
                            <input class="field-value" type="text" id="nick" name="nick" placeholder="Introduce tu nick"
                                pattern="[a-záéíóúüñ][a-zA-Z0-9áéíóúüÜÑñ]{0,19}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre"><i class="fas fa-key"></i> Clave</label>
                        <div class="editable-field" id="caja-nombre">
                            <input class="field-value" type="password" id="clave" name="clave"
                                placeholder="Introduce tu clave" pattern=".{1,60}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefono"><i class="fas fa-id-card"></i> Nombre </label>
                        <div class="editable-field" id="caja-nombre">
                            <input class="field-value" type="text" id="nombre" name="nombre"
                                placeholder="Introduce tu nombre " pattern="[A-ZÁÉÍÓÚÜÑ][a-zA-ZÁÉÍÓÚáéíóúüÜÑñ]{0,29}"
                                required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefono"><i class="fas fa-id-card"></i> Apellidos </label>
                        <div class="editable-field" id="caja-nombre">
                            <input class="field-value" type="text" id="apellido" name="apellido"
                                pattern="[A-ZÁÉÍÓÚÜÑ][a-zA-ZÁÉÍÓÚáéíóúüÜÑñ]+ [A-ZÁÉÍÓÚÜÑ][a-zA-ZÁÉÍÓÚáéíóúüÜÑñ]+"
                                placeholder="Ingrese dos apellidos" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope"></i> Correo electrónico</label>
                        <div class="editable-field" id="caja-nombre">
                            <input class="field-value" type="email" id="email" name="email"
                                placeholder="Introduce tu correo"
                                pattern="[a-záéíóú][a-záéíóú._]{0,35}@[a-z]{0,10}((.com)|(.es))" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password"><i class="fas fa-calendar"></i> Fecha de nacimiento</label>
                        <div class="editable-field" id="caja-nombre">
                            <input class="field-value" type="date" id="fecha" name="fecha" required>
                        </div>
                    </div>
                    <input type="submit" value="Registrarse">
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script src="../js/login.js"></script>
    <script>
        // Obtener la fecha actual en formato ISO (YYYY-MM-DD)
        var fechaActual = new Date().toISOString().split('T')[0];

        // Establecer la fecha actual como el valor máximo
        document.getElementById("fecha").setAttribute("max", fechaActual);
    </script>
</body>

</html>