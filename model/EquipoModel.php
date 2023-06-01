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
        $sentence->setFetchMode(PDO::FETCH_ASSOC);
        $equipos = $sentence->fetchAll();
        $conexion = null;
        return $equipos;
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
    }

    public function updateEquipo($idEquipo)
    {

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
    




    public function 

}
