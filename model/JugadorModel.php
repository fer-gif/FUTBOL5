<?php
require_once 'model/Conexion.php';

class JugadorModel
{
    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new Conexion();
        } catch (PDOException $e) {
            throw new Exception($e);
        }
    }


    public function getJugadores($idEquipo = null)
    {
        $conexion = $this->connection->getConnection();
        if (isset($idEquipo)) {
            $sentence = $conexion->prepare("SELECT j.*,e.nombre AS nombre_equipo FROM jugadores j 
                                        INNER JOIN equipos e
                                        ON j.id_equipo=e.id_equipo
                                        WHERE e.id_equipo=:idEquipo");
            $sentence->bindParam(":idEquipo", $idEquipo);
        } else
            $sentence = $conexion->prepare("SELECT * FROM jugadores");

        $sentence->execute();
        $sentence->setFetchMode(PDO::FETCH_ASSOC);
        $jugadores = $sentence->fetchAll();

        return $jugadores;
    }

    public function getJugador($id = null, $dni = null)
    {
        $conexion = $this->connection->getConnection();
        if (isset($id) && (!empty($id))) {
            $sentence = $conexion->prepare("SELECT j.*, e.nombre AS nombre_equipo FROM jugadores j 
                                        INNER JOIN equipos e ON j.id_equipo = e.id_equipo
                                        WHERE j.id_jugador=:idJugador");
            $sentence->bindParam(":idJugador", $id);
        } elseif (isset($dni) && (!empty($dni))) {
            $sentence = $conexion->prepare("SELECT j.*, e.nombre AS nombre_equipo FROM jugadores j 
                                        INNER JOIN equipos e ON j.id_equipo = e.id_equipo
                                        WHERE j.dni=:dni");
            $sentence->bindParam(":dni", $dni);
        }
        $sentence->execute();
        $sentence->setFetchMode(PDO::FETCH_OBJ);
        $jugador = $sentence->fetch();

        return $jugador;
    }

    public function addJugador($nombre, $apellido, $dni, $posicion, $telefono, $foto, $id_equipo,)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("INSERT INTO jugadores (nombre,apellido,dni,telefono,posicion,foto,id_equipo) 
                                        VALUES(?,?,?,?,?,?,?)");
        $sentence->execute(array($nombre, $apellido, $dni, $telefono, $posicion, $foto, $id_equipo,));
        $lastId = $conexion->lastInsertId();
        $conexion = null;
        return $lastId;
    }

    public function deleteJugador($id_jugador)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("DELETE FROM jugadores WHERE id_jugador=?");
        $response = $sentence->execute(array($id_jugador));
        $conexion = null;

        return $response;
    }

    public function updateJugador($idJugador, $nombre, $apellido, $dni, $telefono, $posicion)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("UPDATE jugadores
                                    SET nombre = ? , apellido=? , dni=? , telefono=? , posicion=?
                                    WHERE id_jugador = ?");
        $response = $sentence->execute(array($nombre, $apellido, $dni, $telefono, $posicion, $idJugador));
        $conexion = null;

        return $response;
    }
}
