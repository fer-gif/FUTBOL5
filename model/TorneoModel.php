<?php
require_once 'model/ConexionModel.php';
require_once 'model/EquipoModel.php';
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
        $sentence = $c->prepare("select * from equipos ORDER BY puntos ASC");
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

    public function addEquipo($nombre)
    {
        $c = $this->connection->getConnection();
        $sentence = $c->prepare("INSERT INTO equipos(nombre) VALUES(?)");
        $sentence->execute(array($nombre));
        $lastId = $c->lastInsertId();
        $c = null;
        return $lastId;
    }

    public function deleteJugador($id)
    {
        $c = $this->connection->getConnection();
        $sentence = $c->prepare("DELETE FROM jugadores WHERE id_jugador=?");
        $response = $sentence->execute(array($id));
        $c = null;
    }

    public function addJugador($nombre, $apellido, $dni, $pos, $tel, $equipo)
    {
        $c = $this->connection->getConnection();
        $sentence = $c->prepare("INSERT INTO equipos(nombre,apellido,dni,posicion,numero_tel,id_equipo) VALUES(?,?,?,?,?,?)");
        $sentence->execute(array($nombre, $apellido, $dni, $pos, $tel, $equipo));
        $lastId = $c->lastInsertId();
        $c = null;
        return $lastId;
    }
}
