<?php
require_once("../modelo/Datos.php");
require_once("../config.php");
$bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
$bd->conectar();

$lista_peliculas = $bd->get_cabeceras_peliculas();

$lista_sesiones = array();


foreach ($lista_peliculas as $i) {
    $lista_sesiones[] = $bd->get_info_peliculas($i['id']);
}


$bd->desconectar();
require_once("../vista/vista_cartelera.php");
?>