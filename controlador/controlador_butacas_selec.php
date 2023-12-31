<?php
    // Esto es lo que se tiene que ejecutar desde el JS, hay que arreglarlo
    session_start();
    $id_butacas = array(); 
    if(isset($_POST['butacas_seleccionadas'])) {
        $id_butacas = $_POST['butacas_seleccionadas'];
        $_SESSION['butacas_seleccionadas'] = $id_butacas;   
    }
?>