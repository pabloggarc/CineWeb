<?php
    require_once("../modelo/Datos.php");
    require_once("../config.php");

    session_start();
    // Eliminamos los datos de la sesion
    session_unset();
    // Destruimos la sesion
    session_destroy();
    // Redirigimos al usuario a la pagina del login
    require_once('../vista/vista_login.php');
?>