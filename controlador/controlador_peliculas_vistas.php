<?php
require_once("../modelo/Datos.php");
require_once("../config.php");
$bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
$bd->conectar();


session_start();
$nick= $_SESSION['nick'];
$lista_entradas=$bd->get_peliculas_vistas_por_nick($nick);

$visto = array();
$nombre_pelicula = array();
$hora = array();
$dia = array();
$sala = array();
$id_entrada = array();

foreach ($lista_entradas as $entrada) {
    $aux_fila=array();
    $aux_columna=array();
    $nombre_pelicula[]=$entrada['nombre'];
    $hora[]=$entrada['hora'];
    $dia[]=$entrada['dia'];
    $sala[]=$entrada['sala'];
    $visto[] = $bd->get_pelicula_comentada($nick, $entrada['nombre'], $entrada['sala'], $entrada['dia'], $entrada['hora'])[0];
}

$bd->desconectar();
require_once("../vista/vista_peliculas_vistas.php");
?>