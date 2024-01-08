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

<?php require_once("vista_cabecera.php") ?>

    <form method='POST' action='../controlador/controlador_eliminar_sala.php'>
        <table class="table" name="tabla_entradas" id="tabla_entradas">
            <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
            </tr>
            <?php
            for ($i = 0; $i < count($lista_salas); $i++) {
                echo "<tr>";
                echo "<td><br>" . $lista_salas[$i]['nombre'] . "</td>";
                echo "<td><br>" . $lista_salas[$i]['filas'] . "</td>";
                echo "<td><br>" . $lista_salas[$i]['columnas'] . "</td>";
                $valor = $lista_salas[$i]['id'];
                echo "<td><button type='submit' name='boton' value='" . $valor . "''>ELIMINAR</button></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </form>
</body>

</html>