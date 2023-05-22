<?php

require_once 'model/Equipo.php';
class EquiposTest
{

    private $equipos;
    public function __construct()
    {
        $this->equipos = [];
        $equipo1 = new Equipo(1, "River", null, 0, 0, 0, 0, 0, 0, 0);
        array_push($this->equipos, $equipo1);

        $equipo2 = new Equipo(2, "Boca", null, 0, 0, 0, 0, 0, 0, 0);
        array_push($this->equipos, $equipo2);

        $equipo3 = new Equipo(3, "Sal Lorenzo", null, 0, 0, 0, 0, 0, 0, 0);
        array_push($this->equipos, $equipo3);

        $equipo4 = new Equipo(4, "Independiente", null, 0, 0, 0, 0, 0, 0, 0);
        array_push($this->equipos, $equipo4);

        $equipo5 = new Equipo(5, "Velez", null, 0, 0, 0, 0, 0, 0, 0);
        array_push($this->equipos, $equipo5);

        $equipo6 = new Equipo(6, "Huracan", null, 0, 0, 0, 0, 0, 0, 0);
        array_push($this->equipos, $equipo6);

        $equipo7 = new Equipo(7, "Colon", null, 0, 0, 0, 0, 0, 0, 0);
        array_push($this->equipos, $equipo7);

        $equipo8 = new Equipo(8, "Talleres", null, 0, 0, 0, 0, 0, 0, 0);
        array_push($this->equipos, $equipo8);

        $equipo9 = new Equipo(9, "Arsenal", null, 0, 0, 0, 0, 0, 0, 0);
        array_push($this->equipos, $equipo9);

        $equipo10 = new Equipo(10, "Olimpo", null, 0, 0, 0, 0, 0, 0, 0);
        array_push($this->equipos, $equipo10);
    }

    public function getEquipos()
    {
        return $this->equipos;
    }
}
