<?php
    require_once("../modelo/Datos.php");
    require_once("../config.php");

    $bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
    $bd->conectar();

    $sesiones_hoy = $bd->get_numero_sesiones();
    $sesiones_futuras = $bd->get_numero_sesiones_futuras();
    $numero_usuarios = $bd->get_numero_usuarios();
    $numero_peliculas_disponibles = $bd->get_numero_peliculas_disponibles();
    $valoracion_media = round($bd->get_valoracion_media(),2);
    $numero_butacas_reservadas = $bd->get_numero_butacas_reservadas();
    $numero_butacas = $bd->get_numero_butacas();
    $numero_butacas_ocupadas = $bd->get_numero_butacas_ocupadas();

    $bd->desconectar();
    require_once("../vista/vista_estadisticas.php");
?>