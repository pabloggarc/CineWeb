<!DOCTYPE html>
<html>
    <head>
        <title>Estadísticas</title>
    </head>
    <body>
        <div>
            Proyecciones hoy (<?php echo date("d/m/Y"); ?>): 
        </div>
        <div>
            <span style='font-size:3em'><?=$sesiones_hoy?></span>
        </div>

        <div>
            Proyecciones futuras:
        </div>
        <div>
            <span style='font-size:3em'><?=$sesiones_futuras?></span>
        </div>

        <div>
            Usuarios registrados:
        </div>
        <div>
            <span style='font-size:3em'><?=$numero_usuarios?></span>
        </div>

        <div>
            Películas en cartelera:
        </div>
        <div>
            <span style='font-size:3em'><?=$numero_peliculas_disponibles?></span>
        </div>       
        <div>
            Valoración media de los usuarios:
        </div>
        <div>
            <span style='font-size:3em'><?=$valoracion_media?></span>
        </div>

        <div>
            Butacas reservadas actualmente:
        </div>
        <div>
            <span style='font-size:3em'><?=$numero_butacas_reservadas?></span>
        </div>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        <div id="grafica" style="width:66vw; max-width:66vw; height:66vh;">
        </div>

        <script>
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Estado', '%'],            
                    ['Ocupadas',<?=$numero_butacas_ocupadas?>],
                    ['Libres',<?=$numero_butacas - $numero_butacas_ocupadas?>]
                ]);

                var options = {
                    title:'Ocupación de las butacas a las '+ new Date().toLocaleTimeString(),
                    is3D:true,
                    colors: ['#dc3545','#28a745',]
                };

                var chart = new google.visualization.PieChart(document.getElementById('grafica'));
                chart.draw(data, options);
            }
            
        </script>
    </body>
</html>