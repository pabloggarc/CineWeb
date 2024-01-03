<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartelera</title>
    <link rel="stylesheet" href="../estilosPerfil.css">
    <style>
        /* Estilo para el contenedor de la película */
        .pelicula {
            position: relative;
            overflow: hidden;
        }

        /* Estilo para el contenido dentro del contenedor de la película */
        .pelicula-contenido {
            position: relative;
        }

        /* Estilo para la portada de la película */
        .pelicula img {
            width: 200px;
            height: auto;
            transition: filter 0.3s;
            /* Agregamos una transición suave para el cambio de filtro */
        }

        /* Estilo para el hover de la portada */
        .pelicula:hover img {
            filter: brightness(50%);
            /* Cambiamos el brillo para oscurecer la imagen al hacer hover */
        }

        /* Estilo para el contenedor de los botones */
        .pelicula .botones-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
            text-align: center;
            /* Alineamos los botones al centro */

        }

        /* Estilo para los botones dentro del contenedor */
        .pelicula .botones-container .boton {
            background-color: #333;
            align-items: center;
            color: #fff;
            padding: 5px 10px;
            margin-bottom: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            /* Alineamos los botones al centro */
            /* Agregamos una transición suave para el cambio de color de fondo */
        }

        /* Estilo para mostrar los botones al hacer hover en la película */
        .pelicula:hover .botones-container {
            display: block;
        }

        /* Estilo para el hover de los botones */
        .pelicula .botones-container:hover .boton {
            background-color: #555;
            /* Cambiamos el color de fondo al hacer hover */
        }
    </style>
</head>

<body>
    <nav>
        <img src="./imagenes/CINE+.png" class="logo" alt="Logo de la página">
        <div class="opciones">
            <a href="../controlador/controlador_perfil.php">PERFIL</a>
            <a href="../controlador/controlador_ver_reservas.php">VISTA ENTRADA</a>
            <a href="../controlador/controlador_peliculas_vistas.php">PELICULAS VISTAS</a>
            <a href="../controlador/controlador_mostrar_cartelera.php">CARTELERA</a>
        </div>
    </nav>
    <h1>CARTELERA
    </h1>
    <div class="center-div">
        <form method="post" action="../controlador/controlador_pelicula_selec.php">
            <table class="table" name="tabla_butacas" id="tabla_butacas">
                <?php
                for ($i = 0; $i < count($lista_peliculas) / PELICULAS_FILA; $i++) {
                    echo "<tr>";
                    for ($j = 0; $j < PELICULAS_FILA && $i * PELICULAS_FILA + $j < count($lista_peliculas); $j++) {
                        $indice = $i * PELICULAS_FILA + $j;
                        echo "<td class='pelicula' id='" . $lista_peliculas[$indice]['id'] . "''><br><div class='pelicula-contenido'>
                    <img src='" . $lista_peliculas[$indice]['portada'] . "'>";
                        echo "<div class='botones-container'>";
                        for ($k = 0; $k < count($lista_sesiones[$indice]); $k++) {
                            $valor = $lista_peliculas[$indice]['id'].";".$lista_sesiones[$indice][$k]['hora'];
                            echo '<button id="boton" name="boton" value="' . $valor . '">' . $lista_sesiones[$indice][$k]["hora"] . '</button>';
                        }
                        echo '<button id="boton" name="boton" value="' . $lista_peliculas[$indice]['id'] . '">VER MAS</button>';
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