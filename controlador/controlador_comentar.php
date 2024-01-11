<?php
session_start();
if (!(isset($_SESSION['nick']))) {
    header("Location: ../vista/vista_login.php");
}
require_once("../modelo/Datos.php");
require_once("../config.php");
$bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
$bd->conectar();
$nick = $_SESSION['nick'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comentario = $_POST['comentario'];
    $valoracion = (int) $_POST['valoracion'];
    $nombre = $_POST['nombre'];
    $hora = $_POST['hora'];
    $dia = $_POST['dia'];
    $sala = $_POST['sala'];

    $bd->insertar_valoracion($nick, $nombre, $dia, $hora, $sala, $comentario, $valoracion);
    header("Location: ../controlador/controlador_peliculas_vistas.php");
}

$bd->desconectar();
?>