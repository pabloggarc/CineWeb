<?php
    require_once("../modelo/Datos.php");
    require_once("../config.php");
    $bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

    $bd->conectar();


    // Procesamiento del formulario de inicio de sesion
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre_sala'];
        $filas = (int) $_POST['n_filas'];
        $columnas = (int) $_POST['n_col'];

        $bd->insertar_sala($nombre, $filas, $columnas);
    }


    $bd->desconectar();
    require_once("../vista/vista_admin_inicio.php"); 
?>