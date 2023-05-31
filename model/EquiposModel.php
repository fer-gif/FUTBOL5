<?php
require_once 'model/ConexionModel.php';

class EquiposModel{
 
    private $connection;

    public function __construct()
    {
        $this->connection=new Conexion();
    }

    public function getTorneo()
    {
        $c = $this->connection->getConnection();
        $sentence = $c->prepare("select * from equipos ORDER BY puntos ASC");
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

    public function deleteEquipo($id)
    {
        $c = $this->connection->getConnection();
        $sentence = $c->prepare("DELETE FROM equipos WHERE id_equipo=?");
        $response = $sentence->execute(array($id));
        $c = null;
    }

    public function addEquipo($nombre)
    {
        $c = $this->connection->getConnection();
        $sentence = $c->prepare("INSERT INTO equipos(nombre) VALUES(?)");
        $sentence->execute(array($nombre));
        $lastId = $c->lastInsertId();
        $c = null;
        return $lastId;
    }


}
?>