<?php
    require_once("modelo/Datos.php");

    $bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
    $bd->conectar();

    if(isset($_GET["sala"]) && isset($_GET["dia"]) && isset($_GET["hora"])){  
        $nombre_sala = $_GET["sala"];
        $fecha = $_GET["dia"];
        $hora = $_GET["hora"]; 

        $dim = $bd->get_dim_sala($nombre_sala); 
        $libre = $bd->get_ocupacion_sala($nombre_sala, $fecha, $hora);

        $filas = 0;
        $columnas = 0;
        if($dim != null){
            $filas = $dim[0];
            $columnas = $dim[1];
        }
    }
    else{
        echo "Error: No se ha especificado una sala, día y hora";
        exit(); 
    }

    $bd->desconectar();
    require_once("vista/vista_butacas.php");
?>