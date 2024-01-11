<?php
session_start();
if (!(isset($_SESSION['nick']))) {
    header("Location: ../vista/vista_login.php");
}
require_once("../modelo/Datos.php");
require_once("../config.php");
$bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

$bd->conectar();


// Procesamiento del formulario de inicio de sesion
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['boton'])) {
        $opcion_selec = $_POST['boton'];
        if ($opcion_selec == 1) {
            require_once('../vista/vista_insertar_sala.php');
        } else {
            $lista_salas = $bd->get_salas();
            if ($opcion_selec == 2) {
                require_once('../vista/vista_eliminar_sala.php');
            } else {
                require_once('../vista/vista_consutlar_sala.php');
            }
        }
    }
}


$bd->desconectar();
?>