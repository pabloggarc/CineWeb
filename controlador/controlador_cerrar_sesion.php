<?php
require_once("../modelo/Datos.php");
require_once("../config.php");
// Eliminamos los datos de la sesion
session_unset();
// Destruimos la sesion
session_destroy();
// Redirigimos al usuario a la pagina del login
header('Location: ../login.php');
?>