<?php
    require_once("../modelo/Datos.php");
    require_once("../config.php");

    $bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
    $bd->conectar();

    // Iniciamos la sesion para obtener el nick del usuario que se encuentra logueado
    session_start();
    $nick= $_SESSION['nick'];
    // Eliminamos los datos de la sesion
    session_unset();
    // Destruimos la sesion
    session_destroy();
    // Redirigimos al usuario a la pagina del login
    require_once('../vista/vista_login.php');
    // Eliminamos el usuario de la base de datos
    $bd->eliminar_usuario_por_nick($nick);
    $bd->desconectar();
?>