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
                Pase.dia = '" . $fecha . "' AND Pase.hora = '" . $hora . "'
            ) 	THEN 0
                ELSE 1 END AS libre
            FROM Butaca; ";
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
        $consulta = $this->ejecutar_consulta("DELETE FROM Usuario WHERE nick= '" . $nick . "'");
    }


    public function get_peliculas_no_vistas_por_nick($nick)
    {
        $consulta = $this->ejecutar_consulta("select pelicula.nombre, pase.hora, pase.dia, sala.nombre as sala from entrada 
            inner join usuario on usuario.id = entrada.id_usuario 
            inner join pase on pase.id = entrada.id_pase_sesion 
            inner join sala on sala.id = entrada.id_sala_sesion 
            inner join pelicula on pelicula.id = entrada.id_pelicula_sesion 
            WHERE usuario.nick= '" . $nick . "' and pase.dia > CURRENT_DATE or (pase.dia = CURRENT_DATE and pase.hora > CURRENT_TIME)
            group by pelicula.nombre, pase.hora, pase.dia, sala.nombre;");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }

    public function get_butaca_por_entrada($nick, $pelicula, $dia_pase, $hora_pase, $sala)
    {
        $consulta = $this->ejecutar_consulta("select entrada.id_butaca, butaca.fila, butaca.columna from entrada inner join usuario on usuario.id = entrada.id_usuario 
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
        $consulta = $this->ejecutar_consulta("select pelicula.nombre, pase.hora, pase.dia, sala.nombre as sala, 
            (select count(*) from valoracion where id_usuario = (select id from usuario where nick ='" . $nick . "')) as visto from entrada 
                        inner join usuario on usuario.id = entrada.id_usuario 
                        inner join pase on pase.id = entrada.id_pase_sesion 
                        inner join sala on sala.id = entrada.id_sala_sesion 
                        inner join pelicula on pelicula.id = entrada.id_pelicula_sesion 
                        WHERE usuario.nick= '" . $nick . "' and pase.dia < CURRENT_DATE or (pase.dia = CURRENT_DATE and pase.hora < CURRENT_TIME)
                        group by pelicula.nombre, pase.hora, pase.dia, sala.nombre;");
        if (!empty($consulta)) {
            return $consulta;
        } else {
            return null;
        }
    }
}


?>