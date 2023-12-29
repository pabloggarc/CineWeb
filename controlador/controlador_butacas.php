<?php
    require_once("modelo/Datos.php");

    $bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
    $bd->conectar();

    if(isset($_GET["sala"])){
        $nombre_sala = $_GET["sala"];
        $dim = $bd->get_dim_sala($nombre_sala); 
        $filas = 0;
        $columnas = 0;
        if($dim != null){
            $filas = $dim[0];
            $columnas = $dim[1];
        }
    }
    else{
        echo "Error: No se ha especificado una sala";
        exit(); 
    }

    // Crear un array de los estados de las butacas para los colores de la vista

    $bd->desconectar();
    require_once("vista/vista_butacas.php");
?>