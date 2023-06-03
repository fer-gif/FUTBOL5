<?php
require_once 'model/Conexion.php';

class JugadorModel
{
    private $connection;

    public function __construct()
    {
        $this->connection = new Conexion();
    }


    public function getJugadoresxEquipo($idEquipo)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("SELECT * FROM jugadores j 
                                        INNER JOIN equipos e
                                        ON j.id_equipo=e.id_equipo
                                        WHERE e.id_equipo=?");
        $sentence->execute(array($idEquipo));

        $sentence->setFetchMode(PDO::FETCH_ASSOC);
        $jugadores = $sentence->fetchAll();

        return $jugadores;
    }

    public function getJugador($id)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("SELECT * FROM jugadores 
                                        WHERE id_jugador=?");
        $sentence->execute(array($id));

        $sentence->setFetchMode(PDO::FETCH_OBJ);
        $jugador = $sentence->fetchAll();

        return $jugador;
    }

    public function addJugador($nombre, $apellido, $dni, $telefono, $posicion, $id_equipo,)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("INSERT INTO jugadores j(j.nombre,j.apellido,j.dni,j.telefono,j.posicion,j.id_equipo) 
                                        INNER JOIN equipos e
                                        ON e.id_equipo=j.id_equipo
                                        VALUES(?,?,?,?,?,?)");
        $sentence->execute(array($nombre, $apellido, $dni, $telefono, $posicion, $id_equipo,));
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

    public function updateJugador($nombre, $apellido, $dni, $telefono, $posicion, $id_equipo)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("UPDATE jugadores
                                    SET nombre = ? , apellido=? , dni=? , telefono=? , posicion=? , id_equipo=?
                                    WHERE id_jugador = ?");
        $response = $sentence->execute(array($nombre, $apellido, $dni, $telefono, $posicion, $id_equipo));
        $conexion = null;

        return $response;
    }
    /*
    public function getNombre($id_jugador)
    {
        $conexion=$this->connection->getConnection();
        $sentence = $conexion->prepare("SELECT nombre FROM jugadores 
                                        WHERE id_jugador=?");
        $sentence->execute(array($id_jugador));

        $sentence->setFetchMode(PDO::FETCH_ASSOC);
        $jugadorNombre = $sentence->fetchAll();
        
        return $jugadorNombre;
    }

    public function getApellido($id_jugador)
    {
        $conexion=$this->connection->getConnection();
        $sentence = $conexion->prepare("SELECT apellido FROM jugadores 
                                        WHERE id_jugador=?");
        $sentence->execute(array($id_jugador));

        $sentence->setFetchMode(PDO::FETCH_ASSOC);
        $jugadorApellido = $sentence->fetchAll();
        
        return $jugadorApellido;
    }

    public function getPosicion($id_jugador){
        $conexion=$this->connection->getConnection();
        $sentence = $conexion->prepare("SELECT posicion FROM jugadores 
                                        WHERE id_jugador=?");
        $sentence->execute(array($id_jugador));

        $sentence->setFetchMode(PDO::FETCH_ASSOC);
        $jugadorPosicion = $sentence->fetchAll();
        
        return $jugadorPosicion;
    }

    public function getDNI($id_jugador)
    {
        $conexion=$this->connection->getConnection();
        $sentence = $conexion->prepare("SELECT dni FROM jugadores 
                                        WHERE id_jugador=?");
        $sentence->execute(array($id_jugador));

        $sentence->setFetchMode(PDO::FETCH_ASSOC);
        $jugadorDNI = $sentence->fetchAll();
        
        return $jugadorDNI;
    }


    public function getTelefono($id_jugador)
    {
        $conexion=$this->connection->getConnection();
        $sentence = $conexion->prepare("SELECT telefono FROM jugadores 
                                        WHERE id_jugador=?");
        $sentence->execute(array($id_jugador));

        $sentence->setFetchMode(PDO::FETCH_ASSOC);
        $jugadorTelefono = $sentence->fetchAll();
        
        return $jugadorTelefono;
    }
*/
}
