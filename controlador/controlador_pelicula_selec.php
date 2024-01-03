<?php
require_once("../modelo/Datos.php");
require_once("../config.php");
$bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

session_start();
if (isset($_SESSION['hora'])) {
    unset($_SESSION['hora']);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['boton'])) {
        $pelicula_seleccionada = explode(";", $_POST['boton']);
        if (count($pelicula_seleccionada) == 2) {
            $_SESSION['hora'] = $pelicula_seleccionada[1];
        }
        $_SESSION['pelicula'] = $pelicula_seleccionada[0];
    }
}


print_r($_SESSION);

?>