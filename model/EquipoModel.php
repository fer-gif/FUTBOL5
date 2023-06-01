<?php
require_once 'model/Conexion.php';
class EquipoModel
{
    private $nombre;
    private $id_equipo;
    private $connection;

    public function __construct($id_equipo,$nombre)
    {
        $this->connection=new Conexion();
        $this->nombre=$nombre;
        $this->id_equipo=$id_equipo;        
    }

    public function getEquipos()
    {
        $conexion=$this->connection->getConnection();
        $sentence = $conexion->prepare("SELECT * FROM equipos");
        $sentence->execute();
        $sentence->setFetchMode(PDO::FETCH_OBJ);
        $equipos = $sentence->fetchAll();
        $conexion = null;
        return $equipos;
    }
    
    public function getEquipo($idEquipo)
    {
        $conexion=$this->connection->getConnection();
        $sentence = $conexion->prepare("SELECT * FROM equipos
                                        WHERE id_equipo=?");
        $sentence->execute(array($idEquipo));

        $sentence->setFetchMode(PDO::FETCH_ASSOC);
        $equipo = $sentence->fetchAll();
        
        return $equipo;
    }

    public function getEquipoByName($idEquipo)
    {
        $conexion=$this->connection->getConnection();
        $sentence = $conexion->prepare("SELECT nombre FROM equipos
                                        WHERE id_equipo=?");
        $sentence->execute(array($idEquipo));

        $sentence->setFetchMode(PDO::FETCH_ASSOC);
        $nombreEquipo = $sentence->fetchAll();
        
        return $this->nombre=$nombreEquipo;

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

    public function updateEquipo($nombre)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("UPDATE equipos
                                    SET nombre = ?
                                    WHERE id_equipo = ?");
        $response = $sentence->execute(array($nombre));
        $conexion = null;

        return $response;
    }

}
