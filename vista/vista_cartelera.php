<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CARTELERA</title>
    <link rel="stylesheet" href="../css/estilosCine.css">
    <link rel="stylesheet" href="../css/estilos_cabecera.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        crossorigin="anonymous" />
    <link rel="icon" href="../imagenes/cineLogo.PNG" type="image/jpg">
</head>

<body>
    <?php
    if (!(isset($_SESSION['rol_usuario'])) || $_SESSION['rol_usuario'] == 2) {
        header("Location: ../vista/vista_login.php");
    }
    ?>
    <?php
    require_once("vista_cabecera.php") ?>

    <div class="center-div">
        <h1>CARTELERA <i class="fas fa-film"></i></h1>
        <form method="post" action="../controlador/controlador_pelicula_selec.php">
            <table class="table" name="tabla_butacas" id="tabla_butacas">
                <?php
                $rol = $_SESSION['rol_usuario'];
                if ($lista_sesiones !== null) {
                    for ($i = 0; $i < count($lista_peliculas) / PELICULAS_FILA; $i++) {
                        echo "<tr>";
                        for ($j = 0; $j < PELICULAS_FILA && $i * PELICULAS_FILA + $j < count($lista_peliculas); $j++) {
                            $indice = $i * PELICULAS_FILA + $j;
                            echo "<td class='pelicula' id='" . $lista_peliculas[$indice]['id'] . "'><br><div class='pelicula-contenido'>
                                <img src='" . $lista_peliculas[$indice]['portada'] . "'>";
                            echo "<div class='botones-container'>";

                            // Verificar si $lista_sesiones[$indice] es un array antes de usar count()
                            if (is_array($lista_sesiones[$indice])) {
                                for ($k = 0; $k < count($lista_sesiones[$indice]); $k++) {
                                    $valor = $lista_peliculas[$indice]['id'] . ";" . $lista_sesiones[$indice][$k]['hora'];
                                    echo '<button id="boton" name="boton" value="' . $valor . '">' . date("H:i", strtotime($lista_sesiones[$indice][$k]["hora"]))
                                        . '</button>';
                                }
                            }

                            echo '<button id="boton" name="boton" value="' . $lista_peliculas[$indice]['id'] . '">VER MAS</button>';
                            echo "</div>";
                            echo "</div>";
                            echo '</td>';
                        }
                        echo "</tr>";
                    }
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