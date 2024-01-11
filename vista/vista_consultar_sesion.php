<!DOCTYPE html>
<html>

<head>
    <title>CONSULTAR SESION</title>
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

    <?php require_once("vista_cabecera_admin.php") ?>

    <form method='POST' action='../controlador/controlador_consultar_sesion.php'>
        <table id="tablaDatos" name="tabla_entradas">
            <tr>
                <th>Sala</th>
                <th>Película</th>
                <th>Fecha</th>
                <th>Acción</th>
                <th>Consultar sala</th>
            </tr>
            <?php
            if (!is_null($lista_sesiones)) {
                for ($i = 0; $i < count($lista_sesiones); $i++) {
                    echo "<tr>";
                    echo "<td><br>" . $lista_sesiones[$i]['sala_nombre'] . "</td>";
                    echo "<td><br>" . $lista_sesiones[$i]['pelicula_nombre'] . "</td>";
                    echo "<td><br>" . $lista_sesiones[$i]['fecha'] . "</td>";
                    $valor = $lista_sesiones[$i]['id_sala'] . ";" . $lista_sesiones[$i]['id_pelicula'] . ";" . $lista_sesiones[$i]['id_pase'];
                    echo "<td><button type='submit' name='boton' value='" . $valor . ";0" . "''>MODIFICAR</button></td>";
                    echo "<td><button type='submit' name='boton' value='" . $valor . ";1" . "''>CONSULTAR</button></td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
    </form>
</body>

</html>