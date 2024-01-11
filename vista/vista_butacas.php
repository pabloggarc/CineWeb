<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título de la Página</title>
    <link rel="stylesheet" href="../estilos_cabecera.css">
    <link rel="stylesheet" href="../estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="../imagenes/cineLogo.PNG" type="image/jpg">

    <?php
    if ($_SESSION['rol_usuario'] == 1) {
        echo "<script src='https://code.jquery.com/jquery-3.6.4.min.js'></script><script src='../js/butacas.js'></script>";
    }
    ?>
</head>

<body>
    <?php
    if ($_SESSION['rol_usuario'] == 1) {
        require_once("vista_cabecera.php");
    } else {
        require_once("vista_cabecera_admin.php");
    }
    ?>

    <div class="center-div">
        <h1>Sala
            <?php echo $nombre_sala; ?>
        </h1>
        <table class="table" name="tabla_butacas" id="tabla_butacas">
            <?php
            for ($i = 0; $i < $filas; $i++) {
                echo "<tr>";
                for ($j = 0; $j < $columnas; $j++) {
                    $id_butaca = $i * $columnas + $j;
                    if ($libre[$id_butaca] == 1) {
                        echo "<td class='butaca_libre' id='" . ($ids_butacas[$id_butaca]) . "'>
                            <div class='tooltip'><i class='fas fa-couch'>
                            </i><br>" . ($id_butaca + 1) . "
                            <span class='tooltiptext'>Butaca libre</span></td></div>";
                    } else if ($_SESSION["rol_usuario"] == 2) {
                        echo "<td class='butaca_ocupada' id='" . ($ids_butacas[$id_butaca]) . "'>
                            <div class='tooltip'><i class='fas fa-couch'>
                            </i><br>" . ($id_butaca + 1) . "
                            <span class='tooltiptext'>Butaca reservada por " . $ocupantes[$id_butaca] . "</span></td></div>";
                    } else if ($_SESSION["rol_usuario"] == 1) {
                        echo "<td class='butaca_ocupada' id='" . ($ids_butacas[$id_butaca]) . "'>
                            <div class='tooltip'><i class='fas fa-couch'>
                            </i><br>" . ($id_butaca + 1) . "
                            <span class='tooltiptext'>Butaca reservada</span></td></div>";
                    }
                    if ($j + 1 == $columnas / 2) {
                        echo "<td class='pasillo'>" . str_repeat("&nbsp", PASILLO_SIZE) . "</td>";
                    }
                }
                echo "</tr>";
            }
            ?>
        </table>
        <?php
        if ($_SESSION["rol_usuario"] == 1) {
            echo '<button id="boton_conf_entradas">Confirmar entradas</button>';
        } else {
            echo "<form method='POST' action='../controlador/controlador_admin_inicio.php'>";
            echo '<button id="boton_conf_entradas">Volver</button>';
            echo '</form>';
        }
        ?>
    </div>
</body>

</html>