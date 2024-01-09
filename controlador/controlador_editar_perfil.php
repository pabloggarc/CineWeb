<?php
    require_once("../modelo/Datos.php");
    require_once("../config.php");
    $bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

    $bd->conectar();


    // Procesamiento del formulario de inicio de sesion
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start();
        $nick = $_SESSION['nick'];
        $info = $bd->get_usuario_por_nick($nick)[0];
    }

    $bd->desconectar();
    require_once("../vista/vista_editar_usuario.php") 
?>