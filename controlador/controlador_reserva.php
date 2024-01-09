<?php
    require_once("../modelo/Datos.php");
    require_once("../config.php");
    $bd = new Datos(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
    $bd->conectar();
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['accountNumber'])) {
            $_SESSION['error'] = "Debe introducir un valor en el Número de Cuenta.";
            header("Location: ../controlador/controlador_pago.php"); // Reemplaza con el nombre de tu archivo de formulario
            exit;
        } else {

            $usuario = $_SESSION["nick"];
            $id_usuario = $bd->get_usuario_por_nick($usuario);
            $id_usuario = $id_usuario[0]["id"];
            $id_butaca = $_SESSION["butacas_seleccionadas"];
            $id_pelicula = $_SESSION["pelicula"];
            $fecha = $_SESSION["fecha"];
            $hora = $_SESSION["hora"];
            $datos_entrada = $bd->get_datos_entrada($id_pelicula, $hora, $fecha);
            $id_pase_sesion = $datos_entrada[0]["id_pase"];
            $id_sala = $datos_entrada[0]["id_sala"];
            $ver_butacas = true;
            $i = 0;
            while ($i < count($id_butaca) && $ver_butacas) {
                $ver_butacas = $bd->consultar_butaca_entrada($id_butaca[$i], $id_pase_sesion, $id_sala, $id_pelicula);
                if ($ver_butacas) {
                    $_SESSION['error'] = "La butaca ya está reservada.";
                    header("Location: ../controlador/controlador_pago.php");
                    exit;
                }
                $i++;
            }
            for ($i = 0; $i < count($id_butaca); $i++) {
                $verificar = true;
                while ($verificar) {
                    $numero_aleatorio = rand(1, 5000000000);
                    $verificar = $bd->consultar_localizador($numero_aleatorio);
                }
                $bd->set_entrada_usuario_por_id($numero_aleatorio, $id_usuario, $id_butaca[$i], $id_pase_sesion, $id_sala, $id_pelicula);
            }
            $bd->desconectar();
            header("Location: ./controlador_mostrar_cartelera.php");
        }
    }
?>