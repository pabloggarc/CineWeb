<?php
require_once("../modelo/Datos.php");
require_once("../config.php");

$bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

$bd->conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Almacenamos cada uno de los valores que ha introducido el usuario
    $nick = $_POST["nick"];
    $clave = $_POST["clave"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $email = $_POST["email"];
    $fecha = $_POST["fecha"];
    

    // Comprobamos si el usuario con el nick se encuentra registrado en la base de datos
    $posible = $bd->consultar_usuario_por_nick($nick);
    // Si el usuario no se encuentra en la base de datos
    if($posible){
        // Insertamos el usuario en la base de datos
        $bd->insertar_nuevo_usuario($nick, $clave, $nombre, $apellido, $email, $fecha);
    }else{
        // Mostramos la alerta de que el usuario ya se encuentra registrado en la base de datos
        echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "error",
                    title: "<span style=\'color: red;\'>NICKNAME EN USO</span>",
                    html: "<span style=\'color: #333;\'>El nickname se encuentra en uso</span>",
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

} else {
    // Redirigir o manejar el error según sea necesario
    echo "Acceso no permitido";
}


$bd->desconectar();
?>