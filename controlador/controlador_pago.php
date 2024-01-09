<?php
    require_once("../modelo/Datos.php");
    require_once("../config.php");

    session_start();
    if (isset($_SESSION["pelicula"])) {
        $id_pelicula = $_SESSION["pelicula"];
        $bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
        $bd->conectar();
        $pelis = $bd->get_peliculas_por_id($id_pelicula);
        foreach ($pelis as $peli) {
            $titulo = $peli["titulo"];
            $duracion = $peli["duracion"];
            $año = $peli["año"];
        }
        $clasificacion = $bd->get_peliculas_clasificacion($id_pelicula);
        $genero = $bd->get_genero_por_pelicula($id_pelicula);
        $nacionalidad = $bd->get_nacionalidad_pelicula($id_pelicula);
        $nacionalidad = $nacionalidad[0]["nombre"];
        $hora = $_SESSION["hora"];
        $fecha = $_SESSION["fecha"];
        $portada = $bd->get_portada_por_id($id_pelicula);
        $imagen = $portada[0]['portada'];
        $bd->desconectar();
        
        require_once("../vista/vista_pago.php");

    } else {
        echo "No se ha seleccionado ninguna película";
    }
?>