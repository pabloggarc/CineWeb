<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/Html.html to edit this template
-->
<html>

<head>
    <title>ELIMINAR SESION</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilosPerfil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/estilosCine.css">
    <link rel="stylesheet" href="../css/estilos_cabecera.css">
    <link rel="icon" href="../imagenes/cineLogo.PNG" type="image/jpg">

</head>

<body>
    <?php
    if (!(isset($_SESSION['rol_usuario'])) || $_SESSION['rol_usuario'] == 1) {
        header("Location: ../vista/vista_login.php");
    }
    ?>
    <?php require_once("vista_cabecera_admin.php") ?>

    <form method='POST' action='../controlador/controlador_eliminar_sesion.php'>
        <table id="tablaDatos" name="tabla_entradas">
            <tr>
                <th>Nombre Sala</th>
                <th>Película</th>
                <th>Pase</th>
                <th></th>
            </tr>
            <?php
            for ($i = 0; $i < count($lista_sesiones); $i++) {
                echo "<tr>";
                echo "<td><br>" . $lista_sesiones[$i]['sala_nombre'] . "</td>";
                echo "<td><br>" . $lista_sesiones[$i]['pelicula_nombre'] . "</td>";
                echo "<td><br>" . $lista_sesiones[$i]['fecha'] . "</td>";
                $valor = $lista_sesiones[$i]['id_sala'] . ";" . $lista_sesiones[$i]['id_pelicula'] . ";" . $lista_sesiones[$i]['id_pase'];
                echo "<td><button type='submit' name='boton' value='" . $valor . "''>ELIMINAR</button></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </form>
</body>

</html>