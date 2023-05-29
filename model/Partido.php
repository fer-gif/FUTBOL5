<?php

class Partido
{
    private $id_partido;
    private $equipo1;
    private $equipo2;
    private $goles_equipo1;
    private $goles_equipo2;
    private $fecha;

    public function __construct($id, $equipo1, $equipo2, $golesE1, $golesE2, $fecha)
    {
        $this->id_partido = $id;
        $this->equipo1 = $equipo1;
        $this->equipo2 = $equipo2;
        $this->goles_equipo1 = $golesE1;
        $this->goles_equipo2 = $golesE2;
        $this->fecha = $fecha;
    }

    public function getIdPartido()
    {
        return $this->id_partido;
    }

    public function getEquipo1()
    {
        return $this->equipo1;
    }

    public function getEquipo2()
    {
        return $this->equipo2;
    }
    public function setEquipo1($equipo1)
    {
        $this->equipo2 = $equipo1;
    }
    public function setEquipo2($equipo2)
    {
        $this->equipo2 = $equipo2;
    }
    public function getGolesEquipo1()
    {
        return $this->goles_equipo1;
    }
    public function setGolesEquipo1($goles)
    {
        $this->goles_equipo1 = $goles;
    }
    public function getGolesEquipo2()
    {
        return $this->goles_equipo2;
    }
    public function setGolesEquipo2($goles)
    {
        $this->goles_equipo2 = $goles;
    }
    public function getFecha()
    {
        return $this->fecha;
    }
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
}
