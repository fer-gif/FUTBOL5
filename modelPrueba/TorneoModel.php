<?php
require_once 'model/conexion.php';
require_once 'model/Equipo.php';
class TorneoModel
{
    /*private $db;
        private $connection;

        public function __construct($db){
            $this->db = $db;
            $this->connection=$this->db->getConnection();

        }*/



    private $connection;

    public function __construct()
    {
        $this->connection = new Conexion();
    }


    public function getTorneo()
    {
        $c = $this->connection->getConnection();
        $sentence = $c->prepare("select * from equipos ORDER BY Puntos ASC");
        $sentence->execute();
        $sentence->setFetchMode(PDO::FETCH_CLASS, 'Equipo');
        $positions = $sentence->fetchAll();
        $c = null;
        return $positions;
    }

    public function deleteEquipo($id)
    {
        $c = $this->connection->getConnection();
        $sentence = $c->prepare("DELETE FROM equipos WHERE id_equipo=?");
        $response = $sentence->execute(array($id));
        $c = null;
    }



    public function deleteJugador($id)
    {
        $c = $this->connection->getConnection();
        $sentence = $c->prepare("DELETE FROM jugadores WHERE ID_Jquipo=?");
        $response = $sentence->execute(array($id));
        $c = null;
    }

    public function addJugador($nombre, $apellido, $dni, $pos, $tel, $equipo)
    {
        $c = $this->connection->getConnection();
        $sentence = $c->prepare("INSERT INTO equipos(Nombre,Apellido,DNI,Posicion,Numero_Tel,ID_Equipo) VALUES(?,?,?,?,?,?)");
        $sentence->execute(array($nombre, $apellido, $dni, $pos, $tel, $equipo));
        $lastId = $c->lastInsertId();
        $c = null;
        return $lastId;
    }
}
