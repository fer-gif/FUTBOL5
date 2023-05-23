<?php
    class TorneoModel{
        
       
        private $db;

        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;'.'dbname=db_appfutbol;charset=utf8', 'root', '');
          
        }

        

        public function getTorneo(){
            $sentence = $this->db->prepare( "select * from equipos ORDER BY Puntos ASC");
            $sentence->execute();
            $positions = $sentence->fetchAll(PDO::FETCH_OBJ);
            return $positions;

        }

        public function deleteEquipo($id){
            $sentence = $this->db->prepare("DELETE FROM equipos WHERE ID_Equipo=?");
            $response = $sentence->execute(array($id));
        }

        public function addEquipo($nombre){
            $sentence = $this->db->prepare("INSERT INTO equipos(Nombre) VALUES(?)");
            $sentence->execute(array($nombre));
            return $this->db->lastInsertId();
    
        }

        public function deleteJugador($id){
            $sentence = $this->db->prepare("DELETE FROM jugadores WHERE ID_Jquipo=?");
            $response = $sentence->execute(array($id));
        }
        
        public function addJugador($nombre,$apellido,$dni,$pos,$tel,$equipo){
            $sentence = $this->db->prepare("INSERT INTO equipos(Nombre,Apellido,DNI,Posicion,Numero_Tel,ID_Equipo) VALUES(?,?,?,?,?,?)");
            $sentence->execute(array($nombre,$apellido,$dni,$pos,$tel,$equipo));
            return $this->db->lastInsertId();
        }
        

}




?>