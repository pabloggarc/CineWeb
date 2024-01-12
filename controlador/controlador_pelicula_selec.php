<?php
session_start();
if (!(isset($_SESSION['nick'])) || $_SESSION['rol_usuario'] == 2) {
    header("Location: ../vista/vista_login.php");
}
require_once("../modelo/Datos.php");
require_once("../config.php");
$bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
$bd->conectar();

if (isset($_SESSION['hora'])) {
    unset($_SESSION['hora']);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['boton'])) {
        $pelicula_seleccionada = explode(";", $_POST['boton']);
        $_SESSION['pelicula'] = $pelicula_seleccionada[0];
        if (count($pelicula_seleccionada) == 2) {
            $_SESSION['hora'] = $pelicula_seleccionada[1];
            $fecha_actual = date("Y-m-d");
            $_SESSION['fecha'] = $fecha_actual;
            $_SESSION['sala'] = $bd->get_id_sala((int) $_SESSION['pelicula'], $_SESSION['hora'], $_SESSION['fecha'])[0]["nombre"];
            header("Location: ../controlador/controlador_butacas.php");
        } else {
            header("Location: ../controlador/controlador_info_peliculas.php");
        }


    }
}
$bd->desconectar();
?>