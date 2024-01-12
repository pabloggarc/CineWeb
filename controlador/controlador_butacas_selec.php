<?php
session_start();
if (isset($_POST['butacas_seleccionadas'])) {
    $_SESSION['butacas_seleccionadas'] = $_POST['butacas_seleccionadas'];
}
?>