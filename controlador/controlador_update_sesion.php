<?php
    require_once("../modelo/Datos.php");
    require_once("../config.php");
    $bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

    $bd->conectar();


    // Procesamiento del formulario de inicio de sesion
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ids = explode(";", $_POST['boton']);
        $id_sala_new = $_POST['sala'];
        $id_pelicula_new = $_POST['pelicula'];
        $id_pase_new = $_POST['pase'];

        $bd->update_sesion($ids[0], $ids[1], $ids[2], $id_sala_new, $id_pelicula_new, $id_pase_new);
    }


    $bd->desconectar();
    header("Location: ../controlador/controlador_admin_inicio.php");
?>