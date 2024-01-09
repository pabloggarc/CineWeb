<?php
    require_once("../modelo/Datos.php");
    require_once("../config.php");
    $bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
    $bd->conectar();


    session_start();
    $nick = $_SESSION['nick'];
    $lista_entradas = $bd->get_peliculas_no_vistas_por_nick($nick);

    $nombre_pelicula = array();
    $hora = array();
    $dia = array();
    $sala = array();
    $id_entrada = array();
    $butaca_fila = array();
    $butaca_columna = array();
    $localizador=array();
    $columnas=array();
    if (!is_null($lista_entradas)) {
        foreach ($lista_entradas as $entrada) {
            $aux_fila = array();
            $aux_columna = array();
            $aux_localizador = array();
            $nombre_pelicula[] = $entrada['nombre'];
            $hora[] = $entrada['hora'];
            $dia[] = $entrada['dia'];
            $sala[] = $entrada['sala'];
            $lista_butacas = $bd->get_butaca_por_entrada($nick, $entrada['nombre'], $entrada['dia'], $entrada['hora'], $entrada['sala']);
            $columnas[] = $bd->get_dim_sala($entrada['sala'])[1];
            foreach ($lista_butacas as $b) {
                $aux_fila[] = $b['fila'];
                $aux_columna[] = $b['columna'];
                $aux_localizador[] = $b['localizador'];
            }
            $localizador[] = $aux_localizador;
            $butaca_fila[] = $aux_fila;
            $butaca_columna[] = $aux_columna;
        }
    }
    $bd->desconectar();
    require_once("../vista/vista_reservas.php");
?>