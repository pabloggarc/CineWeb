<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/Html.html to edit this template
-->
<html>

<head>
    <title>COMENTAR</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos_cabecera.css">
    <link rel="stylesheet" href="../css/estilosCine.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        crossorigin="anonymous" />
        <link rel="icon" href="../imagenes/cineLogo.PNG" type="image/jpg">

</head>

<body>

    <?php require_once("vista_cabecera.php") ?>

    <div class="container2">

        <h2>COMENTARIO</h2>
        <form method="post" action="../controlador/controlador_comentar.php">
            <div class="profile-container">
                <div class="profile-info">
                    <div class="editable-field" id="name-field">
                        <label><i class="fas fa-film"></i> Nombre:</label>
                        <input type="text" class="field-value" id="nombre" name="nombre"
                            value="<?php echo $pelicula_seleccionada[0] ?>" readonly>
                    </div>
                    <div class="editable-field" id="last-name-field">
                        <label><i class="fas fa-clock"></i> Hora</label>
                        <input type="text" class="field-value" id="hora" name="hora"
                            value="<?php echo $pelicula_seleccionada[1] ?>" readonly>
                    </div>
                    <div class="editable-field" id="email-field">
                        <label><i class="fas fa-calendar-days"></i> Día</label>
                        <input type="text" class="field-value" id="dia" name="dia"
                            value="<?php echo $pelicula_seleccionada[2] ?>" readonly>
                    </div>
                    <div class="editable-field" id="username-field">
                        <label><i class="fas fa-door-closed"></i> Sala:</label>
                        <input type="text" class="field-value" id="sala" name="sala"
                            value="<?php echo $pelicula_seleccionada[3] ?>" readonly>
                    </div>
                    <div class="editable-field" id="username-field">
                        <label><i class="fas fa-pencil"></i> Comentario</label>
                        <input type="text" class="field-value" id="comentario" name="comentario"
                            pattern="[a-zA-ZÁÉÍÓÚáéíóúüÜÑñ _()/.,]{0,999}" required>
                    </div>
                    <div class="editable-field" id="username-field">
                        <label><i class="fas fa-star"></i> Valoración</label>
                        <input type="text" class="field-value" id="valoracion" name="valoracion" pattern="^(10|[0-9])$"
                            required>
                    </div>
                </div>
            </div>
            <input type="submit" value="Enviar"></input>
        </form>
        <button class="back-button" onclick="goBack('../controlador/controlador_peliculas_vistas.php')">
            <i class="fas fa-arrow-left"></i> Volver</button>
    </div>
    <script>
        function goBack() {
            window.location.href = "../controlador/controlador_peliculas_vistas.php"
        }
    </script>
</body>

</html>