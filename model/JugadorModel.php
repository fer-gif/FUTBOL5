<?php
require_once 'model/Conexion.php';

class JugadorModel
{
    private $connection;
    private $id_jugador;
    private $nombre;
    private $apellido;
    private $dni;
    private $numero_tel;
    private $posicion;
    private $equipo;

    public function __construct($id_jugador,$nombre,$apellido,$dni,$numero_tel,$posicion,$equipo)
    {
        $this->id_jugador=$id_jugador;
        $this->nombre=$nombre;
        $this->apellido=$apellido;
        $this->dni=$dni;
        $this->numero_tel=$numero_tel;
        $this->posicion=$posicion;
        $this->equipo=$equipo;
        $this->connection=new Conexion();
    }


    public function getJugadoresxEquipo($idEquipo)
    {
        $conexion=$this->connection->getConnection();
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
        $conexion=$this->connection->getConnection();
        $sentence = $conexion->prepare("SELECT * FROM jugadores 
                                        WHERE id_jugador=?");
        $sentence->execute(array($id));

        $sentence->setFetchMode(PDO::FETCH_ASSOC);
        $jugador = $sentence->fetchAll();
        
        return $jugador;
    }

    public function addJugador($nombre,$apellido,$dni,$telefono,$posicion,$id_equipo,)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("INSERT INTO jugadores j(j.nombre,j.apellido,j.dni,j.telefono,j.posicion,j.id_equipo) 
                                        INNER JOIN equipos e
                                        ON e.id_equipo=j.id_equipo
                                        VALUES(?,?,?,?,?,?)");
        $sentence->execute(array($nombre,$apellido,$dni,$telefono,$posicion,$id_equipo,));
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

    public function updateJugador($nombre,$apellido,$dni,$telefono,$posicion,$id_equipo)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("UPDATE jugadores
                                    SET nombre = ? OR apellido=? OR dni=? OR telefono=? OR posicion=? OR id_equipo=?
                                    WHERE id_jugador = ?");
        $response = $sentence->execute(array($nombre,$apellido,$dni,$telefono,$posicion,$id_equipo));
        $conexion = null;

        return $response;

    }

    


}
