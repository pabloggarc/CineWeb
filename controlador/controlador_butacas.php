<?php
session_start();
if (!(isset($_SESSION['nick']))) {
    header("Location: ../vista/vista_login.php"); 
}
require_once("../modelo/Datos.php");
require_once("../config.php");

$bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
$bd->conectar();
if (isset($_SESSION["sala"]) && isset($_SESSION["fecha"]) && isset($_SESSION["hora"])) {
    $nombre_sala = $_SESSION["sala"];
    $fecha = $_SESSION["fecha"];
    $hora = $_SESSION["hora"];

    $dim = $bd->get_dim_sala($nombre_sala);
    $libre = $bd->get_ocupacion_sala($nombre_sala, $fecha, $hora);
    $ids_butacas = $bd->get_butacas($nombre_sala);
    $ocupantes = $bd->get_ocupantes_sala($nombre_sala, $fecha, $hora);

    $filas = 0;
    $columnas = 0;
    if ($dim != null) {
        $filas = $dim[0];
        $columnas = $dim[1];
    }
} else {
    echo "Error: No se ha especificado una sala, día y hora";

    exit();
}

$bd->desconectar();
require_once("../vista/vista_butacas.php");
?>