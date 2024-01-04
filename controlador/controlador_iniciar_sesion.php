<?php
require_once("../modelo/Datos.php");
require_once("../config.php");
$bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

$bd->conectar();


// Inicialmente el nick y la clave de acceso se encuentran vacias
$nick="";
$clave="";

// Procesamiento del formulario de inicio de sesion
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Almacenamos el nick y la clave que ha introducido el usuario
    $nick = $_POST["nick"];
    $clave = $_POST["clave"];

    // Comprobamos si el nick introducido es valido
    $es_nick_valido = $bd->consultar_usuario_por_nick($nick);
    // Obtenemos la clave cifrada del usuario 
    $clave_cifrada = $bd->get_clave_por_nick($nick);
    // Comprobamos si la clave de acceso se ha introducido correctamente
    $es_clave_valida = password_verify($clave,$clave_cifrada);
    // Si se han introducido correctamente el nickname y la clave de acceso
    if ($es_nick_valido && $es_clave_valida) {
        // Iniciamos la sesion
        session_start();
        // Almacenamos el nick del usuario en la sesion
        $_SESSION['nick'] = $nick;
        $rol_usuario = $bd->get_rol_por_nick($nick)[0]['id_rol'];
        // Si el usuario es un cliente
        $_SESSION['rol_usuario'] = $rol_usuario;
        if($rol_usuario==1){
            // Redirigimos al usuario a la pantalla de inicios del cliente
            header("Location: ../controlador/controlador_perfil.php");
        }else if($rol_usuario==2){
            require_once("../vista/vista_admin_inicio.php");
        }
    } 
    // Si el nickname es incorrecto
    else if($es_nick_valido==false ) {
        echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "error",
                    title: "<span style=\'color: red;\'>NICKNAME INCORRECTO</span>",
                    html: "<span style=\'color: #333;\'>El nick introducido no se encuentra registrado en la base de datos</span>",
                    confirmButtonText: "<span style=\'color: #fff;\'>OK</span>",
                    customClass: {
                        confirmButton: \'btn btn-danger\',
                        cancelButton: \'btn btn-secondary\'
                    }
                }).then(function() {
                    window.location.href="../vista/vista_login.php";
                });
            });
        </script>';
    }
    // Si la clave de acceso es incorrecta
    else if($es_nick_valido==true && $es_clave_valida==false){
        echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "error",
                    title: "<span style=\'color: red;\'>CLAVE INCORRECTA</span>",
                    html: "<span style=\'color: #333;\'>La clave de acceso introducida es incorrecta</span>",
                    confirmButtonText: "<span style=\'color: #fff;\'>OK</span>",
                    customClass: {
                        confirmButton: \'btn btn-danger\',
                        cancelButton: \'btn btn-secondary\'
                    }
                }).then(function() {
                    window.location.href="../vista/vista_login.php";
                });
            });
        </script>';
    }
}

$bd->desconectar();

?>