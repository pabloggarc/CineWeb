<?php
session_start();
if (isset($_SESSION['nick'])) {
    if ($_SESSION['rol_usuario'] == 1) {
        header("Location: ../vista/vista_login.php");
    }
} else {
    header("Location: ../vista/vista_login.php");
}
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
    $lista_nacionalidad = $bd->get_nacionalidad();
    $info_nacionalidad = $bd->get_nacionalidad_por_id_pelicula($id);
    $lista_actor = $bd->get_actores();
    $info_actores = $bd->get_reparto_por_id_pelicula($id);
    $lista_director = $bd->get_directores();
    $info_director = $bd->get_direccion_por_id_pelicula($id);
    $lista_genero = $bd->get_generos();
    $info_generos = $bd->get_genero_por_id_pelicula($id);
    session_start();
    $_SESSION['id'] = $info['id'];
}

$bd->desconectar();
require_once("../vista/vista_modificar_peliculas.php")
    ?>