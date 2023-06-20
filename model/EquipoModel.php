<?php
require_once 'model/Conexion.php';
class EquipoModel
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

    public function getEquipos()
    {
        $conexion = $this->connection->getConnection();

        $sentence = $conexion->prepare("SELECT * FROM equipos");
        $sentence->execute();
        $sentence->setFetchMode(PDO::FETCH_OBJ);
        $equipos = $sentence->fetchAll();
        return $equipos;


        $conexion = null;
    }

    public function getEquipo($idEquipo = null, $nombre = null)
    {
        $conexion = $this->connection->getConnection();
        if (isset($idEquipo)) {
            $sentence = $conexion->prepare("SELECT * FROM equipos
            WHERE id_equipo=:idEquipo");
            $sentence->bindParam(":idEquipo", $idEquipo);
        } elseif (isset($nombre)) {
            $sentence = $conexion->prepare("SELECT * FROM equipos
            WHERE nombre=:nombre");
            $sentence->bindParam(":nombre", $nombre);
        } else {
            return null;
            exit();
        }

        $sentence->execute();
        $sentence->setFetchMode(PDO::FETCH_OBJ);
        $equipo = $sentence->fetch();

        return $equipo;
    }


    public function addEquipo($nombre)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("INSERT INTO equipos(nombre) VALUES(?)");
        $sentence->execute(array($nombre));
        $lastId = $conexion->lastInsertId();
        $conexion = null;
        return $lastId;
    }

    public function deleteEquipo($idEquipo)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("DELETE FROM equipos WHERE id_equipo=?");
        $response = $sentence->execute(array($idEquipo));
        $conexion = null;

        return $response;
    }

    public function updateEquipo($idEquipo, $nombre)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("UPDATE equipos
                                    SET nombre = :nombre
                                    WHERE id_equipo = :idEquipo");
        $sentence->bindParam(":nombre", $nombre);
        $sentence->bindParam(":idEquipo", $idEquipo);
        $response = $sentence->execute();
        $conexion = null;
        return $response;
    }

    public function setEscudo($idEquipo, $escudo)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("UPDATE equipos
                                    SET escudo = :escudo
                                    WHERE id_equipo = :idEquipo");
        $sentence->bindParam(":escudo", $escudo);
        $sentence->bindParam(":idEquipo", $idEquipo);
        $response = $sentence->execute();
        $conexion = null;
        return $response;
    }
}
