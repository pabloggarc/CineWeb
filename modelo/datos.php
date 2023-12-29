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
    }
?>