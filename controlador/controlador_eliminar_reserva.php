<?php
session_start();
if (!(isset($_SESSION['nick']))) {
    header("Location: ../vista/vista_login.php");
}
require_once("../modelo/Datos.php");
require_once("../config.php");
$bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
$bd->conectar();

$nick = $_SESSION['nick'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han enviado las filas seleccionadas
    if (isset($_POST['filas_seleccionadas']) && is_array($_POST['filas_seleccionadas'])) {
        // Recorrer y mostrar las filas seleccionadas (para propósitos de demostración)
        echo "Filas seleccionadas:\n";
        foreach ($_POST['filas_seleccionadas'] as $filaSeleccionada) {
            $pelicula_seleccionada = explode(";", $filaSeleccionada);
            $bd->eliminar_entrada_por_pelicula($nick, $pelicula_seleccionada[0], $pelicula_seleccionada[1], $pelicula_seleccionada[2], $pelicula_seleccionada[3], $pelicula_seleccionada[4], $pelicula_seleccionada[5]);
        }

    } else {
        echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

            <script type="text/javascript">
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "<span style=\'color: red;\'>NO SE HA SELECCIONADO NINGUNA PELICULA</span>",
                        html: "<span style=\'color: #333;\'>No se completa la acción porque no se ha seleccionado ninguna reserva</span>",
                        confirmButtonText: "<span style=\'color: #fff;\'>OK</span>",
                        customClass: {
                            confirmButton: \'btn btn-danger\',
                            cancelButton: \'btn btn-secondary\'
                        }
                    }).then(function() {
                        window.location.href="../vista/vista_reservas.php";
                    });
                });
            </script>';
    }

} else {
    echo "Acceso denegado."; // Otras acciones si el método de solicitud no es POST
}

$bd->desconectar();
header("Location: ../controlador/controlador_ver_reservas.php");
?>