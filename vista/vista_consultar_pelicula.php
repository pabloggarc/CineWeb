<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartelera</title>
    <link rel="stylesheet" href="../estilosCine.css">
    <link rel="stylesheet" href="../estilos_cabecera.css">

</head>

<body>
    <?php require_once("vista_cabecera_admin.php") ?>
    <h1>CARTELERA
    </h1>
    <div class="center-div">
        <form method="post" action="../controlador/controlador_consultar_peliculas.php">
            <table class="table" name="tabla_butacas" id="tabla_butacas">
                <?php
                $rol = $_SESSION['rol_usuario'];
                for ($i = 0; $i < count($lista_peliculas) / PELICULAS_FILA; $i++) {
                    echo "<tr>";
                    for ($j = 0; $j < PELICULAS_FILA && $i * PELICULAS_FILA + $j < count($lista_peliculas); $j++) {
                        $indice = $i * PELICULAS_FILA + $j;
                        echo "<td class='pelicula' id='" . $lista_peliculas[$indice]['id'] . "''><br><div class='pelicula-contenido'>
                    <img src='" . $lista_peliculas[$indice]['portada'] . "'>";
                        echo "<div class='botones-container'>";
                        echo '<button id="boton" name="boton" value="' . $lista_peliculas[$indice]['id'] . '">CONSULTAR</button>';
                    }
                    echo "</div>";
                    echo "</div>";
                    echo '</td>';
                    echo "</tr>";
                }
                ?>
            </table>
        </form>
    </div>
    <script>
        // Este script es opcional, se utiliza si deseas ocultar los botones al cargar la página
        document.addEventListener("DOMContentLoaded", function () {
            var botones = document.querySelectorAll('.botones');
            botones.forEach(function (boton) {
                boton.style.display = 'none';
            });
        });
    </script>
</body>

</html>