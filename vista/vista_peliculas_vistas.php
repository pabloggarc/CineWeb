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
    <link rel="stylesheet" href="../estilosCine.css">
    <link rel="stylesheet" href="../estilos_cabecera.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        crossorigin="anonymous" />

</head>

<body>
<?php require_once("vista_cabecera.php") ?>

    <form method='POST' action='../controlador/controlador_mostrar_comentario.php'>
        <table id="tablaDatos" name="tablaDatos">
            <tr>
                <th>Titulo</th>
                <th>Hora</th>
                <th>Día</th>
                <th>Sala</th>
                <th>Accion</th>
            </tr>
            <?php
            for ($i = 0; $i < count($nombre_pelicula); $i++) {
                echo "<tr>";
                echo "<td><br>" . $nombre_pelicula[$i] . "</td>";
                echo "<td><br>" . $hora[$i] . "</td>";
                echo "<td><br>" . $dia[$i] . "</td>";
                echo "<td><br>" . $sala[$i] . "</td>";
                $valor = "$nombre_pelicula[$i];$hora[$i];$dia[$i];$sala[$i]";
                if($visto[$i]['visto']==0){
                    echo "<td><button type='submit' name='boton' value='" . $valor . "''>COMENTAR</button></td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
    </form>
</body>

</html>