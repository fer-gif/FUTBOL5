<?php
require_once 'model/Conexion.php';
class PartidoModel
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

    public function getPartidos()
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("SELECT p.*, e1.nombre AS nom_equipo1, e1.escudo AS escudo1,
                                         e2.nombre AS nom_equipo2, e2.escudo AS escudo2
                                         FROM partidos p
                                         INNER JOIN equipos e1 ON e1.id_equipo = p.id_equipo1
                                         INNER JOIN equipos e2 ON e2.id_equipo = p.id_equipo2");
        $sentence->execute();
        $partidos = $sentence->fetchAll((PDO::FETCH_ASSOC));

        return $partidos;
    }

    public function getPartido($idPartido)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("SELECT p.id_partido,p.goles_equipo1, p.goles_equipo2,
                                        p.fecha, e1.nombre AS nom_equipo1, e2.nombre AS nom_equipo2
                                         FROM partidos p
                                         INNER JOIN equipos e1 ON e1.id_equipo = p.id_equipo1
                                         INNER JOIN equipos e2 ON e2.id_equipo = p.id_equipo2
                                         WHERE id_partido=?");
        $sentence->execute(array($idPartido));
        $partido = $sentence->fetch(PDO::FETCH_ASSOC);
        return $partido;
    }

    public function getPartidosXEquipo($idEquipo)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("SELECT * FROM partidos 
                                        WHERE id_equipo1 = :idEquipo OR id_equipo2 = :idEquipo");
        $sentence->bindParam(":idEquipo", $idEquipo);
        $sentence->execute();
        $result = $sentence->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getCruceDePartido($id_equipo1, $id_equipo2)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("SELECT *
                                    FROM partidos
                                    WHERE ((id_equipo1 = :idEquipo1 AND id_equipo2 = :idEquipo2)
                                    OR (id_equipo1 = :idEquipo2 AND id_equipo2 = :idEquipo1))");
        $sentence->bindParam(":idEquipo1", $id_equipo1);
        $sentence->bindParam(":idEquipo2", $id_equipo2);

        $sentence->execute();

        $partidos = $sentence->fetchAll();
        if ($partidos)
            return true;
        else
            return false;
    }


    public function addPartido($id_equipo1, $id_equipo2, $golesEquipo1, $golesEquipo2, $fecha)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("INSERT INTO partidos(id_equipo1,id_equipo2,goles_equipo1,goles_equipo2,fecha) VALUES(?,?,?,?,?)");
        $sentence->execute(array($id_equipo1, $id_equipo2, $golesEquipo1, $golesEquipo2, $fecha));
        $lastId = $conexion->lastInsertId();
        $conexion = null;
        return $lastId;
    }

    public function deletePartido($id_partido)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("DELETE FROM partidos WHERE id_partido=?");
        $response = $sentence->execute(array($id_partido));
        $conexion = null;

        return $response;
    }

    public function updatePartido($id_partido, $golesEquipo1, $golesEquipo2, $fecha)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("UPDATE partidos
                                    SET goles_equipo1=?,goles_equipo2=?,fecha=?
                                    WHERE id_partido = ?");
        $response = $sentence->execute(array($golesEquipo1, $golesEquipo2, $fecha, $id_partido));
        $conexion = null;

        return $response;
    }
}
