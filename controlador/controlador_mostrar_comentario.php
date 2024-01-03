<?php
require_once("../modelo/Datos.php");
require_once("../config.php");
// SELECT 
//REQUIRE ONCE
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['boton'])) {
        $pelicula_seleccionada = explode(";", $_POST['boton']);
    }
}
require_once("../vista/vista_comentario.php");
?>