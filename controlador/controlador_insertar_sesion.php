<?php
session_start();
if (!(isset($_SESSION['rol_usuario'])) || $_SESSION['rol_usuario']==1) {
    header("Location: ../vista/vista_login.php");
}
require_once("../modelo/Datos.php");
require_once("../config.php");
$bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

$bd->conectar();


// Procesamiento del formulario de inicio de sesion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_sala = $_POST['sala'];
    $id_pelicula = $_POST['pelicula'];
    $id_pase = $_POST['pase'];
    $aux = $bd->get_sesion_por_ids($id_sala, $id_pelicula, $id_pase);
    if (is_null($aux)) {
        $bd->insertar_sesion($id_sala, $id_pelicula, $id_pase);
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
                    title: "<span style=\'color: red;\'>INSERCION INCORRECTA</span>",
                    html: "<span style=\'color: #333;\'>La sesion introducida ya existe</span>",
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