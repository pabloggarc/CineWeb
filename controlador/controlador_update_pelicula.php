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
    $id = $_SESSION['id'];
    $nombre = $_POST['nombre_pelicula'];
    $sinopsis = $_POST['sinopsis'];
    $url_web = $_POST['url_web'];
    $titulo = $_POST['titulo'];
    $duracion = $_POST['duracion'];
    $anno = $_POST['anno'];
    $portada = $_POST['portada'];
    $clasificacion = $_POST['clasificacion'];
    $distribuidora = $_POST['distribuidora'];
    $actores = $_POST['actores'];
    $nacionalidad = $_POST['nacionalidad'];
    $director = $_POST['director'];
    $generos = $_POST['generos'];

    $aux = $bd->get_id_pelicula($nombre, $anno, $duracion);
    $peli_original = $bd->get_peliculas_por_id($id)[0];
    if (is_null($aux) || $aux == $id) {
        $bd->update_pelicula_por_id($id, $nombre, $sinopsis, $url_web, $titulo, $duracion, $anno, $portada, $clasificacion, $distribuidora, $actores, $nacionalidad, $director, $generos);
        $bd->desconectar();
        header("Location: ../controlador/controlador_admin_inicio.php");
    } else {
        $bd->desconectar();
        echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "error",
                    title: "<span style=\'color: red;\'>PELICULA EXISTENTE</span>",
                    html: "<span style=\'color: #333;\'>La pelicula introducida ya existe en la base de datos</span>",
                    confirmButtonText: "<span style=\'color: #fff;\'>OK</span>",
                    customClass: {
                        confirmButton: \'btn btn-danger\',
                        cancelButton: \'btn btn-secondary\'
                    }
                }).then(function() {
                    window.location.href="../controlador/controlador_admin_inicio.php";
                });
            });
        </script>';
    }
}
?>