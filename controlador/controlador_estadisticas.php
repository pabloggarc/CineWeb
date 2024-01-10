<?php
    require_once("../modelo/Datos.php");
    require_once("../config.php");

    function generar_color() {
        $rojo = mt_rand(0, 255);
        $verde = mt_rand(0, 255);
        $azul = mt_rand(0, 255);
        $colorHexadecimal = sprintf("#%02X%02X%02X", $rojo, $verde, $azul);
    
        return $colorHexadecimal;
    }

    $bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
    $bd->conectar();

    $sesiones_hoy = $bd->get_numero_sesiones();
    $sesiones_futuras = $bd->get_numero_sesiones_futuras();
    $numero_usuarios = $bd->get_numero_usuarios();
    $numero_peliculas_disponibles = $bd->get_numero_peliculas_disponibles();
    $valoracion_media = round($bd->get_valoracion_media(), 2);
    $numero_butacas_reservadas = $bd->get_numero_butacas_reservadas();
    $numero_butacas = $bd->get_numero_butacas();
    $numero_butacas_ocupadas = $bd->get_numero_butacas_ocupadas();
    $numero_reservas_peliculas = $bd->get_reservas_peliculas(); 
    $ranking_peliculas_vistas = $bd->get_ranking_peliculas_vistas();
    $ranking_peliculas_valoradas = $bd->get_ranking_peliculas_valoradas();

    $colores = array('red', 'green', 'blue', 'silver', 'gold', 'yellow', 'orange', 'pink', 'black', 'purple', 'brown', 'white'); 

    $map = array_map(
        null, 
        array_column($numero_reservas_peliculas, 'nombre'), 
        array_column($numero_reservas_peliculas, 'reservas')
    );
    $datos = substr(strval(json_encode($map)), 1, strlen(strval(json_encode($map))) - 2);

    $map2 = array_map(
        null, 
        array_column($ranking_peliculas_vistas, 'nombre'), 
        array_column($ranking_peliculas_vistas, 'count')
    );
    $datos2 = substr(strval(json_encode($map2)), 1, strlen(strval(json_encode($map2))) - 2);

    $colores_3 = array_map('generar_color', range(1, count($ranking_peliculas_valoradas)));
    $map3 = array_map(
        null, 
        array_column($ranking_peliculas_valoradas, 'nombre'), 
        array_column($ranking_peliculas_valoradas, 'valoracion_media'), 
        $colores_3
    );
    
    $datos3 = substr(strval(json_encode($map3)), 1, strlen(strval(json_encode($map3))) - 2);

    $colores_4 = array_map('generar_color', range(1, count($ranking_peliculas_vistas)));
    $map4 = array_map(
        null, 
        array_column($ranking_peliculas_vistas, 'nombre'), 
        array_column($ranking_peliculas_vistas, 'count'), 
        $colores_4
    );
    
    $datos4 = substr(strval(json_encode($map4)), 1, strlen(strval(json_encode($map4))) - 2);

    $bd->desconectar();
    require_once("../vista/vista_estadisticas.php");
?>