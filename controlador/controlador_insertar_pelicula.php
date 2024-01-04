<?php
require_once("../modelo/Datos.php");
require_once("../config.php");
$bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

$bd->conectar();


// Procesamiento del formulario de inicio de sesion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre_pelicula'];
    $sinopsis = $_POST['sinopsis'];
    $url_web = $_POST['url_web'];
    $titulo = $_POST['titulo'];
    $duracion = $_POST['duracion'];
    $anno = $_POST['anno'];
    $portada = $_POST['portada'];
    $clasificacion = $_POST['clasificacion'];
    $distribuidora = $_POST['distribuidora'];

    $bd->insertar_pelicula($nombre, $sinopsis, $url_web, $titulo, $duracion, $anno, $portada, $clasificacion, $distribuidora);
}


$bd->desconectar();
require_once("../vista/vista_admin_inicio.php")
    ?>