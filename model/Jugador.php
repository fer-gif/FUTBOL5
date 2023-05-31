<?php
require_once 'model/ConexionModel.php';
class Jugador
{
    private $id_jugador;
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
    public function __construct($id_jugador, $nombre, $apellido, $dni, $pos, $telefono, $equipo)
    {
        $this->id_jugador = $id_jugador;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dni = $dni;
        $this->posicion = $pos;
        $this->telefono = $telefono;
        $this->equipo = $equipo;
        $this->connection = new Conexion();
    }

    public function getIdJugador()
    {
        return $this->id_jugador;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function getNombre()
    {
        return $this->nombre;
    }


    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setDNI($dni)
    {
        $this->dni = $dni;
    }
    public function getDNI()
    {
        return $this->dni;
    }

    public function setPosicion($posicion)
    {
        $this->posicion = $posicion;
    }
    public function getPosicion()
    {
        return $this->posicion;
    }
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }
    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setEquipo($equipo)
    {
        $this->equipo = $equipo;
    }
    public function getEquipo()
    {
        return $this->equipo;
    }
}
