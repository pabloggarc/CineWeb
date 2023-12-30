<?php
    class Datos{
        private $bd; 
        private $host; 
        private $bd_nombre; 
        private $usuario; 
        private $pass; 

        public function __construct($host, $bd_nombre, $usuario, $pass){
            $this->host = $host;
            $this->bd_nombre = $bd_nombre;
            $this->usuario = $usuario;
            $this->pass = $pass;
        }

        public function conectar(){
            try{
                $this->bd = new PDO("pgsql:host = $this->host; dbname= $this->bd_nombre", $this->usuario, $this->pass);
                $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } 
            catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }

        public function desconectar(){
            unset($this->bd);
        }

        private function ejecutar_consulta($query){
            $stmt = $this->bd->query($query);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function get_pruebas(){
            $result = $this->ejecutar_consulta("SELECT * FROM prueba");
            return $result;   
        }

        public function get_dim_sala($nombre_sala){
            $result = $this->ejecutar_consulta("SELECT filas, columnas FROM Sala WHERE nombre = '".$nombre_sala."' LIMIT 1; ");
            if(!empty($result)){
                return array($result[0]['filas'], $result[0]['columnas']);
            }
            else{
                return null;
            }
        }

        public function get_ocupacion_sala($nombre_sala, $fecha, $hora){
            $consulta = "SELECT CASE WHEN Butaca.ID IN (
                SELECT Butaca.ID from Butaca INNER JOIN Entrada ON Butaca.ID = Entrada.ID_Butaca 
                INNER JOIN Sala ON Entrada.ID_Sala_Sesion = Sala.ID INNER JOIN Sesion ON Entrada.ID_Pase_Sesion = Sesion.ID_Pase AND
                Entrada.ID_Sala_Sesion = Sesion.ID_Sala AND Entrada.ID_Pelicula_Sesion = Sesion.ID_Pelicula INNER JOIN Pase ON
                Sesion.ID_Pase = Pase.ID INNER JOIN Pelicula ON Sesion.ID_Pelicula = Pelicula.ID WHERE Sala.nombre = '".$nombre_sala."' AND 
                Pase.dia = '".$fecha."' AND Pase.hora = '".$hora."'
            ) 	THEN 0
                ELSE 1 END AS libre
            FROM Butaca; ";
            $result = $this->ejecutar_consulta($consulta);
            if(!empty($result)){
                $ocupacion = array();
                foreach($result as $fila){
                    array_push($ocupacion, $fila['libre']);
                }
                return $ocupacion;
            }
            else{
                return null;
            }
        }

        public function insertar_nuevo_usuario($nick, $clave, $nombre, $apellidos, $correo, $fecha_nacimiento){
            $result = $this->ejecutar_consulta("INSERT INTO Usuario (nick, clave, nombre, apellidos, correo, fecha_nacimiento, ID_Rol)
            VALUES ( '".$nick."' , '".$clave."', '".$nombre."' , '".$apellidos."', '".$correo."', '".$fecha_nacimiento."', 1)");
        }
    }
?>