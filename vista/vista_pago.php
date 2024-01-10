
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../estilos_peli.css">
    <link rel="stylesheet" type="text/css" href="../estilosCine.css">
    <link rel="stylesheet" type="text/css" href="../estilos_cabecera.css">

    <script>
        function goBack() {
            window.location.href = "../controlador/controlador_butacas.php";
        }
    </script>
</head>

<body>
<?php require_once("vista_cabecera.php") ?>


    <div class="container">
        <div class="image-box">
        <img src="<?php echo $imagen; ?>" alt="Imagen">
        </div>
        <div class="info-box" id="info-box">
        <?php if (isset($peli)): ?>
                <h3>
                    <?php echo $titulo ?>
                </h3>
                <ul class="lista-con-titulos-inline">
                    <li><h4>Duracion:</h4>
                        <?php echo $duracion; ?>
                    </li>
                    <li><h4>Año:</h4>
                        <?php echo $año; ?>
                    </li>
                    <li><h4>Clasificacion:</h4>
                        <?php
                        $totalClasificacion = count($clasificacion); // Contar el total de elementos en el array
                        $contador = 0;
                        foreach ($clasificacion as $cal) {
                            $contador++; // Incrementar el contador en cada iteración
                            echo $cal["edad"];
                            // Si no es el último elemento, añade una coma y un espacio
                            if ($contador < $totalClasificacion) {
                                echo ", ";
                            }
                        } ?>
                    </li>
                    <li><h4>Genero:</h4>
                        <?php
                        $totalGenero = count($genero); // Contar el total de elementos en el array
                        $contador = 0;
                        foreach ($genero as $gen) {
                            $contador++; // Incrementar el contador en cada iteración
                            echo $gen["tipo"];
                            // Si no es el último elemento, añade una coma y un espacio
                            if ($contador < $totalGenero) {
                                echo ", ";
                            }
                        } ?>
                    </li>
                    <li><h4>Nacionalidad:</h4>
                        <?php echo $nacionalidad; ?>
                    </li>
                    <li><h4>Hora del pase:</h4>
                        <?php 
                        echo $hora; 
                        ?>
                    </li>
                    <li><h4>Fecha del pase:</h4>
                        <?php
                        echo $fecha; 
                    ?>
                </ul>
            <?php else: ?>
                <p>No se encontraron datos de la sesion.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php

    // Calcular el precio (esto es solo un ejemplo, ajusta según tu lógica de negocio)
    $precioPorUnidad = 6.00; // Define el precio por unidad
    if (isset($_SESSION['pelicula']) && isset($_SESSION['butacas_seleccionadas'])) {
        $nombre = $titulo;
        $butacas = $_SESSION['butacas_seleccionadas'];
        $unidades = count($butacas);
        $precioTotal = $precioPorUnidad * $unidades;
    } else {
        // Manejar el caso de que las variables de sesión no estén establecidas
        $nombre = "Producto Desconocido";
        $unidades = 0;
        $precioTotal = 0.00;
    }
    ?>
    <table class="data-table">
        <tr>
            <th>Nombre</th>
            <th>Unidades</th>
            <th>Precio</th>
        </tr>
        <tr>
            <td>
                <?php echo htmlspecialchars($nombre); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($unidades); ?>
            </td>
            <td>
                <?php echo htmlspecialchars(number_format($precioTotal, 2)); ?>
                €
            </td>
        </tr>
    </table>
    <div class="form-container">
        <?php
        if (isset($_SESSION['error']) && $_SESSION['error'] != "") {
            echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
            // Limpia el mensaje después de mostrarlo
            $_SESSION['error'] = "";
        }
        ?>
        <form id="accountForm" action="../controlador/controlador_reserva.php" method="post">
            <label for="accountNumber">N&uacute;mero de Cuenta:</label><br>
            <input type="text" id="accountNumber" name="accountNumber" class="form-field"><br>
            <input type="submit" value="Enviar" class="form-button">
            <input type="button" value="Borrar" class="form-button"
                onclick="document.getElementById('accountNumber').value = '';">
            <input type="button" value="Volver" class="form-button" onclick="goBack()">
        </form>
    </div>

</body>

</html>