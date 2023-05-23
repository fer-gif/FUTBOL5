<?php
require_once 'model/conexion.php';
    class TorneoModel{
        private $db;
        private $connection;

        public function __construct($db){
            $this->db = $db;
            $this->connection=$this->db->getConnection();

        }

        public function getTorneo(){
            $sentence = $this->connection->prepare( "select * from equipos ORDER BY Puntos ASC");
            $sentence->execute();
            $positions = $sentence->fetchAll(PDO::FETCH_OBJ);
            return $positions;

        }

        public function deleteEquipo($id){
            $sentence = $this->connection->prepare("DELETE FROM equipos WHERE ID_Equipo=?");
            $response = $sentence->execute(array($id));
        }

        public function addEquipo($nombre){
            $sentence = $this->connection->prepare("INSERT INTO equipos(Nombre) VALUES(?)");
            $sentence->execute(array($nombre));
            return $this->connection->lastInsertId();
    
        }

        public function deleteJugador($id){
            $sentence = $this->connection->prepare("DELETE FROM jugadores WHERE ID_Jquipo=?");
            $response = $sentence->execute(array($id));
        }
        
        public function addJugador($nombre,$apellido,$dni,$pos,$tel,$equipo){
            $sentence = $this->connection->prepare("INSERT INTO equipos(Nombre,Apellido,DNI,Posicion,Numero_Tel,ID_Equipo) VALUES(?,?,?,?,?,?)");
            $sentence->execute(array($nombre,$apellido,$dni,$pos,$tel,$equipo));
            return $this->connection->lastInsertId();
        }
        

}




?>