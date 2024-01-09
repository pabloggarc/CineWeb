<?php
    require_once("../modelo/Datos.php");
    require_once("../config.php");
    $bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

    $bd->conectar();


    // Procesamiento del formulario de inicio de sesion
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['boton'])) {
            $opcion_selec = $_POST['boton'];
            if ($opcion_selec == 1) {
                $lista_clasificacion = $bd->get_clasificacion();
                $lista_distribuidora = $bd->get_distribuidora();
                require_once('../vista/vista_insertar_pelicula.php');
            } else {
                $lista_peliculas = $bd->get_peliculas();
                if ($opcion_selec == 2) {
                    require_once('../vista/vista_eliminar_pelicula.php');
                } else {
                    require_once('../vista/vista_consultar_pelicula.php');
                }
            }
        }
    }


    $bd->desconectar();
?>