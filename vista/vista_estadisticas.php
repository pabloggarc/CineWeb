<!DOCTYPE html>
<html>

<head>
    <title>Estadísticas</title>
    <link rel="stylesheet" href="../estilos_cabecera.css">
    <link rel="stylesheet" type="text/css" href="../estilosCine.css">
    <link rel="icon" href="../imagenes/cineLogo.PNG" type="image/jpg">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
    <?php require_once("vista_cabecera_admin.php") ?>
    <table id="tablaDatos2">
        <tr>
            <th>Proyecciones hoy (
                <?= date("d/m/Y") ?>)
            </th>
            <th>Proyecciones futuras</th>
            <th>Usuarios registrados</th>
            <th>Películas en cartelera</th>
            <th>Valoración media de los usuarios</th>
            <th>Butacas reservadas actualmente</th>

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

    <div class="contenedor-total">
        <h3>GRADO DE OCUPACIÓN</h3>
        <p>Estadísticas que permiten conocer la ocupación de las salas en la hora actual y la ocupación que tendrá en el
            futuro conociendo el número de reservas realizadas.</p>
        <div class="contenedor-graficas">
            <div id="grafica" class="grafica">
            </div>
            <div id="grafica2" class="grafica2">
            </div>
        </div>
        <h3>GRADO DE SATISFACCIÓN</h3>
        <p>Estadísticas que permiten conocer el número de películas que se han visto en el cine junto con el grado de
            satisfacción del cliente para cada una de ellas.</p>
        <div class="contenedor-graficas2">
            <div id="grafica3" class="grafica3">
            </div>
            <div id="grafica4" class="grafica3">
            </div>
        </div>
        <h3>GÉNEROS DE PELÍCULAS</h3>
        <p>Estadísticas que permiten conocer cuántas películas hay disponibles de cada género, y cuántas visualizaciones
            ha tenido cada género.</p>
        <div class="contenedor-graficas3">
            <div id="grafica5" class="grafica3">
            </div>
            <div id="grafica6" class="grafica3">
            </div>
        </div>
    </div>

    <script>
        google.charts.load('current', { 'packages': ['corechart'] });
        google.charts.setOnLoadCallback(drawChartButacas);
        google.charts.setOnLoadCallback(drawChartReservas);
        google.charts.setOnLoadCallback(drawChartPeliculas);
        google.charts.setOnLoadCallback(drawChartPeliculasValoradas);
        google.charts.setOnLoadCallback(drawChartPeliculasGeneros);
        google.charts.setOnLoadCallback(drawChartPeliculasGenerosVistas);

        function color_aleatorio() {
            var simbolos, color;
            simbolos = "0123456789ABCDEF";
            color = "#";

            for (var i = 0; i < 6; i++) {
                color = color + simbolos[Math.floor(Math.random() * 16)];
            }

            return color;
        }

        function drawChartButacas() {
            var data = google.visualization.arrayToDataTable([
                ['Estado', '%'],
                ['Ocupadas', <?= $numero_butacas_ocupadas ?>],
                ['Libres', <?= $numero_butacas - $numero_butacas_ocupadas ?>]
            ]);

            console.log(data);

            var options = {
                title: 'Ocupación de las butacas a las ' + new Date().toLocaleTimeString(),
                is3D: true,
                colors: ['#dc3545', '#28a745',]
            };

            var chart = new google.visualization.PieChart(document.getElementById('grafica'));
            chart.draw(data, options);
        }

        function drawChartReservas() {
            var datos = [['Pelicula', '%']];
            var data = <?php echo json_encode($map); ?>;
            datos = google.visualization.arrayToDataTable([
                ['Pelicula', '%'],
                <?php echo $datos; ?>
            ]);
            var num_colores = <?= count($map); ?>;
            var colores = [];

            for (var i = 0; i < num_colores; i++) {
                colores.push(color_aleatorio());
            }

            var fecha = new Date();

            var options = {
                title: 'Reservas a partir del ' + fecha.getDay() + '/' + (fecha.getMonth() + 1).toString() + '/' + fecha.getFullYear(),
                is3D: true,
                colors: colores
            };

            var chart = new google.visualization.PieChart(document.getElementById('grafica2'));
            chart.draw(datos, options);
        }

        function drawChartPeliculas() {
            var data = google.visualization.arrayToDataTable([
                ['Películas', 'Visualizaciones', { role: 'style' }],
                <?= $datos4 ?>
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1, {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            }, 2]);

            var options = {
                title: "Películas vistas por los usuarios:",
                width: '66vw',
                height: '50vh',
                bar: { groupWidth: "90%" },
                legend: { position: "none" },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("grafica3"));
            chart.draw(view, options);
        }

        function drawChartPeliculasValoradas() {

            var datos = <?php echo '[' . $datos3 . ']'; ?>;
            datos.forEach(function (subarray) {
                subarray[1] = parseFloat(subarray[1]);
            });
            console.log(datos);

            var data = google.visualization.arrayToDataTable([
                ['Película', 'Valoración media', { role: 'style' }],
            ].concat(datos));

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1, {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            }, 2]);

            var options = {
                title: "Nota media de los clientes:",
                width: '66vw',
                height: '50vh',
                bar: { groupWidth: "90%" },
                legend: { position: "none" },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("grafica4"));
            chart.draw(view, options);
        }

        function drawChartPeliculasGeneros() {
            var data = google.visualization.arrayToDataTable([
                ['Género', 'Películas', { role: 'style' }],
                <?= $datos5 ?>
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1, {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            }, 2]);

            var options = {
                title: "Películas disponibles por género:",
                width: '66vw',
                height: '50vh',
                bar: { groupWidth: "90%" },
                legend: { position: "none" },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("grafica5"));
            chart.draw(view, options);
        }

        function drawChartPeliculasGenerosVistas() {
            var data = google.visualization.arrayToDataTable([
                ['Género', 'Visualizaciones', { role: 'style' }],
                <?= $datos6 ?>
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1, {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            }, 2]);

            var options = {
                title: "Películas vistas por género:",
                width: '66vw',
                height: '50vh',
                bar: { groupWidth: "90%" },
                legend: { position: "none" },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("grafica6"));
            chart.draw(view, options);
        }
    </script>
</body>

</html>