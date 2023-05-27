<?php

class EstadisticaPartido
{
    private $equipo;
    private $goles;

    public function __construct($equipo, $goles)
    {
        $this->equipo = $equipo;
        $this->goles = $goles;
    }

    public function getEquipo()
    {
        return $this->equipo;
    }

    public function setEquipo($equipo)
    {
        $this->equipo = $equipo;
    }

    public function getGoles()
    {
        return $this->goles;
    }
    public function setGoles($goles)
    {
        $this->goles = $goles;
    }
}
