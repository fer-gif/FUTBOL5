<?php
require_once 'model/ConexionModel.php';
class Jugador
{
    private $idJugador;
    private $nombre;
    private $apellido;
    private $dni;
    private $posicion;
    private $telefono;
    private $equipo;
    private $connection;

    /**
     * Funcion constructora
     */
    public function __construct($id, $nombre, $apellido, $dni, $pos, $telefono, $equipo)
    {
        $this->idJugador = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dni = $dni;
        $this->posicion = $pos;
        $this->telefono = $telefono;
        $this->equipo = $equipo;
        $this->connection=new Conexion();
    }

    public function getIdJugador($nombre)
    {
        $conexion=$this->connection->getConnection();
        $sentence=$conexion->prepare("SELECT id_jugador FROM jugadores WHERE nombre=?");
        $sentence->execute(array($nombre));
        $sentence->setFetchMode(PDO::FETCH_OBJ);
        $result=$sentence->fetchColumn('id_jugador');
        $this->idJugador=$result;
        $conexion=null;
        return $this->idJugador;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function getNombre()
    {
        $conexion=$this->connection->getConnection();
        $sentence=$conexion->prepare("SELECT nombre FROM jugadores WHERE id_jugador=?");
        $sentence->execute();
        $sentence->setFetchMode(PDO::FETCH_OBJ);
        $result=$sentence->fetchColumn('nombre');
        /*tomo lo que devuelve el $result y lo mando como paramentro a la funcion de esta clase setNombre*/
        $this->setNombre($result);
        $conexion=null;
        return $result;
    }


    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getApellido()
    {   $conexion=$this->connection->getConnection();
        $sentence=$conexion->prepare("SELECT apellido FROM jugadores WHERE nombre=?");
        $sentence->execute();
        $sentence->setFetchMode(PDO::FETCH_OBJ);
        $result=$sentence->fetchColumn('id_jugador');
        $this->setApellido($result);
        $conexion=null;
        return $result;
    }


    public function setDNI($dni)
    {
        $this->dni = $dni;
    }
    public function getDNI()
    {
        $conexion=$this->connection->getConnection();
        $sentence=$conexion->prepare("SELECT dni FROM jugadores WHERE nombre=? OR apellido=? OR id_jugador=?");
        $sentence->execute();
        $sentence->setFetchMode(PDO::FETCH_OBJ);
        $result=$sentence->fetchColumn('dni');
        $this->setDNI($result);
        $conexion=null;
        return $result;
    }

    public function setPosicion($posicion)
    {
        $this->posicion = $posicion;
    }
    public function getPosicion()
    {
        $conexion=$this->connection->getConnection();
        $sentence=$conexion->prepare("SELECT posicion FROM jugadores WHERE nombre=? OR apellido=? OR id_jugador=? OR dni=?");
        $sentence->execute();
        $sentence->setFetchMode(PDO::FETCH_OBJ);
        $result=$sentence->fetchColumn('posicion');
        $this->setPosicion($result);
        $conexion=null;
        return $result;
    }
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }
    public function getTelefono()
    {
        $conexion=$this->connection->getConnection();
        $sentence=$conexion->prepare("SELECT posicion FROM jugadores WHERE nombre=? OR apellido=? OR id_jugador=? OR dni=?");
        $sentence->execute();
        $sentence->setFetchMode(PDO::FETCH_OBJ);
        $result=$sentence->fetchColumn('numero_tel');
        $this->setTelefono($result);
        $conexion=null;
    }

    public function setEquipo($equipo)
    {
        $this->equipo = $equipo;
    }
    public function getEquipo()
    {
        $conexion=$this->connection->getConnection();
        $sentence=$conexion->prepare("SELECT nombre FROM equipo e 
                                    INNER JOIN jugadores j ON e.id_equipo=j.id_equipo
                                    WHERE j.id_jugador=?");
        $sentence->execute();
        $sentence->setFetchMode(PDO::FETCH_OBJ);
        $result=$sentence->fetchColumn('nombre');
        $this->setEquipo($result);
        $conexion=null;
    }
}
