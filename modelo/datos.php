<?php
class Datos
{
    private $bd;
    private $host;
    private $bd_nombre;
    private $usuario;
    private $pass;

    public function __construct($host, $bd_nombre, $usuario, $pass)
    {
        $this->host = $host;
        $this->bd_nombre = $bd_nombre;
        $this->usuario = $usuario;
        $this->pass = $pass;
    }

    public function conectar()
    {
        try {
            $this->bd = new PDO("pgsql:host = $this->host; dbname= $this->bd_nombre", $this->usuario, $this->pass);
            $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function desconectar()
    {
        unset($this->bd);
    }

    private function ejecutar_consulta($query)
    {
        $stmt = $this->bd->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get_pruebas()
    {
        $result = $this->ejecutar_consulta("SELECT * FROM prueba");
        return $result;
    }

    public function get_dim_sala($nombre_sala)
    {
        $result = $this->ejecutar_consulta("SELECT filas, columnas FROM Sala WHERE nombre = '" . $nombre_sala . "' LIMIT 1; ");
        if (!empty($result)) {
            return array($result[0]['filas'], $result[0]['columnas']);
        } else {
            return null;
        }
    }

    public function get_butacas($nombre_sala)
    {
        $consulta = "SELECT Butaca.ID FROM Butaca INNER JOIN Sala ON Butaca.ID_Sala = Sala.ID WHERE Sala.nombre = '" . $nombre_sala . "';";
        $result = $this->ejecutar_consulta($consulta);
        if (!empty($result)) {
            $id_butacas = array();
            foreach ($result as $fila) {
                array_push($id_butacas, $fila['id']);
            }
            return $id_butacas;
        } else {
            return null;
        }
    }

    public function get_ocupacion_sala($nombre_sala, $fecha, $hora)
    {
        $consulta = "SELECT CASE WHEN Butaca.ID IN (
            SELECT Butaca.ID from Butaca INNER JOIN Entrada ON Butaca.ID = Entrada.ID_Butaca 
            INNER JOIN Sala ON Entrada.ID_Sala_Sesion = Sala.ID INNER JOIN Sesion ON Entrada.ID_Pase_Sesion = Sesion.ID_Pase AND
            Entrada.ID_Sala_Sesion = Sesion.ID_Sala AND Entrada.ID_Pelicula_Sesion = Sesion.ID_Pelicula INNER JOIN Pase ON
            Sesion.ID_Pase = Pase.ID INNER JOIN Pelicula ON Sesion.ID_Pelicula = Pelicula.ID WHERE Sala.nombre = '" . $nombre_sala . "' AND 
            Pase.dia = '" . $fecha . "' AND Pase.hora = '" . $hora . "' ORDER BY ID ASC
        ) 	THEN 0
            ELSE 1 END AS libre
        FROM Butaca INNER JOIN Sala ON Butaca.ID_Sala = Sala.ID WHERE Sala.nombre = '" . $nombre_sala . "'; ";
        $result = $this->ejecutar_consulta($consulta);
        if (!empty($result)) {
            $ocupacion = array();
            foreach ($result as $fila) {
                array_push($ocupacion, $fila['libre']);
            }
            return $ocupacion;
        } else {
            return null;
        }
    }

    public function get_ocupantes_sala($nombre_sala, $fecha, $hora)
    {
        $consulta = "SELECT CASE WHEN Butaca.ID IN (
            SELECT Butaca.ID FROM Butaca
            INNER JOIN Entrada ON Butaca.ID = Entrada.ID_Butaca
            INNER JOIN Sala ON Entrada.ID_Sala_Sesion = Sala.ID
            INNER JOIN Sesion ON Entrada.ID_Pase_Sesion = Sesion.ID_Pase
                                AND Entrada.ID_Sala_Sesion = Sesion.ID_Sala
                                AND Entrada.ID_Pelicula_Sesion = Sesion.ID_Pelicula
            INNER JOIN Pase ON Sesion.ID_Pase = Pase.ID
            INNER JOIN Pelicula ON Sesion.ID_Pelicula = Pelicula.ID
            WHERE Sala.nombre = '" . $nombre_sala . "'
                AND Pase.dia = '" . $fecha . "'
                AND Pase.hora = '" . $hora . "'
            ORDER BY ID ASC) 
        THEN Usuario.nick ELSE NULL END AS nombre_usuario FROM Butaca
	        INNER JOIN Sala ON Butaca.ID_Sala = Sala.ID
	        LEFT JOIN Entrada ON Butaca.ID = Entrada.ID_Butaca
	        LEFT JOIN Usuario ON Entrada.ID_Usuario = Usuario.ID
        WHERE Sala.nombre = '" . $nombre_sala . "';";

        $result = $this->ejecutar_consulta($consulta);
        if (!empty($result)) {
            $ocupacion = array();
            foreach ($result as $fila) {
                array_push($ocupacion, $fila['nombre_usuario']);
            }
            return $ocupacion;
        } else {
            return null;
        }
    }

    public function insertar_nuevo_usuario($nick, $clave, $nombre, $apellidos, $correo, $fecha_nacimiento)
    {
        $result = $this->ejecutar_consulta("INSERT INTO Usuario (nick, clave, nombre, apellidos, correo, fecha_nacimiento, ID_Rol)
            VALUES ( '" . $nick . "' , '" . $clave . "', '" . $nombre . "' , '" . $apellidos . "', '" . $correo . "', '" . $fecha_nacimiento . "', 1)");
    }

    /**
     * 
     */
    public function consultar_usuario_por_nick($nick)
    {
        $result = $this->ejecutar_consulta("SELECT * FROM Usuario WHERE nick= '" . $nick . "'");
        if (empty($result)) {
            return false;
        } else {
            return true;
        }
    }

    public function get_usuario_por_nick($nick)
    {
        $result = $this->ejecutar_consulta("SELECT * FROM Usuario WHERE nick= '" . $nick . "'");
        return $result;
    }

    /**
     * Funcion encargada de obtener la clave de acceso de un determinado usuario buscando por su nickname
     */
    public function get_clave_por_nick($nick)
    {
        $result = $this->ejecutar_consulta("SELECT clave FROM Usuario WHERE nick= '" . $nick . "'");

        // Verifica si se obtuvieron resultados y si $result es un array
        if (is_array($result) && count($result) > 0) {
            // Obtiene el primer elemento del array
            $firstRow = reset($result);

            // Retorna el valor de la clave si existe, de lo contrario, retorna null o maneja de otra manera según tus necesidades
            $result_string = isset($firstRow['clave']) ? $firstRow['clave'] : null;
        }
        if (!empty($result_string)) {
            return $result_string;
        } else {
            return null;
        }
    }

    public function get_info_perfil_por_nick($nick)
    {
        $query = $this->ejecutar_consulta("SELECT nombre, apellidos,correo,nick,clave,fecha_nacimiento,id_rol FROM Usuario WHERE nick= '" . $nick . "'");
        if (!empty($query)) {
            return $query;
        } else {
            return null;
        }
    }
    public function eliminar_usuario_por_nick($nick)
    {
        $this->ejecutar_consulta("DELETE FROM Usuario WHERE nick= '" . $nick . "'");
    }


    public function get_peliculas_no_vistas_por_nick($nick)
    {
        $consulta = $this->ejecutar_consulta("select pelicula.nombre, pase.hora, pase.dia, entrada.localizador, sala.nombre as sala, butaca.fila, butaca.columna, sala.columnas as sala_columnas from entrada 
        inner join usuario on usuario.id = entrada.id_usuario 
        inner join pase on pase.id = entrada.id_pase_sesion 
        inner join sala on sala.id = entrada.id_sala_sesion 
        inner join pelicula on pelicula.id = entrada.id_pelicula_sesion
        inner join butaca on butaca.id = entrada.id_butaca
        WHERE usuario.nick= '" . $nick . "' and pase.dia > (CURRENT_DATE AT TIME ZONE 'CET')::DATE or (pase.dia = (CURRENT_DATE AT TIME ZONE 'CET')::DATE and pase.hora > (CURRENT_TIME AT TIME ZONE 'CET')::TIME)
        group by pelicula.nombre, pase.hora, pase.dia, sala.nombre, entrada.localizador, butaca.fila, butaca.columna, sala.columnas;");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function get_butaca_por_entrada($nick, $pelicula, $dia_pase, $hora_pase, $sala)
    {
        $consulta = $this->ejecutar_consulta("select entrada.id_butaca, butaca.fila, butaca.columna, entrada.localizador from entrada inner join usuario on usuario.id = entrada.id_usuario 
            inner join pase on pase.id = entrada.id_pase_sesion inner join sala on sala.id = entrada.id_sala_sesion inner join pelicula on
            pelicula.id = entrada.id_pelicula_sesion inner join butaca on butaca.id = entrada.id_butaca  WHERE usuario.nick= '" . $nick . "' and pelicula.nombre = '" . $pelicula . "' and pase.hora = '" . $hora_pase . "'
            and pase.dia = '" . $dia_pase . "' and sala.nombre= '" . $sala . "';");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }


    public function eliminar_entrada_por_pelicula($nick, $pelicula, $hora_pase, $dia_pase, $sala, $fila_butaca, $columna_butaca)
    {
        $consulta = $this->ejecutar_consulta("delete from entrada where id_usuario = (select id from usuario where nick = '" . $nick . "') 
            and id_pelicula_sesion = (select id from pelicula where nombre = '" . $pelicula . "')
            and id_sala_sesion = (select id from sala where nombre = '" . $sala . "') 
            and id_pase_sesion = (select id from pase where hora = '" . $hora_pase . "' and dia = '" . $dia_pase . "')
            and id_butaca = (select id from butaca where fila = " . $fila_butaca . " and columna = " . $columna_butaca . " 
            and id_sala = (select id from sala where nombre = '" . $sala . "'));");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function insertar_valoracion($nick, $pelicula, $dia_pase, $hora_pase, $sala, $comentario, $puntuacion)
    {
        $this->ejecutar_consulta("insert into valoracion(puntuacion,comentario,id_pelicula,id_usuario) values
        (" . $puntuacion . ",'" . $comentario . "',
        (select pelicula.id from entrada inner join usuario on usuario.id = entrada.id_usuario 
        inner join pase on pase.id = entrada.id_pase_sesion 
        inner join sala on sala.id = entrada.id_sala_sesion 
        inner join pelicula on pelicula.id = entrada.id_pelicula_sesion 
        where usuario.nick = '" . $nick . "' and pelicula.nombre = '" . $pelicula . "' 
        and pase.hora = '" . $hora_pase . "' and pase.dia = '" . $dia_pase . "' 
        and sala.nombre = '" . $sala . "' group by pelicula.id),
        (select id from usuario  where usuario.nick = '" . $nick . "'));");
    }


    public function get_peliculas_vistas_por_nick($nick)
    {
        $consulta = $this->ejecutar_consulta("select pelicula.nombre, pase.hora, pase.dia, sala.nombre as sala from entrada 
                        inner join usuario on usuario.id = entrada.id_usuario 
                        inner join pase on pase.id = entrada.id_pase_sesion 
                        inner join sala on sala.id = entrada.id_sala_sesion 
                        inner join pelicula on pelicula.id = entrada.id_pelicula_sesion 
                        WHERE usuario.nick= '" . $nick . "' and pase.dia < (CURRENT_DATE AT TIME ZONE 'CET')::DATE or (pase.dia = (CURRENT_DATE AT TIME ZONE 'CET')::DATE and pase.hora < (CURRENT_TIME AT TIME ZONE 'CET')::TIME )
                        group by pelicula.nombre, pase.hora, pase.dia, sala.nombre;");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }


    /* public function get_peliculas_totales()
     {
         $consulta = $this->ejecutar_consulta("select pase.hora,pase.dia,pelicula.nombre,pelicula.id,pelicula.portada from sesion 
         inner join pase on pase.id = sesion.id_pase 
         inner join pelicula on pelicula.id = sesion.id_pelicula order by pelicula.id;");
         if (!empty($consulta)) {
             return $consulta;
         } else {
             return null;
         }
     }*/

    public function get_cabeceras_peliculas()
    {
        $consulta = $this->ejecutar_consulta("select pelicula.nombre,pelicula.id,pelicula.portada from sesion 
        inner join pase on pase.id = sesion.id_pase 
        inner join pelicula on pelicula.id = sesion.id_pelicula group by pelicula.id order by pelicula.id;");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function get_info_peliculas($id, $fecha)
    {
        $consulta = $this->ejecutar_consulta("select pase.hora, pase.dia from sesion
        inner join pase on pase.id = sesion.id_pase
        inner join pelicula on pelicula.id = sesion.id_pelicula
        where pelicula.id = '" . $id . "' AND Pase.dia = '" . $fecha . "' AND pase.hora > (CURRENT_TIME AT TIME ZONE 'CET')::TIME  ORDER BY Pase.hora ;");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function get_rol_por_nick($nick)
    {
        $consulta = $this->ejecutar_consulta("select id_rol from Usuario where nick = '" . $nick . "';");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function get_clasificacion()
    {
        $consulta = $this->ejecutar_consulta("SELECT * FROM clasificacion");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function get_distribuidora()
    {
        $consulta = $this->ejecutar_consulta("SELECT * FROM distribuidora");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function insertar_pelicula($nombre, $sinopsis, $url_web, $titulo, $duracion, $anno, $portada, $clasificacion, $distribuidora)
    {
        $this->ejecutar_consulta("insert into pelicula
        (nombre, sinopsis, web, titulo, duracion, año, portada, id_clasificacion, id_distribuidora) values 
        ('" . $nombre . "', '" . $sinopsis . "', '" . $url_web . "', '" . $titulo . "', " . $duracion . ", " . $anno . ",
        '" . $portada . "', " . $clasificacion . ", " . $distribuidora . ");");
    }

    public function get_peliculas()
    {
        $consulta = $this->ejecutar_consulta("select pelicula.nombre,pelicula.id,pelicula.portada from pelicula group by pelicula.id order by pelicula.id;
        ");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function eliminar_pelicula_por_id($id)
    {
        $this->ejecutar_consulta("delete from sesion where id_pelicula = " . $id . ";");
        $this->ejecutar_consulta("delete from reparto where id_pelicula = " . $id . ";");
        $this->ejecutar_consulta("delete from nacionalidad_pelicula where id_pelicula = " . $id . ";");
        $this->ejecutar_consulta("delete from direccion where id_pelicula = " . $id . ";");
        $this->ejecutar_consulta("delete from genero_pelicula where id_pelicula = " . $id . ";");
        $this->ejecutar_consulta("delete from pelicula where id = '" . $id . "';");
    }

    public function get_info_total_peliculas_por_id($id)
    {
        $consulta = $this->ejecutar_consulta("select * from pelicula where id = '" . $id . "';");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function update_pelicula_por_id($id, $nombre, $sinopsis, $url_web, $titulo, $duracion, $anno, $portada, $clasificacion, $distribuidora, $actores, $nacionalidad, $director, $generos)
    {
        //actualizar nacionalidad
        $this->update_nacionalidad($id, $nacionalidad);

        //Actualizar reparto
        //Eliminar todos los actores
        $this->eliminar_reparto_por_id_pelicula($id);
        //Añadir los nuevos
        foreach ($actores as $actor) {
            $this->insertar_actor_pelicula($actor, $id);
        }

        //actualizar direccion
        $this->eliminar_direccion_por_id_pelicula($id);
        foreach ($director as $d) {
            $this->insertar_director_pelicula($d, $id);
        }
        //actualizar genero
        $this->eliminar_genero_por_id_pelicula($id);
        foreach ($generos as $genero) {
            $this->insertar_genero_pelicula($genero, $id);
        }
        //actualizar pelicula
        $this->ejecutar_consulta("UPDATE pelicula
        SET nombre = '" . $nombre . "', sinopsis = '" . $sinopsis . "', web = '" . $url_web . "',
        titulo = '" . $titulo . "', duracion = " . $duracion . ", año =" . $anno . ",
        portada = '" . $portada . "', id_clasificacion = " . $clasificacion . ", id_distribuidora = '" . $distribuidora . "'
        WHERE id = " . $id . ";");

    }

    public function update_nacionalidad($id_pelicula, $id_nacionalidad)
    {
        $this->ejecutar_consulta("UPDATE nacionalidad_pelicula
        SET id_nacionalidad = " . $id_nacionalidad . "
        WHERE id_pelicula = " . $id_pelicula . ";");
    }

    public function eliminar_reparto_por_id_pelicula($id_pelicula)
    {
        $this->ejecutar_consulta("delete from reparto where id_pelicula = " . $id_pelicula . ";");
    }

    public function eliminar_direccion_por_id_pelicula($id_pelicula)
    {
        $this->ejecutar_consulta("delete from direccion where id_pelicula = " . $id_pelicula . ";");
    }

    public function eliminar_genero_por_id_pelicula($id_pelicula)
    {
        $this->ejecutar_consulta("delete from genero_pelicula where id_pelicula = " . $id_pelicula . ";");
    }

    public function get_peliculas_por_id($id)
    {
        $result = $this->ejecutar_consulta("SELECT * FROM Pelicula WHERE Pelicula.ID = " . $id . "");
        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public function get_sesiones_por_pelicula($id, $fecha)
    {
        $result = $this->ejecutar_consulta("SELECT Pase.hora FROM Pase
        INNER JOIN Sesion ON Sesion.ID_Pase = Pase.ID
        INNER JOIN Pelicula ON Pelicula.ID = Sesion.ID_Pelicula
        WHERE Pelicula.ID = " . $id . " AND Pase.dia = '" . $fecha . "' ORDER BY Pase.hora");
        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public function get_peliculas_valoraciones($id)
    {
        $result = $this->ejecutar_consulta("SELECT ROUND(AVG(Valoracion.puntuacion), 2) AS media_puntuacion FROM Valoracion 
        INNER JOIN Pelicula ON Valoracion.ID_Pelicula = Pelicula.ID 
        WHERE Pelicula.ID = " . $id . "");
        return $result;
    }

    public function get_comentarios_valoraciones($id)
    {
        $result = $this->ejecutar_consulta("SELECT * FROM Valoracion 
        INNER JOIN Pelicula ON Valoracion.ID_Pelicula = Pelicula.ID 
        WHERE Pelicula.ID = " . $id . "");
        return $result;
    }

    public function get_peliculas_clasificacion($id)
    {
        $result = $this->ejecutar_consulta("SELECT * FROM Clasificacion 
        INNER JOIN Pelicula ON Clasificacion.ID = Pelicula.ID_Clasificacion 
        WHERE Pelicula.ID = " . $id . "");
        return $result;
    }
    public function get_genero_por_pelicula($id)
    {
        $result = $this->ejecutar_consulta("SELECT * FROM Genero
        INNER JOIN Genero_Pelicula ON Genero_Pelicula.ID_Genero=Genero.ID
        INNER JOIN Pelicula ON Pelicula.ID = Genero_Pelicula.ID_Pelicula
        WHERE Pelicula.ID = " . $id . "");
        return $result;
    }
    public function get_actores_por_pelicula($id)
    {
        $result = $this->ejecutar_consulta("SELECT Actor.nombre, Actor.apellidos FROM Actor
        INNER JOIN Reparto ON Reparto.ID_Actor = Actor.ID
        INNER JOIN Pelicula ON Pelicula.ID = Reparto.ID_Pelicula
        WHERE Pelicula.ID = " . $id . "");
        return $result;
    }
    public function get_directores_por_pelicula($id)
    {
        $result = $this->ejecutar_consulta("SELECT Director.nombre, Director.apellidos FROM Director
        INNER JOIN Direccion ON Direccion.ID_Director = Director.ID
        INNER JOIN Pelicula ON Pelicula.ID = Direccion.ID_Pelicula
        WHERE Pelicula.ID = " . $id . "");
        return $result;
    }

    public function get_nacionalidad_pelicula($id)
    {
        $result = $this->ejecutar_consulta("SELECT Nacionalidad.nombre FROM Nacionalidad
        INNER JOIN Nacionalidad_Pelicula ON Nacionalidad_Pelicula.ID_Nacionalidad = Nacionalidad.ID
        INNER JOIN Pelicula ON Nacionalidad_Pelicula.ID_Pelicula = Pelicula.ID
        WHERE Pelicula.ID = " . $id . "");
        return $result;
    }

    public function get_reparto_por_id_pelicula($id)
    {
        $result = $this->ejecutar_consulta("SELECT id_actor FROM reparto
        WHERE id_pelicula = " . $id . "");
        return $result;
    }
    public function get_direccion_por_id_pelicula($id)
    {
        $result = $this->ejecutar_consulta("SELECT id_director FROM direccion
        WHERE id_pelicula = " . $id . "");
        return $result;
    }

    public function get_nacionalidad_por_id_pelicula($id)
    {
        $result = $this->ejecutar_consulta("SELECT id_nacionalidad FROM nacionalidad_pelicula
        WHERE id_pelicula = " . $id . "");
        return $result;
    }

    public function get_genero_por_id_pelicula($id)
    {
        $result = $this->ejecutar_consulta("SELECT id_genero FROM genero_pelicula
        WHERE id_pelicula = " . $id . "");
        return $result;
    }

    public function set_entrada_usuario_por_id($localizador, $usuario_id, $butaca, $pase, $sala, $pelicula)
    {
        $result = $this->ejecutar_consulta("INSERT INTO Entrada (localizador, ID_Usuario, ID_Butaca, ID_Pase_Sesion, ID_Sala_Sesion, ID_Pelicula_Sesion) VALUES ('" . $localizador . "', " . $usuario_id . ", " . $butaca . ", " . $pase . ", " . $sala . ", " . $pelicula . ")");
    }

    public function consultar_localizador($numero_aleatorio)
    {
        $result = $this->ejecutar_consulta("SELECT * FROM Entrada WHERE localizador= '" . $numero_aleatorio . "'");
        if (empty($result)) {
            // El numero se podra registrar
            return false;
        } else {
            return true;
        }
    }

    public function get_datos_entrada($id_pelicula, $hora, $fecha)
    {
        $result = $this->ejecutar_consulta("select * from sesion inner join pelicula on pelicula.id = sesion.id_pelicula
		inner join pase on pase.id = sesion.id_pase where pase.hora = '" . $hora . "' and 
		pase.dia='" . $fecha . "' and pelicula.id=" . $id_pelicula . "");
        return $result;
    }
    public function get_id_sala($id_pelicula, $hora, $fecha)
    {
        $result = $this->ejecutar_consulta("select sala.nombre as nombre from sesion inner join sala on sala.id = sesion.id_sala 
        inner join pelicula on pelicula.id = sesion.id_pelicula
		inner join pase on pase.id = sesion.id_pase where pase.hora = '" . $hora . "' and 
		pase.dia='" . $fecha . "' and pelicula.id=" . $id_pelicula . ";");
        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public function get_portada_por_id($id_pelicula)
    {
        $result = $this->ejecutar_consulta("select portada from pelicula where id=" . $id_pelicula . "");
        return $result;
    }

    public function get_numero_sesiones()
    {
        $consulta = $this->ejecutar_consulta(
            "SELECT COUNT(*) FROM Sesion INNER JOIN Pase 
            ON Sesion.ID_Pase = Pase.ID WHERE dia = (CURRENT_DATE AT TIME ZONE 'CET')::DATE;"
        );
        if (!empty($consulta)) {
            return $consulta[0]["count"];
        } else {
            return null;
        }
    }

    public function get_numero_sesiones_futuras()
    {
        $consulta = $this->ejecutar_consulta(
            "SELECT COUNT(*) FROM Sesion INNER JOIN Pase 
            ON Sesion.ID_Pase = Pase.ID WHERE dia > (CURRENT_DATE AT TIME ZONE 'CET')::DATE;"
        );
        if (!empty($consulta)) {
            return $consulta[0]["count"];
        } else {
            return null;
        }
    }

    public function get_numero_usuarios()
    {
        $consulta = $this->ejecutar_consulta(
            "SELECT COUNT(*) FROM Usuario;"
        );
        if (!empty($consulta)) {
            return $consulta[0]["count"];
        } else {
            return null;
        }
    }

    public function get_numero_peliculas_disponibles()
    {
        $consulta = $this->ejecutar_consulta(
            "SELECT COUNT(*) FROM (SELECT Pelicula.nombre FROM Pelicula INNER JOIN Sesion 
            ON Pelicula.ID = Sesion.ID_Pelicula INNER JOIN Pase ON Sesion.ID_Pase = Pase.ID 
            WHERE Pase.dia >= (CURRENT_DATE AT TIME ZONE 'CET')::DATE GROUP BY Pelicula.nombre) AS foo; "
        );
        if (!empty($consulta)) {
            return $consulta[0]["count"];
        } else {
            return null;
        }
    }

    public function get_valoracion_media()
    {
        $consulta = $this->ejecutar_consulta(
            "SELECT AVG(puntuacion) FROM Valoracion;"
        );
        if (!empty($consulta)) {
            return $consulta[0]["avg"];
        } else {
            return null;
        }
    }

    public function get_numero_butacas_reservadas()
    {
        $consulta = $this->ejecutar_consulta(
            "SELECT COUNT(Butaca.ID) from Butaca INNER JOIN Entrada ON Butaca.ID = Entrada.ID_Butaca 
            INNER JOIN Sesion ON Entrada.ID_Sala_Sesion = Sesion.ID_Sala
            AND Entrada.ID_Pelicula_Sesion = Sesion.ID_Pelicula AND 
            Entrada.ID_Pase_Sesion = Sesion.ID_Pase INNER JOIN Pase ON Sesion.ID_Pase = 
            Pase.ID WHERE Pase.dia >= (CURRENT_DATE AT TIME ZONE 'CET')::DATE; "
        );
        if (!empty($consulta)) {
            return $consulta[0]["count"];
        } else {
            return null;
        }
    }

    public function get_numero_butacas_ocupadas()
    {
        $consulta = $this->ejecutar_consulta(
            "SELECT COUNT(*) FROM Butaca
            INNER JOIN Entrada ON Butaca.ID = Entrada.ID_Butaca
            INNER JOIN Sesion ON Entrada.ID_Sala_Sesion = Sesion.ID_Sala
                AND Entrada.ID_Pelicula_Sesion = Sesion.ID_Pelicula
                AND Entrada.ID_Pase_Sesion = Sesion.ID_Pase
            INNER JOIN Pase ON Sesion.ID_Pase = Pase.ID
            INNER JOIN Pelicula ON Sesion.ID_Pelicula = Pelicula.ID
            WHERE Pase.dia = (CURRENT_DATE AT TIME ZONE 'CET')::DATE
                AND (CURRENT_TIME AT TIME ZONE 'CET')::TIME >= Pase.hora AND 
                (CURRENT_TIME AT TIME ZONE 'CET')::TIME <= Pase.hora + Pelicula.duracion * INTERVAL '1 minute';"
        );
        if (!empty($consulta)) {
            return $consulta[0]["count"];
        } else {
            return null;
        }
    }

    public function get_reservas_peliculas()
    {
        $consulta = $this->ejecutar_consulta(
            "SELECT Pelicula.nombre, COUNT(*) AS Reservas FROM Butaca
            INNER JOIN Entrada ON Butaca.ID = Entrada.ID_Butaca
            INNER JOIN Sesion ON Entrada.ID_Sala_Sesion = Sesion.ID_Sala
                AND Entrada.ID_Pelicula_Sesion = Sesion.ID_Pelicula
                AND Entrada.ID_Pase_Sesion = Sesion.ID_Pase
            INNER JOIN Pase ON Sesion.ID_Pase = Pase.ID
            INNER JOIN Pelicula ON Sesion.ID_Pelicula = Pelicula.ID
                WHERE Pase.dia >= (CURRENT_DATE AT TIME ZONE 'CET')::DATE
                GROUP BY Pelicula.nombre;"
        );
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function get_ranking_peliculas_vistas()
    {
        $consulta = $this->ejecutar_consulta(
            "SELECT Pelicula.nombre, COUNT(*) FROM Entrada 
            INNER JOIN Pelicula ON Entrada.ID_Pelicula_Sesion = Pelicula.ID
            INNER JOIN Pase ON Entrada.ID_Pase_Sesion = Pase.ID
            WHERE Pase.hora + Pase.dia + Pelicula.duracion * INTERVAL '1 minute' <= CURRENT_TIMESTAMP AT TIME ZONE 'CET'
            GROUP BY Pelicula.nombre; "
        );
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function get_ranking_peliculas_valoradas()
    {
        $consulta = $this->ejecutar_consulta(
            "SELECT Pelicula.nombre, ROUND(AVG(Valoracion.puntuacion), 2) AS valoracion_media FROM Pelicula 
            INNER JOIN Valoracion ON Pelicula.ID = Valoracion.ID_Pelicula
            GROUP BY Pelicula.nombre ORDER BY valoracion_media DESC;  "
        );
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function get_numero_butacas()
    {
        $consulta = $this->ejecutar_consulta(
            "SELECT COUNT(*) FROM Butaca;"
        );
        if (!empty($consulta)) {
            return $consulta[0]["count"];
        } else {
            return null;
        }
    }

    public function get_salas()
    {
        $consulta = $this->ejecutar_consulta(
            "SELECT * FROM sala;"
        );
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function insertar_sala($nombre, $filas, $columnas)
    {
        $this->ejecutar_consulta("insert into sala(nombre, filas, columnas) values ('" . $nombre . "', " . $filas . ", " . $columnas . ");");

        for ($i = 1; $i <= $filas; $i++) {
            for ($j = 1; $j <= $columnas; $j++) {
                $this->ejecutar_consulta("insert into butaca(fila, columna, id_sala) values (" . $i . ", " . $j . ", (select id from sala where nombre = '" . $nombre . "'));");
            }
        }
    }

    public function get_sala_por_nombre($nombre)
    {
        $consulta = $this->ejecutar_consulta("select * from sala where nombre = '" . $nombre . "';");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }
    public function eliminar_sala_por_id($id)
    {
        $this->ejecutar_consulta("delete from butaca where id_sala = '" . $id . "';");
        $this->ejecutar_consulta("delete from sala where id = '" . $id . "';");
    }

    public function get_sala_por_id($id)
    {
        $consulta = $this->ejecutar_consulta(
            "SELECT * FROM sala WHERE id = " . $id . ";"
        );
        if (!empty($consulta)) {
            return $consulta[0];
        } else {
            return null;
        }
    }

    public function update_sala_por_id($id, $nombre)
    {
        $consulta = $this->ejecutar_consulta(
            "update sala set nombre = '" . $nombre . "'
            where id = " . $id . ";"
        );
    }

    public function get_sesiones()
    {
        $consulta = $this->ejecutar_consulta(
            "select sesion.id_pelicula, pelicula.nombre as pelicula_nombre,
            sesion.id_sala, sala.nombre as sala_nombre,
            sesion.id_pase, concat(pase.dia, ' ', pase.hora) as fecha  from sesion
            inner join pelicula on pelicula.id = sesion.id_pelicula
            inner join sala on sala.id = sesion.id_sala
            inner join pase on pase.id = sesion.id_pase where pase.dia> (CURRENT_DATE AT TIME ZONE 'CET')::DATE
            and pase.hora>(CURRENT_TIME AT TIME ZONE 'CET')::TIME;"
        );
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function get_peliculas_id_nombre()
    {
        $consulta = $this->ejecutar_consulta(
            "select id,nombre from pelicula;"
        );
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function get_salas_id_nombre()
    {
        $consulta = $this->ejecutar_consulta(
            "select id,nombre from sala;"
        );
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function get_pases_id_fecha()
    {
        $consulta = $this->ejecutar_consulta(
            "select id,concat(dia, ' ', hora) as fecha from pase;"
        );
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function insertar_sesion($id_sala, $id_pelicula, $id_pase)
    {
        $this->ejecutar_consulta("insert into sesion(id_sala, id_pelicula, id_pase) values (" . $id_sala . ", " . $id_pelicula . ", " . $id_pase . ");");
    }

    public function eliminar_sesion($id_sala, $id_pelicula, $id_pase)
    {
        $this->ejecutar_consulta("delete from sesion where id_sala = " . $id_sala . " 
        and id_pelicula = " . $id_pelicula . " 
        and id_pase = " . $id_pase . ";");
    }

    public function get_sesion_por_ids($id_sala, $id_pelicula, $id_pase)
    {
        $consulta = $this->ejecutar_consulta(
            "select sesion.id_pelicula, pelicula.nombre as pelicula_nombre,
            sesion.id_sala, sala.nombre as sala_nombre,
            sesion.id_pase, concat(pase.dia, ' ', pase.hora) as fecha  from sesion
            inner join pelicula on pelicula.id = sesion.id_pelicula
            inner join sala on sala.id = sesion.id_sala
            inner join pase on pase.id = sesion.id_pase
            where sala.id = " . $id_sala . " and
            pase.id = " . $id_pase . " and
            pelicula.id = " . $id_pelicula . ";"
        );
        if (!empty($consulta)) {
            return $consulta[0];
        } else {
            return null;
        }
    }

    public function update_sesion($id_sala, $id_pelicula, $id_pase, $id_sala_new, $id_pelicula_new, $id_pase_new)
    {
        $this->ejecutar_consulta("UPDATE sesion
        SET id_sala = " . $id_sala_new . ", id_pelicula = " . $id_pelicula_new . ", id_pase = " . $id_pase_new . "
        WHERE id_sala = " . $id_sala . " and id_pelicula = " . $id_pelicula . " and id_pase = " . $id_pase . ";");
    }

    public function get_pases_actuales()
    {
        $consulta = $this->ejecutar_consulta(
            "select * from pase where dia >  (CURRENT_DATE AT TIME ZONE 'CET')::DATE or (pase.dia =  (CURRENT_DATE AT TIME ZONE 'CET')::DATE and pase.hora > (CURRENT_TIME AT TIME ZONE 'CET')::TIME );"
        );
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function insertar_pase($dia, $hora)
    {
        $this->ejecutar_consulta("insert into pase(hora, dia) values ('" . $hora . "', '" . $dia . "');");
    }

    public function eliminar_pase_por_id($id)
    {
        $this->ejecutar_consulta("delete from sesion where id_pase = " . $id . ";");
        $this->ejecutar_consulta("delete from pase where id = " . $id . ";");
    }

    public function get_pase_por_id($id)
    {
        $consulta = $this->ejecutar_consulta(
            "select * from pase where id = " . $id . ";"
        );
        if (!empty($consulta)) {
            return $consulta[0];
        } else {
            return null;
        }
    }

    public function update_pase_por_id($id, $dia, $hora)
    {
        $this->ejecutar_consulta("UPDATE pase
        SET dia = '" . $dia . "', hora = '" . $hora . "'
        WHERE id = " . $id . ";");
    }

    public function update_usuario_por_nick($nick, $nombre, $apellidos, $correo, $fecha_nacimiento)
    {
        $this->ejecutar_consulta("update usuario
        set nick = '" . $nick . "',
        nombre = '" . $nombre . "', apellidos = '" . $apellidos . "',
        correo = '" . $correo . "', fecha_nacimiento = '" . $fecha_nacimiento . "'
        where nick = '" . $nick . "';");
    }
    public function get_pelicula_comentada($nick, $nombre, $sala, $dia, $hora)
    {
        $consulta = $this->ejecutar_consulta("select count(*) as visto from valoracion
        inner join usuario on usuario.id = valoracion.id_usuario 
        inner join pelicula on pelicula.id = valoracion.id_pelicula
        where pelicula.id = 
        (select pelicula.id from sesion
        inner join pelicula on pelicula.id = sesion.id_pelicula
        inner join pase on pase.id = sesion.id_pase
        inner join sala on sala.id = sesion.id_sala
        where pelicula.nombre = '" . $nombre . "' 
        and sala.nombre = '" . $sala . "' 
        and pase.hora = '" . $hora . "' 
        and pase.dia = '" . $dia . "' ) 
        and nick = '" . $nick . "' ;");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function consultar_butaca_entrada($butaca, $pase, $sala, $pelicula)
    {
        $result = $this->ejecutar_consulta("SELECT * FROM Entrada WHERE ID_Butaca= " . $butaca . " AND ID_Pase_Sesion= " . $pase . " AND ID_Sala_Sesion= " . $sala . " AND ID_Pelicula_Sesion= " . $pelicula . "");
        if (empty($result)) {
            // El numero se podra registrar
            return false;
        } else {
            return true;
        }
    }

    public function get_nacionalidad()
    {
        $consulta = $this->ejecutar_consulta("select * from nacionalidad;");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function get_actores()
    {
        $consulta = $this->ejecutar_consulta("select * from actor;");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function get_directores()
    {
        $consulta = $this->ejecutar_consulta("select * from director;");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function get_generos()
    {
        $consulta = $this->ejecutar_consulta("select * from genero;");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function get_id_pelicula($nombre, $anno, $duracion)
    {
        $consulta = $this->ejecutar_consulta("select id from pelicula where nombre = '" . $nombre . "'
        and año = " . $anno . " and duracion = " . $duracion . ";");
        if (!empty($consulta)) {
            return $consulta[0]['id'];
        } else {
            return null;
        }
    }

    public function insertar_nacionalidad_pelicula($id_nacionalidad, $id_pelicula)
    {
        $this->ejecutar_consulta("insert into nacionalidad_pelicula(id_nacionalidad, id_pelicula) values (" . $id_nacionalidad . "," . $id_pelicula . ");");
    }

    public function insertar_actor_pelicula($id_actor, $id_pelicula)
    {
        $this->ejecutar_consulta("insert into reparto(id_actor, id_pelicula) values (" . $id_actor . "," . $id_pelicula . ");");
    }

    public function insertar_director_pelicula($id_director, $id_pelicula)
    {
        $this->ejecutar_consulta("insert into direccion(id_director, id_pelicula) values (" . $id_director . "," . $id_pelicula . ");");
    }

    public function insertar_genero_pelicula($id_genero, $id_pelicula)
    {
        $this->ejecutar_consulta("insert into genero_pelicula(id_genero, id_pelicula) values (" . $id_genero . "," . $id_pelicula . ");");
    }

    public function insertar_nacionalidad($nombre)
    {
        $this->ejecutar_consulta("insert into nacionalidad(nombre) values ('" . $nombre . "');");
    }

    public function insertar_actor($nombre, $apellidos, $nacimiento)
    {
        $this->ejecutar_consulta("insert into actor(nombre, apellidos, nacimiento) values ('" . $nombre . "','" . $apellidos . "','" . $nacimiento . "');");
    }

    public function insertar_director($nombre, $apellidos, $nacimiento)
    {
        $this->ejecutar_consulta("insert into director(nombre, apellidos, nacimiento) values ('" . $nombre . "','" . $apellidos . "','" . $nacimiento . "');");
    }

    public function insertar_genero($tipo)
    {
        $this->ejecutar_consulta("insert into genero(tipo) values ('" . $tipo . "');");
    }

    public function get_nacionalidad_por_nombre($nombre)
    {
        $consulta = $this->ejecutar_consulta("select * from nacionalidad where nombre = '" . $nombre . "';");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function get_actor_por_nombre_apellidos_nacimiento($nombre, $apellidos, $nacimiento)
    {
        $consulta = $this->ejecutar_consulta("select * from actor where nombre = '" . $nombre . "' and apellidos = '" . $apellidos . "' and nacimiento = '" . $nacimiento . "';");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function get_director_por_nombre_apellidos_nacimiento($nombre, $apellidos, $nacimiento)
    {
        $consulta = $this->ejecutar_consulta("select * from director where nombre = '" . $nombre . "' and apellidos = '" . $apellidos . "' and nacimiento = '" . $nacimiento . "';");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function get_genero_por_tipo($tipo)
    {
        $consulta = $this->ejecutar_consulta("select * from genero where tipo = '" . $tipo . "';");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function insertar_clasificacion($edad)
    {
        $this->ejecutar_consulta("insert into clasificacion(edad) values (" . $edad . ");");
    }

    public function insertar_distribuidora($nombre, $correo)
    {
        $this->ejecutar_consulta("insert into distribuidora(nombre, correo) values ('" . $nombre . "', '" . $correo . "');");
    }

    public function get_clasificacion_por_edad($edad)
    {
        $consulta = $this->ejecutar_consulta("select * from clasificacion where edad = " . $edad . ";");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function get_distribuidora_por_nombre_correo($nombre, $correo)
    {
        $consulta = $this->ejecutar_consulta("select * from distribuidora where nombre = '" . $nombre . "' and correo = '" . $correo . "';");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }


    public function get_info_generos_actuales()
    {
        $consulta = $this->ejecutar_consulta("SELECT tipo, COUNT(tipo) FROM (
            SELECT Pelicula.nombre, Genero.tipo FROM Pelicula INNER JOIN Genero_Pelicula ON Pelicula.ID = Genero_Pelicula.ID_Pelicula
            INNER JOIN Genero ON Genero_Pelicula.ID_Genero = Genero.ID INNER JOIN Sesion ON Pelicula.ID = Sesion.ID_Pelicula 
            INNER JOIN Pase ON Sesion.ID_Pase = Pase.ID
            WHERE Pase.hora + Pase.dia + Pelicula.duracion * INTERVAL '1 minute' > CURRENT_TIMESTAMP AT TIME ZONE 'CET'
            GROUP BY nombre, tipo
        ) AS FOO GROUP BY tipo");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function get_info_generos_mas_vistos()
    {
        $consulta = $this->ejecutar_consulta("SELECT genero.tipo, COUNT(*) FROM genero_pelicula
        INNER JOIN Genero ON genero.id = genero_pelicula.id_genero
        INNER JOIN Entrada ON entrada.id_pelicula_sesion = genero_pelicula.id_pelicula
        INNER JOIN Pelicula ON Pelicula.ID = Entrada.ID_Pelicula_Sesion
        INNER JOIN Pase ON pase.id = entrada.id_pase_sesion
        WHERE Pase.hora + Pase.dia + Pelicula.duracion * INTERVAL '1 minute' <= CURRENT_TIMESTAMP AT TIME ZONE 'CET'
        GROUP BY genero.id, genero.tipo;");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function get_hora_dia_por_pase($id)
    {
        $consulta = $this->ejecutar_consulta("select hora, dia as fecha from pase where id = " . $id . ";");
        if (!empty($consulta)) {
            return $consulta[0];
        } else {
            return null;
        }
    }

    public function get_sala_nombre_por_id($id)
    {
        $consulta = $this->ejecutar_consulta("select nombre from sala where id = " . $id . ";");
        if (!empty($consulta)) {
            return $consulta[0];
        } else {
            return null;
        }
    }

    public function get_pase_hora_dia($hora, $dia)
    {
        $consulta = $this->ejecutar_consulta("select id from pase where hora = '" . $hora . "' and dia = '" . $dia . "';");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }
}
?>