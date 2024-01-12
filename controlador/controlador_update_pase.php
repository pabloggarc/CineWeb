<?php
session_start();
if (!(isset($_SESSION['nick']))) {
    header("Location: ../vista/vista_login.php");
}
require_once("../modelo/Datos.php");
require_once("../config.php");
$bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

$bd->conectar();


// Procesamiento del formulario de inicio de sesion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['boton'];
    $dia = $_POST['dia'];
    $hora = $_POST['hora'];
    if (is_null($bd->get_pase_hora_dia($hora, $dia))) {
        $bd->update_pase_por_id($id, $dia, $hora);
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
                    title: "<span style=\'color: red;\'>ACTUALIZACIÓN INCORRECTA</span>",
                    html: "<span style=\'color: #333;\'>Los valores introducidos ya existen</span>",
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