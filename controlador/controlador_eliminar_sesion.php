<?php
require_once("../modelo/Datos.php");
require_once("../config.php");
$bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

$bd->conectar();


// Procesamiento del formulario de inicio de sesion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ids = explode(";", $_POST['boton']);
    $bd->eliminar_sesion($ids[0],$ids[1],$ids[2]);
}


$bd->desconectar();
require_once("../vista/vista_admin_inicio.php")
    ?>