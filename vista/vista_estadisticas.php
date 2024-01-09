<!DOCTYPE html>
<html>

<head>
    <title>Estadísticas</title>
</head>
<link rel="stylesheet" href="../estilos_cabecera.css">
<link rel="stylesheet" type="text/css" href="../estilosCine.css">



<body>

    <?php require_once("vista_cabecera_admin.php") ?>


    <table id="tablaDatos2">
        <tr>
            <th>Proyecciones hoy (<?php echo date("d/m/Y");?>)</th>
            <th>Proyecciones futuras:</th>
            <th>Usuarios registrados:</th>
            <th>Películas en cartelera:</th>
            <th>Valoración media de los usuarios:</th>
            <th> Butacas reservadas actualmente:</th>

        </tr>
        <tr>
            <td>
                <?= $sesiones_hoy ?>
            </td>
            <td>
                <?= $sesiones_futuras ?>
            </td>
            <td>
                <?= $numero_usuarios ?>
            </td>
            <td>
                <?= $numero_peliculas_disponibles ?>
            </td>
            <td>
                <?= $valoracion_media ?>
            </td>
            <td>
                <?= $numero_butacas_reservadas ?>
            </td>

        </tr>
    </table>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <div id="grafica">
    </div>

    <script>
        google.charts.load('current', { 'packages': ['corechart'] });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Estado', '%'],
                ['Ocupadas', <?= $numero_butacas_ocupadas ?>],
                ['Libres', <?= $numero_butacas - $numero_butacas_ocupadas ?>]
            ]);

            var options = {
                title: 'Ocupación de las butacas a las ' + new Date().toLocaleTimeString(),
                is3D: true,
                colors: ['#dc3545', '#28a745',]
            };

            var chart = new google.visualization.PieChart(document.getElementById('grafica'));
            chart.draw(data, options);
        }

    </script>
</body>

</html>