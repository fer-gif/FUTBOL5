<?php
require_once 'model/ConexionModel.php';

class JugadoresModel{
    private $connection;

    public function __construct(){
        $this->connection=new Conexion();
    }

    public function addJugador($nombre, $apellido, $dni, $pos, $tel, $equipo)
    {
        $c = $this->connection->getConnection();
        $sentence = $c->prepare("INSERT INTO equipos(nombre,apellido,dni,posicion,numero_tel,id_equipo) VALUES(?,?,?,?,?,?)");
        $sentence->execute(array($nombre, $apellido, $dni, $pos, $tel, $equipo));
        $lastId = $c->lastInsertId();
        $c = null;
        return $lastId;
    }

    
    public function deleteJugador($id)
    {
        $c = $this->connection->getConnection();
        $sentence = $c->prepare("DELETE FROM jugadores WHERE id_jugador=?");
        $response = $sentence->execute(array($id));
        $c = null;
    }

    public function editJugador()
    {   
        $c = $this->connection->getConnection();
        $sentence = $c->prepare("UPDATE jugadores
                                SET nombre = 'NuevoNombre', apellido = 'NuevoApellido', dni = 'NuevoDNI', posicion = 'NuevaPosicion', telefono = 'NuevoTelefono', id_equipo = 'NuevoIDEquipo'
                                WHERE id_jugador = ?");
        $response = $sentence->execute(array());
        $c = null;
        
    }
}

?>