<?php
require_once("../modelo/Datos.php");
require_once("../config.php");
$bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

$bd->conectar();


// Procesamiento del formulario de inicio de sesion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['boton'];
    $dia = $_POST['dia'];
    $hora = $_POST['hora'];
    $bd->update_pase_por_id($id, $dia, $hora);
}

$bd->desconectar();
require_once("../vista/vista_admin_inicio.php")
    ?>