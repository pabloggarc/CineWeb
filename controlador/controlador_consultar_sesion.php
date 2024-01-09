<?php
    require_once("../modelo/Datos.php");
    require_once("../config.php");
    $bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

    $bd->conectar();


    // Procesamiento del formulario de inicio de sesion
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ids = explode(";", $_POST['boton']);
        $sesion = $bd->get_sesion_por_ids($ids[0], $ids[1], $ids[2]);
        $lista_peliculas = $bd->get_peliculas_id_nombre();
        $lista_salas = $bd->get_salas_id_nombre();
        $lista_pases = $bd->get_pases_id_fecha();
    }

    $bd->desconectar();
    require_once("../vista/vista_modificar_sesion.php")
?>