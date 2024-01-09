<?php
    require_once("../modelo/Datos.php");
    require_once("../config.php");
    $bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

    $bd->conectar();


    // Procesamiento del formulario de inicio de sesion
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['boton'];
        $info = $bd->get_info_total_peliculas_por_id($id)[0];
        $lista_clasificacion = $bd->get_clasificacion();
        $lista_distribuidora = $bd->get_distribuidora();
        session_start();
        $_SESSION['id'] = $info['id'];
    }

    $bd->desconectar();
    require_once("../vista/vista_modificar_peliculas.php")
?>