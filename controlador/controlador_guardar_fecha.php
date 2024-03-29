<?php
session_start();
if (!(isset($_SESSION['nick'])) || $_SESSION['rol_usuario'] == 2) {
    header("Location: ../vista/vista_login.php");
}
require_once("../modelo/Datos.php");
require_once("../config.php");

$bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
$bd->conectar();

if (isset($_SESSION["pelicula"])) {
    $id_pelicula = $_SESSION["pelicula"];
    $fecha = $_POST["fecha"];
    $_SESSION["fecha"] = $fecha;
    $sesiones = $bd->get_sesiones_por_pelicula($id_pelicula, $fecha);
    $horas = array();
    for ($i = 0; $i < count($sesiones); $i++) {
        $horas[$i] = date("H:i", strtotime($sesiones[$i]["hora"]));
    }
    $bd->desconectar();
    // Devolver los datos de los usuarios en formato JSON
    echo json_encode($horas);
}

?>