<?php
session_start();
if (!(isset($_SESSION['nick']))) {
    header("Location: ../vista/vista_login.php");
}
require_once("../modelo/Datos.php");
require_once("../config.php");
$bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
$bd->conectar();
if (isset($_POST['hora'])) {

    $hora = $_POST['hora'] . ":00";
    $_SESSION['hora'] = $hora;
    echo $hora;
    //echo "Hora recibida: " . $hora;
    $id_pelicula = $_SESSION['pelicula'];
    $fecha = $_SESSION['fecha'];
    $consulta = $bd->get_id_sala($id_pelicula, $hora, $fecha);
    $id_sala = $consulta[0]['nombre'];
    $_SESSION['sala'] = $id_sala;
    // Redirige al navegador a otra página
    //exit();
} else {
    echo "Error: No se proporcionó una hora.";
}
?>