<!DOCTYPE html>
<html>

<head>
    <title>RESERVAS</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilosCine.css">
    <link rel="stylesheet" href="../css/estilos_cabecera.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        crossorigin="anonymous" />
    <link rel="icon" href="../imagenes/cineLogo.PNG" type="image/jpg">
</head>

<body>
    <?php
    if (!(isset($_SESSION['rol_usuario'])) || $_SESSION['rol_usuario'] == 2) {
        header("Location: ../vista/vista_login.php");
    }
    ?>
    <?php require_once("vista_cabecera.php") ?>
    <form method="POST" action="../controlador/controlador_eliminar_reserva.php">
        <table id="tablaDatos" name="tabla_entradas">
            <tr>
                <th>Titulo</th>
                <th>Hora</th>
                <th>Día</th>
                <th>Sala</th>
                <th>Localizador</th>
                <th>Fila</th>
                <th>Butaca</th>
                <th>Selección</th>

            </tr>
            <?php
            $fecha_actual = date('Y-m-d');
            $hora_actual = date('H:i:s');
            for ($i = 0; $i < count($nombre_pelicula); $i++) {
                echo "<tr>";
                echo "<td><br>" . $nombre_pelicula[$i] . "</td>";
                echo "<td><br>" . $hora[$i] . "</td>";
                echo "<td><br>" . $dia[$i] . "</td>";
                echo "<td><br>" . $sala[$i] . "</td>";
                echo "<td><br>" . $localizador[$i] . "</td>";
                echo "<td><br>" . $butaca_fila[$i] . "</td>";
                $col = ($butaca_fila[$i] - 1) * $columnas[$i] + $butaca_columna[$i];
                echo "<td><br>" . $col . "</td>";
                $valor = "$nombre_pelicula[$i];$hora[$i];$dia[$i];$sala[$i];" . $butaca_fila[$i] . ";" . $butaca_columna[$i] . "";
                echo "<td> <input type='checkbox' name='filas_seleccionadas[]' value='" . $valor . "'></td>";
                echo "</tr>";
            }
            ?>
        </table>
        <div class="centrar">
            <?php if (count($nombre_pelicula) > 0) {
                echo '<input type="submit" name="submit" value="Eliminar Selecciones">';
            } ?>
        </div>
    </form>
</body>

</html>