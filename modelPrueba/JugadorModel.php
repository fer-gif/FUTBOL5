<?php
require_once 'model/ConexionModel.php';

class JugadorModel
{
    private $connection;

    public function __construct()
    {
        $this->connection = new Conexion();
    }

    public function getjugadores($idEquipo)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("SELECT * FROM jugadores WHERE jugadores.id_equipo = :idEquipo");
        $sentence->bindParam(":idEquipo", $idEquipo);
        $sentence->execute();
        $sentence->setFetchMode(PDO::FETCH_CLASS, 'Jugador');
        $jugadores = $sentence->fetchAll();
        $conexion = null;
        return $jugadores;
    }

    public function getJugador($idJugador)
    {
    }

    public function addJugador($nombre, $apellido, $dni, $pos, $tel, $equipo)
    {
        $conexion = $this->connection->getConnection();
        try {
            $sentence = $conexion->prepare("INSERT INTO jugadores(nombre,apellido,dni,posicion,numero_tel,id_equipo) VALUES(?,?,?,?,?,?)");
            $sentence->execute(array($nombre, $apellido, $dni, $pos, $tel, $equipo));
            $lastId = $conexion->lastInsertId();
        } catch (PDOException $e) {
            $lastId = -1;
            print($e);
            die();
        }
        $conexion = null;
        return $lastId;
    }
}
