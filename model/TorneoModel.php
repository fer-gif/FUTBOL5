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
        $sentence = $c->prepare("SELECT id_equipo, nombre FROM equipos");
        $sentence->execute();
        $sentence->setFetchMode(PDO::FETCH_OBJ);
        $positions = $sentence->fetchAll();
        $equipos = [];
        foreach ($positions as $equipo) {
            array_push($equipos, new Equipo($equipo->id_equipo, $equipo->nombre));
        }
        $c = null;
        return $equipos;
    }

    public function deleteEquipo($id)
    {
        $c = $this->connection->getConnection();
        $sentence = $c->prepare("DELETE FROM equipos WHERE ID_Equipo=?");
        $response = $sentence->execute(array($id));
        $c = null;
    }

    public function addEquipo($nombre)
    {
        $c = $this->connection->getConnection();
        $sentence = $c->prepare("INSERT INTO equipos(Nombre) VALUES(?)");
        $sentence->execute(array($nombre));
        $lastId = $c->lastInsertId();
        $c = null;
        return $lastId;
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
