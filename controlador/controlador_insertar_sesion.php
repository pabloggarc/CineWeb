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
    $id_sala = $_POST['sala'];
    $id_pelicula = $_POST['pelicula'];
    $id_pase = $_POST['pase'];

    $bd->insertar_sesion($id_sala, $id_pelicula, $id_pase);
}


$bd->desconectar();
header("Location: ../controlador/controlador_admin_inicio.php");
?>