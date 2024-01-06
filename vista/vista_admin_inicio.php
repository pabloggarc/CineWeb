<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartelera</title>
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
    <h1>PANEL DE CONTROL ADMIN
    </h1>
    <table>
        <tr>
            <th>
                GESTIONAR PELICULAS
            </th>
            <th>
                GESTIONAR SALAS
            </th>
            <th>
                GESTIONAR SESIONES

            </th>
            <th>
                GESTIONAR PASES

            </th>
        </tr>
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