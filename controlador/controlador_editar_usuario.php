<?php
require_once("../modelo/Datos.php");
require_once("../config.php");
$bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

$bd->conectar();


// Procesamiento del formulario de inicio de sesion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nick = $_POST['nick'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $bd->update_usuario_por_nick($nick, $nombre, $apellidos, $correo, $fecha_nacimiento);
}

$bd->desconectar();
// CAMBIAR VISTA A CONTROLADOR PERFIL
require_once("../controlador/controlador_perfil.php") 
    ?>