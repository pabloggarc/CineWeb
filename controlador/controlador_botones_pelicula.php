<?php
session_start();
if (!(isset($_SESSION['rol_usuario'])) || $_SESSION['rol_usuario'] == 1) {
    header("Location: ../vista/vista_login.php");
}

require_once("../modelo/Datos.php");
require_once("../config.php");

// Procesamiento del formulario de inicio de sesion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['boton'])) {
        $opcion_selec = $_POST['boton'] + 1;
        if ($opcion_selec == 1) {
            require_once('../vista/vista_insertar_actor.php');
        } else if ($opcion_selec == 2) {
            require_once('../vista/vista_insertar_director.php');
        } else if ($opcion_selec == 3) {
            require_once('../vista/vista_insertar_genero.php');
        } else if ($opcion_selec == 4) {
            require_once('../vista/vista_insertar_nacionalidad.php');
        } else if ($opcion_selec == 5) {
            require_once('../vista/vista_insertar_clasificacion.php');
        } else {
            require_once('../vista/vista_insertar_distribuidora.php');
        }
    }
}
?>