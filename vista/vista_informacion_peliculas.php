<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../estilosCine.css">
    <link rel="stylesheet" href="../estilos_peli.css">
    <link rel="stylesheet" href="../estilos_cabecera.css">
    <style>
        .rating {
            position: relative;
        }

        .star {
            display: inline-block;
            margin: 0 4px;
            font-size: 24px;
            cursor: pointer;
            color: #ccc;
            /* Establecer el color de estrella vacía */
        }

        .star-half {
            color: linear-gradient(90deg, #ff0000 75%, #ffffff 75%);
            /* Establecer el color de estrella llena */
        }

        .star-filled {
            color: gold;
            
            /* Establecer el color de estrella llena */
        }


        .star-empty {
            color: #ccc;
            /* Color de las estrellas vacías, ajusta según tu diseño */
        }
    </style>
    <script>
        function moverseCartelera() {
            window.location.href = '../controlador/controlador_mostrar_cartelera.php';
        }
        function enviarHora(hora) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../controlador/controlador_guardar_hora.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (xhr.status == 200) {
                    alert("Hora seleccionada: " + xhr.responseText);
                    window.location.href = '../controlador/controlador_butacas.php';
                } else {
                    alert("Error al enviar la hora");
                }
            };

            xhr.send("hora=" + hora);
        }

        // Esta función se ejecuta cuando se presiona el botón de enviar
        function enviarFecha() {
            // Obtenemos el valor de la fecha seleccionada
            var fecha = document.getElementById("fecha").value;
            // Creamos un objeto XMLHttpRequest para hacer la petición AJAX
            var xhr = new XMLHttpRequest();
            // Especificamos el método, la url y el tipo de datos que esperamos recibir
            xhr.open("POST", "../controlador/controlador_guardar_fecha.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.responseType = "json";
            // Definimos lo que queremos hacer cuando la petición se complete
            xhr.onload = function () {
                // Si la petición fue exitosa
                if (xhr.status == 200) {
                    // Obtenemos la variable con las horas que nos envió el archivo php
                    var horas = xhr.response;
                    // Obtenemos el elemento donde vamos a mostrar los botones
                    var contenedor = document.getElementById("contenedor");
                    // Limpiamos el contenedor por si había botones anteriores
                    contenedor.innerHTML = "";
                    // Creamos un bucle para mostrar los botones con las horas de la variable
                    for (var i = 0; i < horas.length; i++) {
                        // Creamos un elemento button
                        var boton = document.createElement("button");
                        // Le asignamos la clase button
                        boton.className = "button";
                        // Le asignamos el texto con la hora
                        boton.innerText = horas[i];
                        // Le añadimos un evento click para hacer algo cuando se presione el botón
                        boton.addEventListener("click", function () {
                            // Aquí puedes añadir tu propia lógica
                            //alert("Has seleccionado la hora " + this.innerText);
                            enviarHora(this.innerText);
                        });
                        // Añadimos el botón al contenedor
                        contenedor.appendChild(boton);
                    }
                }
            };
            // Enviamos la petición con el valor de la fecha
            xhr.send("fecha=" + fecha);
        }
    </script>
</head>

<body>

    <?php require_once("vista_cabecera.php") ?>

    <div id="container2" class="container">
        <div class="image-box">
            <img src="<?php echo $imagen; ?>" alt="Imagen">
        </div>
        <div class="info-box">
            <?php if (isset($peli)): ?>
                <h3>
                    <?php echo $titulo ?>
                </h3>
                <ul class="lista-con-titulos-inline">
                    <li>
                        <h4>Sinopsis:</h4>
                        <?php echo $sinopsis; ?>
                    </li>
                    <li>
                        <h4>Duracion:</h4>
                        <?php echo $duracion; ?>
                    </li>
                    <li>
                        <h4>Año:</h4>
                        <?php echo $año; ?>
                    </li>
                    <li>
                        <h4>Clasificacion:</h4>
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
                    <li>
                        <h4>Valoracion:</h4>
                        <?php
                        foreach ($valoraciones as $val) {
                            echo $val["media_puntuacion"];
                        } ?>
                    </li>
                    <li>
                        <h4>Genero:</h4>
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
                    <li>
                        <h4>Director:</h4>
                        <?php
                        $totalDirectores = count($director); // Contar el total de elementos en el array
                        $contador = 0;
                        foreach ($director as $dir) {
                            $contador++; // Incrementar el contador en cada iteración
                            echo $dir["nombre"] . " " . $dir["apellidos"];
                            // Si no es el último elemento, añade una coma y un espacio
                            if ($contador < $totalDirectores) {
                                echo ", ";
                            }
                        } ?>
                    </li>
                    <li>
                        <h4>Actores:</h4>
                        <?php
                        $totalActores = count($actores); // Contar el total de elementos en el array
                        $contador = 0;
                        foreach ($actores as $act) {
                            $contador++; // Incrementar el contador en cada iteración
                            echo $act["nombre"] . " " . $act["apellidos"];
                            // Si no es el último elemento, añade una coma y un espacio
                            if ($contador < $totalActores) {
                                echo ", ";
                            }
                        } ?>
                    </li>
                    <li>
                        <h4>Nacionalidad:</h4>
                        <?php echo $nacionalidad; ?>
                    </li>
                </ul>
            <?php else: ?>
                <p>No se encontraron datos de la sesion.</p>
            <?php endif; ?>
            <input type="date" id="fecha" required>
            <button onclick="enviarFecha()">Enviar</button>
            <div id="contenedor"></div>
        </div>

    </div>
    <div class="comentarios" data-rating="0">
        <h3>Comentarios y Valoraciones</h3>

        <?php
        foreach ($val_com as $com) {

            
            $rating = (int) $com["puntuacion"]; // Cambia este valor para representar diferentes calificaciones
            
            for ($i = 1; $i <= 10; $i++) {
                if ($rating >= 1) {
                    $rating--;
                    $class = 'star-filled';
                   
                } else {
                    $class = 'star-empty';
             
                }
                echo '<div class="star ' . $class . '">&#9733;</div>';
            }
            echo "<p>" . $com["comentario"] . "</p>";
        }
        ?>
    </div>
    <div class="footer-buttons">
        <button class="footer-button" onclick="moverseCartelera()">Volver</button>
    </div>

    <script>
        // Obtener la fecha actual
        var fechaActual = new Date();
        // Añadir 1 día a la fecha actual para obtener la fecha de mañana
        fechaActual.setDate(fechaActual.getDate() + 1);
        // Convertir la fecha de mañana a formato ISO (YYYY-MM-DD)
        var fechaDeManana = fechaActual.toISOString().split('T')[0];
        // Establecer la fecha de mañana como el valor mínimo para el input de tipo fecha
        document.getElementById("fecha").setAttribute("min", fechaDeManana);
        // Esta función se ejecuta cuando se presiona el botón de enviar
    </script>
</body>

</html>