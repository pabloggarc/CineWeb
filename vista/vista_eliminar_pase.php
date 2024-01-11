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
    <link rel="stylesheet" href="../estilosCine.css">
    <link rel="stylesheet" href="../estilos_cabecera.css">
    <link rel="icon" href="../imagenes/cineLogo.PNG" type="image/jpg">

</head>

<body>
    <?php require_once("vista_cabecera_admin.php") ?>


    <form method='POST' action='../controlador/controlador_eliminar_pase.php'>
        <table id="tablaDatos" name="tabla_entradas">
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Acción</th>
            </tr>
            <?php
            for ($i = 0; $i < count($lista_pases); $i++) {
                echo "<tr>";
                echo "<td><br>" . $lista_pases[$i]['dia'] . "</td>";
                echo "<td><br>" . $lista_pases[$i]['hora'] . "</td>";
                $valor = $lista_pases[$i]['id'];
                echo "<td><button type='submit' name='boton' value='" . $valor . "''>ELIMINAR</button></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </form>
</body>

</html>