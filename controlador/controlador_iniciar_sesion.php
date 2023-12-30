<?php
require_once("../modelo/Datos.php");
require_once("../config.php");
$bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

$bd->conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nick = $_POST["nick"];
    $clave = $_POST["clave"];


    $esta_registrado = $bd->consultar_usuario_por_nick_y_clave($nick, $clave);
    if ($esta_registrado) {
        header("Location: ../vista/inicio.php");
    } else {
        // Mostramos la alerta de que el nickname y/o la clave de acceso son incorrectas
        echo '
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "error",
                title: "<span style=\'color: red;\'>Credenciales incorrectos</span>",
                html: "<span style=\'color: #333;\'>El nickname y/o la clave de acceso son incorrectas</span>",
                confirmButtonText: "<span style=\'color: #fff;\'>OK</span>",
                customClass: {
                    confirmButton: \'btn btn-danger\',
                    cancelButton: \'btn btn-secondary\'
                }
            }).then(function() {
                window.location.href="../login.php";
            });
        });
    </script>';
    }
}


$bd->desconectar();
?>