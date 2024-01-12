<?php
session_start();
if (!(isset($_SESSION['nick'])) || $_SESSION['rol_usuario'] == 2) {
    header("Location: ../vista/vista_login.php");
}
require_once("../modelo/Datos.php");
require_once("../config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['boton'])) {
        $pelicula_seleccionada = explode(";", $_POST['boton']);
    }
}
require_once("../vista/vista_comentario.php");
?>