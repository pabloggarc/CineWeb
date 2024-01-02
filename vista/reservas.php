<?php
// Incluye el contenido de pagina1.php
include '../controlador/controlador_ver_reservas.php';
?>

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
                <a href="perfil.php">PERFIL</a>
                <a href="reservas.php">VISTA ENTRADA</a>
            </div>
        </nav>

        <table class="table" name="tabla_entradas" id="tabla_entradas">
            <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>Butaca(Fila-Col)</th>

</tr>
        <?php
        for ($i = 0; $i < count($nombre_pelicula); $i++) {
            echo "<tr>";
            echo "<td><br>".$nombre_pelicula[$i]."</td>";
            echo "<td><br>".$hora[$i]."</td>";
            echo "<td><br>".$dia[$i]."</td>";
            echo "<td><br>".$sala[$i]."</td>";
            for ($j = 0; $j < count($butaca_fila[$i]); $j++) {
                echo "<td><br>".$butaca_fila[$i][$j]. " - ".$butaca_columna[$i][$j]."</td>";
            }
            echo '<td>
            <input type="checkbox" name="color[]"></td>';
            echo "</tr>";
        }
        echo '<button type="button" onclick="obtenerFilasSeleccionadas()">Borrar Selección</button>';
        ?>
    </table>
    </body>

    <script>

function obtenerFilasSeleccionadas() {
            // Obtener todas las checkboxes
            var checkboxes = document.getElementsByName('color[]');
            
            // Array para almacenar las filas seleccionadas
            var filasSeleccionadas = [];

            // Iterar sobre las checkboxes
            for (var i = 0; i < checkboxes.length; i++) {
                // Verificar si la checkbox está marcada
                if (checkboxes[i].checked) {
                    // Obtener la fila padre de la checkbox y agregarla al array
                    var fila = checkboxes[i].closest('tr');
                    filasSeleccionadas.push(fila.textContent.trim());
                }
            }

            // Mostrar información de las filas seleccionadas (puedes hacer lo que quieras con esta información)
            if (filasSeleccionadas.length > 0) {
                alert('Filas seleccionadas:\n' + filasSeleccionadas.join('\n'));
            } else {
                alert('Ninguna fila seleccionada.');
            }
        }
    </script>


</html>