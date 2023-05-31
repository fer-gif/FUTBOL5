<?php

require_once 'model/ConexionModel.php';
require_once 'model/Partido.php';
require_once 'model/Equipo.php';

class PartidoModel
{
    private $connection;

    public function __construct()
    {
        $this->connection = new Conexion();
    }

    public function getPartidosxEquipo($idEquipo)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("SELECT p.id_partido, e1.id_equipo AS id_equipo1, e1.nombre AS nombre_equipo1, p.goles_equipo1,  
                                               e2.id_equipo AS id_equipo2, e2.nombre AS nombre_equipo2, p.goles_equipo2, p.fecha
                                               FROM fixture p 
                                               INNER JOIN equipos e1 ON p.id_equipo1 = e1.id_equipo 
                                               INNER JOIN equipos e2 ON p.id_equipo2 = e2.id_equipo
                                               WHERE p.id_equipo1 = :idEquipo OR p.id_equipo2 = :idEquipo");

        $sentence->bindParam(":idEquipo", $idEquipo);
        $sentence->execute();
        $sentence->setFetchMode(PDO::FETCH_OBJ);
        $result = $sentence->fetchAll();
        $partidos = [];
        foreach ($result as $partido) {
            $equipo1 = new Equipo($partido->id_equipo1, $partido->nombre_equipo1);
            $equipo2 = new Equipo($partido->id_equipo2, $partido->nombre_equipo2);
            $part = new Partido($partido->id_partido, $equipo1, $equipo2, $partido->goles_equipo1, $partido->goles_equipo2, $partido->fecha);
            array_push($partidos, $part);
        }


        $conexion = null;
        return $partidos;
    }
    /**
     * Recibe 2 equipos, con sus respectivos goles en una fecha
     */
    public function registrarPartido($equipo1, $equipo2, $golesEquipo1, $golesEquipo2, $fecha)
    {
        $conexion = $this->connection->getConnection();
        try {
            $sentence = $conexion->prepare("INSERT INTO fixture(id_equipo1,id_equipo2,goles_equipo1,goles_equipo2,fecha) VALUES(?,?,?,?,?)");
            $sentence->execute(array($equipo1, $equipo2, $golesEquipo1, $golesEquipo2, $fecha));
            $lastId = $conexion->lastInsertId();
        } catch (PDOException $e) {
            $lastId = 0;
        }
        $conexion = null;
        return $lastId;
    }
}
