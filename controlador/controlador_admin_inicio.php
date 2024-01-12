<?php
session_start();
if (isset($_SESSION['nick']) && $_SESSION['rol_usuario'] == 2) {
    require_once("../vista/vista_admin_inicio.php");
} else {
    header("Location: ../vista/vista_login.php");
} 
?>