<?php

class Jugador
{
    private $idJugador;
    private $nombre;
    private $apellido;
    private $edad;
    private $posicion;
    private $goles;
    private $amarillas;
    private $asistencias;
    private $equipo;

    /**
     * Funcion constructora
     */
    public function __constructor($id, $nombre, $apellido, $edad, $pos, $goles, $amarillas, $asistencias, $equipo)
    {
        $this->idJugador = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->edad = $edad;
        $this->posicion = $pos;
        $this->goles = $goles;
        $this->amarillas = $amarillas;
        $this->asistencias = $asistencias;
        $this->equipo = $equipo;
    }
    public function getIdJugador()
    {
        return $this->idJugador;
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
    public function setEdad($edad)
    {
        $this->edad = $edad;
    }
    public function getEdad()
    {
        return $this->edad;
    }
    public function setPosicion($posicion)
    {
        $this->posicion = $posicion;
    }
    public function getPosicion()
    {
        return $this->posicion;
    }
    public function setGoles($goles)
    {
        $this->goles = $goles;
    }
    public function getGoles()
    {
        return $this->goles;
    }
    public function setAmarillas($amarillas)
    {
        $this->amarillas = $amarillas;
    }
    public function getAmarillas()
    {
        return $this->amarillas;
    }
    public function setAsistencias($asistencias)
    {
        $this->asistencias = $asistencias;
    }
    public function getAsistencias()
    {
        return $this->asistencias;
    }
    public function setEquipo($equipo)
    {
        $this->equipo = $equipo;
    }
    public function getEquipo()
    {
        return $this->equipo;
    }

    public function sumarGoles($goles)
    {
        $this->goles = $this->goles + $goles;
    }
    public function sumarAmarrilas($amarillas)
    {
        $this->amarillas = $this->amarillas + $amarillas;
    }
    public function sumarAsistencias($asistencias)
    {
        $this->asistencias = $this->asistencias + $asistencias;
    }
}
