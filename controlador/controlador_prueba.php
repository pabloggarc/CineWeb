<?php
    require_once("modelo/Datos.php");

    $bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
    $bd->conectar();
    $pruebas = $bd->get_pruebas();

    require_once("vista/prueba_vista.php");
?>