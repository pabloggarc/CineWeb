<?php
session_start();
if (!(isset($_SESSION['nick'])) || $_SESSION['rol_usuario'] == 2) {
    header("Location: ../vista/vista_login.php");
}
$entradas_selec = array();
if (isset($_POST['peliculas_seleccionadas[]'])) {
    $entradas_selec = $_POST['peliculas_seleccionadas[]'];
    $_SESSION['peliculas_seleccionadas[]'] = $entradas_selec;
}
?>