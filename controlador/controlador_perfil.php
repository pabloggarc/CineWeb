<?php
session_start();
if (!(isset($_SESSION['nick']))) {
    header("Location: ../vista/vista_login.php");
}
require_once("../modelo/Datos.php");
require_once("../config.php");

$bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
$bd->conectar();

$nick = $_SESSION['nick'];
$info_usuario = $bd->get_info_perfil_por_nick($nick);

foreach ($info_usuario as $usuario) {
    $nombre = $usuario["nombre"];
    $apellidos = $usuario["apellidos"];
    $clave = $usuario["clave"];
    $correo = $usuario["correo"];
    $fecha_nacimiento = $usuario["fecha_nacimiento"];
    $id_rol = $usuario["id_rol"];
    $nick = $usuario["nick"];
}

$bd->desconectar();
require_once("../vista/vista_perfil.php");
?>