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
    $nombre = $_POST['nombre_sala'];
    $filas = (int) $_POST['n_filas'];
    $columnas = (int) $_POST['n_col'];

    $aux = $bd->get_sala_por_nombre($nombre);
    if (is_null($aux)) {
        $bd->insertar_sala($nombre, $filas, $columnas);
    } else {
        echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "error",
                    title: "<span style=\'color: red;\'>NOMBRE DE SALA EN USO</span>",
                    html: "<span style=\'color: #333;\'>El nombre de sala introducido se encuentra en uso</span>",
                    confirmButtonText: "<span style=\'color: #fff;\'>OK</span>",
                    customClass: {
                        confirmButton: \'btn btn-danger\',
                        cancelButton: \'btn btn-secondary\'
                    }
                }).then(function() {
                    window.location.href=" ../vista/vista_insertar_sala.php";
                });
            });
        </script>';
    }
}


$bd->desconectar();
header("Location: ../controlador/controlador_admin_inicio.php");
?>