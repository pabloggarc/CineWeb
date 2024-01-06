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

    <form method='POST' action='../controlador/controlador_consultar_pase.php'>
        <table class="table" name="tabla_entradas" id="tabla_entradas">
            <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
            </tr>
            <?php
            for ($i = 0; $i < count($lista_pases); $i++) {
                echo "<tr>";
                echo "<td><br>" . $lista_pases[$i]['dia'] . "</td>";
                echo "<td><br>" . $lista_pases[$i]['hora'] . "</td>";
                $valor = $lista_pases[$i]['id'];
                echo "<td><button type='submit' name='boton' value='" . $valor . "''>CONSULTAR</button></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </form>
</body>

</html>