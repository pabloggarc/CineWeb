<?php
session_start();
if (!(isset($_SESSION['nick'])) || $_SESSION['rol_usuario']==2) {
    header("Location: ../vista/vista_login.php");
}
require_once("../modelo/Datos.php");
require_once("../config.php");
$bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
$bd->conectar();

$nick = $_SESSION['nick'];
$lista_entradas = $bd->get_peliculas_no_vistas_por_nick($nick);

$nombre_pelicula = array();
$hora = array();
$dia = array();
$sala = array();
$id_entrada = array();
$butaca_fila = array();
$butaca_columna = array();
$localizador = array();
$columnas = array();
if (!is_null($lista_entradas)) {
    foreach ($lista_entradas as $entrada) {
        $aux_fila = array();
        $aux_columna = array();
        $aux_localizador = array();
        $nombre_pelicula[] = $entrada['nombre'];
        $hora[] = $entrada['hora'];
        $dia[] = $entrada['dia'];
        $sala[] = $entrada['sala'];
        $localizador[] = $entrada['localizador'];
        $butaca_fila[] = $entrada['fila'];
        $butaca_columna[] = $entrada['columna'];
        $columnas[] = $entrada['sala_columnas'];
    }
}
$bd->desconectar();

require_once("../vista/vista_reservas.php");
?>