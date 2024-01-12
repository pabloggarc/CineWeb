<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos_cabecera.css">
    <link rel="stylesheet" href="../css/estilosCine.css">
    <link rel="icon" href="../imagenes/cineLogo.PNG" type="image/jpg">
    <title>PANEL DE GESTIÓN</title>
</head>

<body>
    <?php
    if (!(isset($_SESSION['rol_usuario'])) || $_SESSION['rol_usuario']==1) {
        header("Location: ../vista/vista_login.php");
    }
    ?>
    <?php require_once("vista_cabecera_admin.php") ?>


    <table id="tablaDatos2">
        <tr>
            <th>GESTION DE PELICULAS</th>
            <th>GESTION DE SALAS</th>
            <th>GESTION DE SESIONES</th>
            <th>GESTION DE PASES</th>
        </tr>
        <tr>
        <tr>
            <td>
                <form action="../controlador/controlador_gestionar_peliculas.php" method="POST">
                    <button name="boton" value=1 type="submit">AÑADIR PELICULA</button>
                </form>
            </td>
            <td>
                <form action="../controlador/controlador_gestionar_salas.php" method="POST">
                    <button name="boton" value=1 type="submit">AÑADIR SALA </button>
                </form>
            </td>
            <td>
                <form action="../controlador/controlador_gestionar_sesiones.php" method="POST">
                    <button name="boton" value=1 type="submit">AÑADIR SESION</button>
                </form>
            </td>
            <td>
                <form action="../controlador/controlador_gestionar_pases.php" method="POST">
                    <button name="boton" value=1 type="submit">AÑADIR PASE</button>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form action="../controlador/controlador_gestionar_peliculas.php" method="POST">
                    <button name="boton" value=2 type="submit">ELIMINAR PELICULA</button>
                </form>
            </td>
            <td>
                <form action="../controlador/controlador_gestionar_salas.php" method="POST">
                    <button name="boton" value=2 type="submit">ELIMINAR SALA </button>
                </form>
            </td>
            <td>
                <form action="../controlador/controlador_gestionar_sesiones.php" method="POST">
                    <button name="boton" value=2 type="submit">ELIMINAR SESION</button>
                </form>
            </td>
            <td>
                <form action="../controlador/controlador_gestionar_pases.php" method="POST">
                    <button name="boton" value=2 type="submit">ELIMINAR PASE</button>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form action="../controlador/controlador_gestionar_peliculas.php" method="POST">
                    <button name="boton" value=3 type="submit">CONSULTAR PELICULA</button>
                </form>
            </td>
            <td>
                <form action="../controlador/controlador_gestionar_salas.php" method="POST">
                    <button name="boton" value=3 type="submit">CONSULTAR SALA </button>
                </form>
            </td>
            <td>
                <form action="../controlador/controlador_gestionar_sesiones.php" method="POST">
                    <button name="boton" value=3 type="submit">CONSULTAR SESION</button>
                </form>
            </td>
            <td>
                <form action="../controlador/controlador_gestionar_pases.php" method="POST">
                    <button name="boton" value=3 type="submit">CONSULTAR PASE</button>
                </form>
            </td>
        </tr>
    </table>
</body>

</html>