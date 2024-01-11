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
    $nombre = $_POST['nombre_pelicula'];
    $sinopsis = $_POST['sinopsis'];
    $url_web = $_POST['url_web'];
    $titulo = $_POST['titulo'];
    $duracion = $_POST['duracion'];
    $anno = $_POST['anno'];
    $portada = $_POST['portada'];
    $clasificacion = $_POST['clasificacion'];
    $distribuidora = $_POST['distribuidora'];
    $id_nacionalidad = $_POST['nacionalidad'];
    $actor = $_POST['actores'];
    $director = $_POST['director'];
    $generos = $_POST['generos'];

    $aux = $bd->get_id_pelicula($nombre, $anno, $duracion);

    if (is_null($aux)) {
        $bd->insertar_pelicula($nombre, $sinopsis, $url_web, $titulo, $duracion, $anno, $portada, $clasificacion, $distribuidora);
        $id_pelicula = $bd->get_id_pelicula($nombre, $anno, $duracion);
        $bd->insertar_nacionalidad_pelicula($id_nacionalidad, $id_pelicula);
        foreach ($actor as $i) {
            $bd->insertar_actor_pelicula($i, $id_pelicula);
        }
        foreach ($director as $j) {
            $bd->insertar_director_pelicula($j, $id_pelicula);
        }
        foreach ($generos as $k) {
            $bd->insertar_genero_pelicula($k, $id_pelicula);
        }
        $bd->desconectar();
        header("Location: ../controlador/controlador_admin_inicio.php");
    } else {
        echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "error",
                    title: "<span style=\'color: red;\'>INSERCION INCORRECTA</span>",
                    html: "<span style=\'color: #333;\'>La pelicula ya se encuentra registrada</span>",
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