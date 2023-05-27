<?php

class Partido
{
    private $id_partido;
    private $equipo1;
    private $equipo2;


    public function __construct($equipo1, $equipo2)
    {
        $this->equipo1 = $equipo1;
        $this->equipo2 = $equipo2;
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
}
