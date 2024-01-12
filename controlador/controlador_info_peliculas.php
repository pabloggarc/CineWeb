<?php
session_start();
if (!(isset($_SESSION['nick'])) || $_SESSION['rol_usuario'] == 2) {
    header("Location: ../vista/vista_login.php");
}
require_once("../modelo/Datos.php");
require_once("../config.php");

if (isset($_SESSION["pelicula"])) {
    $id_pelicula = $_SESSION["pelicula"];
    $bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
    $bd->conectar();
    $pelis = $bd->get_peliculas_por_id($id_pelicula);
    foreach ($pelis as $peli) {
        $titulo = $peli["titulo"];
        $sinopsis = $peli["sinopsis"];
        $duracion = $peli["duracion"];
        $año = $peli["año"];
    }
    $valoraciones = $bd->get_peliculas_valoraciones($id_pelicula);
    $clasificacion = $bd->get_peliculas_clasificacion($id_pelicula);
    $genero = $bd->get_genero_por_pelicula($id_pelicula);
    $director = $bd->get_directores_por_pelicula($id_pelicula);
    $actores = $bd->get_actores_por_pelicula($id_pelicula);
    $nacionalidad = $bd->get_nacionalidad_pelicula($id_pelicula);
    $nacionalidad = $nacionalidad[0]["nombre"];
    $val_com = $bd->get_comentarios_valoraciones($id_pelicula);

    $portada = $bd->get_portada_por_id($id_pelicula);
    $imagen = $portada[0]['portada'];
    $bd->desconectar();

    require_once("../vista/vista_informacion_peliculas.php");

} else {
    echo "No se ha seleccionado ninguna película";
}
?>