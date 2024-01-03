<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/Html.html to edit this template
-->
<html>

<head>
    <title>Información del usuario</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilosPerfil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="../estilos.css">

</head>

<body>
<nav>
        <img src="./imagenes/CINE+.png" class="logo" alt="Logo de la página">
        <div class="opciones">
            <a href="../controlador/controlador_perfil.php">PERFIL</a>
            <a href="../controlador/controlador_ver_reservas.php">VISTA ENTRADA</a>
            <a href="../controlador/controlador_peliculas_vistas.php">PELICULAS VISTAS</a>
        </div>
    </nav>
    <form method="post" action="../controlador/controlador_comentar.php">
        <label for="caja1">NOMBRE</label>
        <input type="text" id="caja1" name="nombre" value=<?php echo $pelicula_seleccionada[0] ?> readonly><br><br>

        <label for="caja2">HORA SESION</label>
        <input type="text" id="caja2" name="hora" value=<?php echo $pelicula_seleccionada[1] ?> readonly><br><br>


        <label for="caja2">DIA SESION</label>
        <input type="text" id="caja2" name="dia" value=<?php echo $pelicula_seleccionada[2] ?> readonly><br><br>

        <label for="caja3">SALA</label>
        <input type="text" id="caja3" name="sala" value=<?php echo $pelicula_seleccionada[3] ?> readonly><br><br>

        <label for="caja4">COMENTARIO</label>
        <input type="text" id="caja4" name="comentario" pattern="[a-zA-ZÁÉÍÓÚáéíóúüÜÑñ _()/.,]{0,999}"><br>

        <label for="caja5">VALORACION</label>
        <input type="text" id="caja5" name="valoracion" pattern="^(10|[0-9])$"><br><br>

        <input type="submit" value="Enviar">
    </form>
</body>

</html>