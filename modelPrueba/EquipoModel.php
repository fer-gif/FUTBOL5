<?php
require_once 'model/conexion.php';
require_once 'JugadorModel.php';
require_once 'model/Equipo.php';
require_once 'model/Jugador.php';

class EquipoModel
{

    private $connection;

    public function __construct()
    {
        $this->connection = new Conexion();
    }

    public function getEquipos()
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("select * from equipos ");
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
    public function addEquipo($nombre)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("INSERT INTO equipos(Nombre) VALUES(?)");
        $sentence->execute(array($nombre));
        $lastId = $conexion->lastInsertId();
        $conexion = null;
        return $lastId;
    }
    public function registrarPartido($equipo1, $equipo2, $golesEquipo1, $golesEquipo2)
    {
        $conexion = $this->connection->getConnection();
        try {
            $sentence = $conexion->prepare("INSERT INTO fixture(id_equipo1,id_equipo2,goles_equipo1,goles_equipo2) VALUES(?,?,?,?)");
            $sentence->execute(array($equipo1, $equipo2, $golesEquipo1, $golesEquipo2));
            $lastId = $conexion->lastInsertId();
        } catch (PDOException $e) {
            $lastId = -1;
        }
        $conexion = null;
        return $lastId;
    }

    public function getEquipo($id)
    {   /*DEBERIAMOS TOMAR LOS JUGADORES Y  USAR INNEER JOIN PARA EL EQUIPO?????*/
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("SELECT e.id_equipo, e.nombre AS nombre_equipo,j.id_jugador, j.nombre AS nombre_jugador, j.apellido, j.dni, j.posicion, j.numero_tel 
                                        FROM `equipos` e 
                                        INNER JOIN jugadores j ON j.id_equipo = e.id_equipo 
                                        WHERE e.id_equipo =?");
        $sentence->execute(array($id));

        $sentence->setFetchMode(PDO::FETCH_OBJ);
        $result = $sentence->fetchAll();

        $equipo = new Equipo($result[0]->id_equipo, $result[0]->nombre_equipo);
        $jugadores = [];
        foreach ($result as $item) {
            $jugador = new Jugador($item->id_jugador, $item->nombre_jugador, $item->apellido, $item->dni, $item->posicion, $item->numero_tel, $equipo);
            array_push($jugadores, $jugador);
        }
        $equipo->setJugadores($jugadores);

        $conexion = null;
        return $equipo;
    }
}
/* 
"SELECT p.id_partido, p.goles_equipo1, p.goles_equipo2,
               e1.id_equipo AS id_equipo1, e1.nombre AS nombre_equipo1,
               e2.id_equipo AS id_equipo2, e2.nombre AS nombre_equipo2
        FROM partidos p
        INNER JOIN equipos e1 ON p.id_equipo1 = e1.id_equipo
        INNER JOIN equipos e2 ON p.id_equipo2 = e2.id_equipo"
        */