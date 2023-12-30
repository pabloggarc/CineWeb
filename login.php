<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Inicio de sesión</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Indicamos la hoja de estilos para el login -->
        <link rel="stylesheet" href="./estilosLogin.css">
        <link rel="icon" href="./imagenes/cine+.PNG" type="image/jpg">
    </head>
    <body>
        <nav>
            <img src="./imagenes/CINE+.png" class="logo" alt="Logo de la página">
            <div class="opciones">
                <a href="login.php">INICIO</a>
            </div>
        </nav>
        <div class="container-form register" id="iniciarSesion">
            <div class="information">
                <div class="info-childs">
                    <h2>Bienvenido</h2>
                    <img src="./imagenes/cine2.png" alt="alt" width="auto" height="150px">
                    <p>Para unirte a nuestra comunidad por favor Crea una cuenta con tus datos</p>
                    <button onclick="mostrarContenedor('registro', 'iniciarSesion')"> Crear una cuenta</button>
                </div>
            </div>

            <div class="form-information">
                <div class="form-information-childs">
                    <h2>Iniciar Sesión</h2>
                    <img src="./imagenes/usuarioLogin.PNG" alt="alt" width="100px" height="100px">
                    <form class="form" action="controlador/controlador_iniciar_sesion.php" method="POST">
                        <label >
                            <i class='bx bx-envelope' ></i>
                            <input type="text" placeholder="Nick" name="nick">
                        </label>
                        <label>
                            <i class='bx bx-lock-alt' ></i>
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
                    <img src="./imagenes/registro.png" height="200px" width="auto">
                    <p>Para unirte a nuestra comunidad por favor Inicia sesión con tus datos</p>
                    <button onclick="mostrarContenedor('iniciarSesion', 'registro')"> Iniciar Sesión</button>
                </div>
            </div>
            <div class="form-information">
                <div class="form-information-childs">
                    <h2>Crear una Cuenta</h2>
                    <form class="formR" action="controlador/controlador_registro.php" method="POST">
                        <div class="form-group">
                            <label for="nick">Nick</label>
                            <div id="caja-nombre">
                                <input type="text" id="nick" name="nick" placeholder="Introduce tu nick" pattern="[a-záéíóúüñ][a-zA-Z0-9áéíóúüÜÑñ]{0,19}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Clave</label>
                            <div id="caja-nombre">
                                <input type="password" id="clave" name="clave" placeholder="Introduce tu clave" pattern=".{1,60}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Nombre </label>
                            <div id="caja-nombre">
                                <input type="text" id="nombre" name="nombre" placeholder="Introduce tu nombre " pattern="[A-ZÁÉÍÓÚÜÑ][a-zA-ZÁÉÍÓÚáéíóúüÜÑñ]{0,29}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Apellidos </label>
                            <div id="caja-nombre">
                                <input type="text" id="apellido" name="apellido" pattern="[A-ZÁÉÍÓÚÜÑ][a-zA-ZÁÉÍÓÚáéíóúüÜÑñ]+ [A-ZÁÉÍÓÚÜÑ][a-zA-ZÁÉÍÓÚáéíóúüÜÑñ]+" placeholder="Ingrese dos apellidos" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <div id="caja-nombre">
                                <input type="email" id="email" name="email" placeholder="Introduce tu correo electrónico" pattern="[a-z][a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>
                                <div id="tooltip-correo" class="tooltip"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Fecha de nacimiento</label>
                            <div id="caja-nombre">
                                <input type="date" id="fecha" name="fecha" required>
                            </div>
                        </div>
                        <input type="submit" value="Registrarse">
                    </form>
                </div>
            </div>
        </div>
    </div>
 </div>
    <script src="./js/login.js"></script>
</body>
</html>