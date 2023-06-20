<?php
require_once 'model/Conexion.php';
class PartidoModel
{
    private $connection;

    public function __construct()
    {
        $this->connection = new Conexion();
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
        //return $partidos['cant'];
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




    public function getPuntos($id_equipo)
    {
        $conexion = $this->connection->getConnection();
        $consultaGanados = $conexion->prepare("SELECT COUNT(*) 
        FROM partidos
        WHERE (id_equipo1 = :idEquipo AND goles_equipo1 > goles_equipo2)
        OR (id_equipo2 = :idEquipo AND goles_equipo2 > goles_equipo1)");
        $consultaGanados->bindParam(':idEquipo', $id_equipo);
        $consultaGanados->execute();
        $partidosGanados = $consultaGanados->fetch(PDO::FETCH_ASSOC);

        $consultaEmpatados = $conexion->prepare("SELECT COUNT(*) 
        FROM partidos
        WHERE (id_equipo1 = :idEquipo AND goles_equipo1 = goles_equipo2)
        OR (id_equipo2 = :idEquipo AND goles_equipo2 = goles_equipo1)");
        $consultaEmpatados->bindParam(':idEquipo1', $id_equipo);
        $consultaEmpatados->execute();
        $partidosEmpatados = $consultaEmpatados->fetch(PDO::FETCH_ASSOC);

        $puntos = ($partidosGanados * 3) + $partidosEmpatados;

        return $puntos;
    }

    public function getGolesDeEqipo($id_equipo)
    {
        $conexion = $this->connection->getConnection();
        $response = $conexion->prepare("SELECT SUM(goles_equipo1) AS goles_favor
        FROM partidos
        WHERE id_equipo1 = :idEquipo
        UNION ALL
        SELECT SUM(goles_equipo2) 
        FROM partidos
        WHERE id_equipo2 = :idEquipo");

        $response->bindParam(':idEquipo', $id_equipo);
        $response->execute();
        $golesConvertidos = $response->fetch();
        $conexion = null;
        if ($golesConvertidos['goles_favor'])
            return $golesConvertidos['goles_favor'];
        else
            return 0;
    }

    public function getGolesRecibidos($id_equipo)
    {
        $conexion = $this->connection->getConnection();
        $response = $conexion->prepare("SELECT SUM(goles_equipo2) AS goles_recibidos
                            FROM partidos
                            WHERE id_equipo1 = :idEquipo
                            UNION ALL
                            SELECT SUM(goles_equipo1) AS goles_recibidos2
                            FROM partidos
                            WHERE id_equipo2 = :idEquipo");

        $response->bindParam(':idEquipo', $id_equipo);
        $response->execute();
        $golesRecibidos = $response->fetch();
        $conexion = null;
        if ($golesRecibidos['goles_recibidos'])
            return $golesRecibidos['goles_recibidos'] + $golesRecibidos['goles_recibidos2'];
        else
            return 0;
    }

    public function getPartidoPerdidos($id_equipo)
    {
        $conexion = $this->connection->getConnection();
        $response = $conexion->prepare("SELECT COUNT(*) AS partido_perdido
                        FROM partidos
                        WHERE (id_equipo1 = :idEquipo AND goles_equipo1 < goles_equipo2)
                         OR (id_equipo2 = :idEquipo AND goles_equipo2 < goles_equipo1)");

        $response->bindParam(':idEquipo', $id_equipo);
        $response->execute();

        $partidosPerdidos = $response->fetch();
        $conexion = null;

        return $partidosPerdidos['partido_perdido'];
    }
    public function getPartidoJugados($id_equipo)
    {
        $conexion = $this->connection->getConnection();
        $response = $conexion->prepare("SELECT COUNT(*) 
                            FROM partidos
                            WHERE id_equipo1 = :idEquipo OR id_equipo2 = :idEquipo");
        $response->bindParam(':idEquipo', $id_equipo);
        $response->execute();

        $partidosJugados = $response->fetch(PDO::FETCH_ASSOC);
        $conexion = null;

        return $partidosJugados;
    }


    public function getPartidoGanado($id_equipo)
    {
        $conexion = $this->connection->getConnection();
        $response = $conexion->prepare("SELECT COUNT(*) AS partido_ganado
                        FROM partidos
                        WHERE (id_equipo1 = :idEquipo AND goles_equipo1 > goles_equipo2)
                         OR (id_equipo2 = :idEquipo AND goles_equipo2 > goles_equipo1)");
        $response->bindParam(':idEquipo', $id_equipo);
        $response->execute();

        $partidosGanados = $response->fetch();
        $conexion = null;

        return $partidosGanados['partido_ganado'];
    }

    public function getPartidoEmpatado($id_equipo)
    {
        $conexion = $this->connection->getConnection();
        $response = $conexion->prepare("SELECT COUNT(*) AS partido_empatado
                        FROM partidos
                        WHERE (id_equipo1 = :idEquipo AND goles_equipo1 = goles_equipo2)");
        $response->bindParam(':idEquipo', $id_equipo);
        $response->execute();

        $partidosEmpatados = $response->fetch();
        $conexion = null;

        return $partidosEmpatados['partido_empatado'];
    }
}
