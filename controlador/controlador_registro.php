<?php
require_once("../modelo/Datos.php");
require_once("../config.php");

$bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

$bd->conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nick = $_POST["nick"];
    $clave = $_POST["clave"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $email = $_POST["email"];
    $fecha = $_POST["fecha"];


    // Procesar los datos (en este ejemplo, simplemente imprimirlos)
    echo "Registro exitoso:<br>";
    echo "Nick: $nick<br>";
    echo "Clave: $clave<br>";
    echo "Nombre: $nombre<br>";
    echo "Apellidos: $apellido<br>";
    echo "Correo Electrónico: $email<br>";
    echo "Fecha de nacimiento: $fecha<br>";

    $bd->insertar_nuevo_usuario($nick, $clave, $nombre, $apellido, $email, $fecha);

} else {
    // Redirigir o manejar el error según sea necesario
    echo "Acceso no permitido";
}


$bd->desconectar();
header("Location: ../loginBueno.php"); 
?>