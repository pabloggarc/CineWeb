<?php
    session_start();
    $entradas_selec = array(); 
    if(isset($_POST['peliculas_seleccionadas[]'])) {
        $entradas_selec = $_POST['peliculas_seleccionadas[]'];
        $_SESSION['peliculas_seleccionadas[]'] = $entradas_selec;   
    }
?>