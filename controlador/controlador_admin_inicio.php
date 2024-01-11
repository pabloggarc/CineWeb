<?php
session_start();
if (isset($_SESSION['nick'])) {
    if($_SESSION['rol_usuario'] == 2){
        require_once("../vista/vista_admin_inicio.php");
    }else{
        // Alerta 
    }
} else {
    header("Location: ../vista/vista_login.php");
}
?>