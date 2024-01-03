<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/Html.html to edit this template
-->
<html>

<head>
    <title>Información del usuario</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilosPerfil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="../estilos.css">

</head>

<body>
    <nav>
        <img src="./imagenes/CINE+.png" class="logo" alt="Logo de la página">
        <div class="opciones">
            <a href="../controlador/controlador_perfil.php">PERFIL</a>
            <a href="../controlador/controlador_ver_reservas.php">VISTA ENTRADA</a>
            <a href="../controlador/controlador_peliculas_vistas.php">PELICULAS VISTAS</a>
        </div>
    </nav>
    <form method="POST" action="../controlador/controlador_eliminar_reserva.php">
        <table class="table" name="tabla_entradas" id="tabla_entradas">
            <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>Butaca(Fila-Col)</th>

            </tr>
            <?php
            $fecha_actual = date('Y-m-d');
            $hora_actual = date('H:i:s');
            for ($i = 0; $i < count($nombre_pelicula); $i++) {
                for ($j = 0; $j < count($butaca_fila[$i]); $j++) {
                    echo "<tr>";
                    echo "<td><br>" . $nombre_pelicula[$i] . "</td>";
                    echo "<td><br>" . $hora[$i] . "</td>";
                    echo "<td><br>" . $dia[$i] . "</td>";
                    echo "<td><br>" . $sala[$i] . "</td>";
                    echo "<td><br>" . $butaca_fila[$i][$j] . " - " . $butaca_columna[$i][$j] . "</td>";
                    $valor = "$nombre_pelicula[$i];$hora[$i];$dia[$i];$sala[$i];" . $butaca_fila[$i][$j] . ";" . $butaca_columna[$i][$j] . "";
                    echo "<td> <input type='checkbox' name='filas_seleccionadas[]' value='" . $valor . "'></td>";
                    echo "</tr>";
                }
            }
            echo '<input type="submit" name="submit" value="Eliminar Selecciones">';
            ?>
        </table>
    </form>
</body>

</html>