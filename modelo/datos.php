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

    public function get_info_peliculas($id,$fecha)
    {
        $consulta = $this->ejecutar_consulta("select pase.hora, pase.dia from sesion
        inner join pase on pase.id = sesion.id_pase
        inner join pelicula on pelicula.id = sesion.id_pelicula
        where pelicula.id = '" . $id . "' AND Pase.dia = '".$fecha."' AND pase.hora > CURRENT_TIME ORDER BY Pase.hora ;");
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

    public function update_pelicula_por_id($id, $nombre, $sinopsis, $url_web, $titulo, $duracion, $anno, $portada, $clasificacion, $distribuidora)
    {
        $this->ejecutar_consulta("UPDATE pelicula
        SET nombre = '" . $nombre . "', sinopsis = '" . $sinopsis . "', web = '" . $url_web . "',
        titulo = '" . $titulo . "', duracion = " . $duracion . ", año =" . $anno . ",
        portada = '" . $portada . "', id_clasificacion = " . $clasificacion . ", id_distribuidora = '" . $distribuidora . "'
        WHERE id = " . $id . ";");

    }

    public function get_peliculas_por_id($id){
        $result = $this->ejecutar_consulta("SELECT * FROM Pelicula WHERE Pelicula.ID = ".$id."");
        if(!empty($result)){
            return $result;
        }else{
            return null;
        }
    }

    public function get_sesiones_por_pelicula($id, $fecha){
        $result = $this->ejecutar_consulta("SELECT Pase.hora FROM Pase
        INNER JOIN Sesion ON Sesion.ID_Pase = Pase.ID
        INNER JOIN Pelicula ON Pelicula.ID = Sesion.ID_Pelicula
        WHERE Pelicula.ID = ".$id." AND Pase.dia = '".$fecha."' ORDER BY Pase.hora");
        if(!empty($result)){
            return $result;
        }else{
            return null;
        }
    }

    public function get_peliculas_valoraciones($id){
        $result = $this->ejecutar_consulta("SELECT ROUND(AVG(Valoracion.puntuacion), 2) AS media_puntuacion FROM Valoracion 
        INNER JOIN Pelicula ON Valoracion.ID_Pelicula = Pelicula.ID 
        WHERE Pelicula.ID = ".$id."");
        return $result;
    }

    public function get_peliculas_clasificacion($id){
        $result = $this->ejecutar_consulta("SELECT * FROM Clasificacion 
        INNER JOIN Pelicula ON Clasificacion.ID = Pelicula.ID_Clasificacion 
        WHERE Pelicula.ID = ".$id."");
        return $result;
    }
    public function get_genero_por_pelicula($id){
        $result = $this->ejecutar_consulta("SELECT * FROM Genero
        INNER JOIN Genero_Pelicula ON Genero_Pelicula.ID_Genero=Genero.ID
        INNER JOIN Pelicula ON Pelicula.ID = Genero_Pelicula.ID_Pelicula
        WHERE Pelicula.ID = ".$id."");
        return $result;
    }
    public function get_actores_por_pelicula($id){
        $result = $this->ejecutar_consulta("SELECT Actor.nombre, Actor.apellidos FROM Actor
        INNER JOIN Reparto ON Reparto.ID_Actor = Actor.ID
        INNER JOIN Pelicula ON Pelicula.ID = Reparto.ID_Pelicula
        WHERE Pelicula.ID = ".$id."");
        return $result;
    }
    public function get_directores_por_pelicula($id){
        $result = $this->ejecutar_consulta("SELECT Director.nombre, Director.apellidos FROM Director
        INNER JOIN Direccion ON Direccion.ID_Director = Director.ID
        INNER JOIN Pelicula ON Pelicula.ID = Direccion.ID_Pelicula
        WHERE Pelicula.ID = ".$id."");
        return $result;
    }

    public function get_nacionalidad_pelicula($id){
        $result = $this->ejecutar_consulta("SELECT Nacionalidad.nombre FROM Nacionalidad
        INNER JOIN Nacionalidad_Pelicula ON Nacionalidad_Pelicula.ID_Nacionalidad = Nacionalidad.ID
        INNER JOIN Pelicula ON Nacionalidad_Pelicula.ID_Pelicula = Pelicula.ID
        WHERE Pelicula.ID = ".$id."");
        return $result;
    }
    public function set_entrada_usuario_por_id($localizador,$usuario_id,$butaca,$pase,$sala,$pelicula){
        $result = $this->ejecutar_consulta("INSERT INTO Entrada (localizador, ID_Usuario, ID_Butaca, ID_Pase_Sesion, ID_Sala_Sesion, ID_Pelicula_Sesion) VALUES ('".$localizador."', ".$usuario_id.", ".$butaca.", ".$pase.", ".$sala.", ".$pelicula.")");
    }

    public function consultar_localizador($numero_aleatorio){
        $result = $this->ejecutar_consulta("SELECT * FROM Entrada WHERE localizador= '".$numero_aleatorio."'");
        if(empty($result)){
            // El numero se podra registrar
            return false;
        }else{
            return true;
        }
    }

    public function get_datos_entrada($id_pelicula,$hora,$fecha){
        $result = $this->ejecutar_consulta("select * from sesion inner join pelicula on pelicula.id = sesion.id_pelicula
		inner join pase on pase.id = sesion.id_pase where pase.hora = '".$hora."' and 
		pase.dia='".$fecha."' and pelicula.id=".$id_pelicula."");
        return $result;
    }
    public function get_id_sala($id_pelicula,$hora,$fecha){
        $result = $this->ejecutar_consulta("select sala.nombre as nombre from sesion inner join sala on sala.id = sesion.id_sala 
        inner join pelicula on pelicula.id = sesion.id_pelicula
		inner join pase on pase.id = sesion.id_pase where pase.hora = '".$hora."' and 
		pase.dia='".$fecha."' and pelicula.id=".$id_pelicula."");
        return $result;
    }

    public function get_portada_por_id($id_pelicula){
        $result = $this->ejecutar_consulta("select portada from pelicula where id=".$id_pelicula."");
        return $result;
    }

    public function get_numero_sesiones(){
        $consulta = $this->ejecutar_consulta(
            "SELECT COUNT(*) FROM Sesion INNER JOIN Pase 
            ON Sesion.ID_Pase = Pase.ID WHERE dia = CURRENT_DATE AT TIME ZONE 'GMT';"
        );
        if (!empty($consulta)) {
            return $consulta[0]["count"];
        } else {
            return null;
        }
    }

    public function get_numero_sesiones_futuras(){
        $consulta = $this->ejecutar_consulta(
            "SELECT COUNT(*) FROM Sesion INNER JOIN Pase 
            ON Sesion.ID_Pase = Pase.ID WHERE dia > CURRENT_DATE AT TIME ZONE 'GMT';"
        );
        if (!empty($consulta)) {
            return $consulta[0]["count"];
        } else {
            return null;
        }
    }

    public function get_numero_usuarios(){
        $consulta = $this->ejecutar_consulta(
            "SELECT COUNT(*) FROM Usuario;"
        );
        if (!empty($consulta)) {
            return $consulta[0]["count"];
        } else {
            return null;
        }
    }

    public function get_numero_peliculas_disponibles(){
        $consulta = $this->ejecutar_consulta(
            "SELECT COUNT(*) FROM (SELECT Pelicula.nombre FROM Pelicula INNER JOIN Sesion 
            ON Pelicula.ID = Sesion.ID_Pelicula INNER JOIN Pase ON Sesion.ID_Pase = Pase.ID 
            WHERE Pase.dia >= CURRENT_DATE AT TIME ZONE 'GMT' GROUP BY Pelicula.nombre) AS foo; "
        );
        if (!empty($consulta)) {
            return $consulta[0]["count"];
        } else {
            return null;
        }
    }

    public function get_valoracion_media(){
        $consulta = $this->ejecutar_consulta(
            "SELECT AVG(puntuacion) FROM Valoracion;"
        );
        if (!empty($consulta)) {
            return $consulta[0]["avg"];
        } else {
            return null;
        }
    }

    public function get_numero_butacas_reservadas(){
        $consulta = $this->ejecutar_consulta(
            "SELECT COUNT(Butaca.ID) from Butaca INNER JOIN Entrada ON Butaca.ID = Entrada.ID_Butaca 
            INNER JOIN Sesion ON Entrada.ID_Sala_Sesion = Sesion.ID_Sala
            AND Entrada.ID_Pelicula_Sesion = Sesion.ID_Pelicula AND 
            Entrada.ID_Pase_Sesion = Sesion.ID_Pase INNER JOIN Pase ON Sesion.ID_Pase = 
            Pase.ID WHERE Pase.dia >= CURRENT_DATE AT TIME ZONE 'GMT'; "
        );
        if (!empty($consulta)) {
            return $consulta[0]["count"];
        } else {
            return null;
        }
    }

    public function get_numero_butacas_ocupadas(){
        $consulta = $this->ejecutar_consulta(
            "SELECT COUNT(Butaca.ID)
            FROM Butaca
            INNER JOIN Entrada ON Butaca.ID = Entrada.ID_Butaca
            INNER JOIN Sesion ON Entrada.ID_Sala_Sesion = Sesion.ID_Sala
                AND Entrada.ID_Pelicula_Sesion = Sesion.ID_Pelicula
                AND Entrada.ID_Pase_Sesion = Sesion.ID_Pase
            INNER JOIN Pase ON Sesion.ID_Pase = Pase.ID
            INNER JOIN Pelicula ON Sesion.ID_Pelicula = Pelicula.ID
            WHERE Pase.dia = CURRENT_DATE AT TIME ZONE 'GMT'
                AND CURRENT_TIME AT TIME ZONE 'GMT' >= Pase.hora AND 
                CURRENT_TIME AT TIME ZONE 'GMT' <= Pase.hora + Pelicula.duracion * INTERVAL '1 minute';
             "
        );
        if (!empty($consulta)) {
            return $consulta[0]["count"];
        } else {
            return null;
        }
    }

    public function get_numero_butacas(){
        $consulta = $this->ejecutar_consulta(
            "SELECT COUNT(*) FROM Butaca;"
        );
        if (!empty($consulta)) {
            return $consulta[0]["count"];
        } else {
            return null;
        }
    }
}


?>