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
            $lista_peliculas = $bd->get_peliculas_id_nombre();
            $lista_salas = $bd->get_salas_id_nombre();
            $lista_pases = $bd->get_pases_id_fecha();
            require_once('../vista/vista_insertar_sesion.php');
        } else {
            $lista_sesiones = $bd->get_sesiones();
            if ($opcion_selec == 2) {
                require_once('../vista/vista_eliminar_sesion.php');
            } else {
                require_once('../vista/vista_consultar_sesion.php');
            }
        }
    }
}


$bd->desconectar();

?>