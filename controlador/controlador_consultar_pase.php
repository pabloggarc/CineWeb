<?php
session_start();
if (!(isset($_SESSION['rol_usuario'])) || $_SESSION['rol_usuario']==1) {
    header("Location: ../vista/vista_login.php");
}
require_once("../modelo/Datos.php");
require_once("../config.php");
$bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
$bd->conectar();
// Procesamiento del formulario de inicio de sesion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['boton'];
    $info = $bd->get_pase_por_id($id);
}

$bd->desconectar();
require_once("../vista/vista_modificar_pase.php")
    ?>