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
    $tipo = $_POST['tipo'];

    if (is_null($bd->get_genero_por_tipo($tipo))) {
        $bd->insertar_genero($tipo);
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
                            title: "<span style=\'color: red;\'>GENERO EXISTENTE</span>",
                            html: "<span style=\'color: #333;\'>El genero introducido ya existe</span>",
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