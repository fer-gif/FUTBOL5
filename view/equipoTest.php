<?php

require_once 'model/Equipo.php';
require_once 'model/Jugador.php';

class EquipoTest
{

    private $equipo;

    public function __construct()
    {
        $this->equipo = new Equipo(1, "River", [], 0, 0, 0, 0, 0, 0, 0);
        $jug1 = new Jugador(1, "Marcelo", "Lotartaro", 30, "POR", 0, 0, 0, null);
        $jug2 = new Jugador(2, "Cristian", "Ledesma", 27, "DEF", 0, 0, 0, $this->equipo);
        $jug3 = new Jugador(3, "Ceferino", "Diaz", 23, "MED", 0, 0, 0, $this->equipo);
        $jug4 = new Jugador(4, "Hernan", "Crespo", 30, "DC", 0, 0, 0, $this->equipo);
        $jug5 = new Jugador(5, "Pascual", "Rambert", 27, "DC", 0, 0, 0, $this->equipo);
        $arrAux = array();
        array_push($arrAux, $jug1);
        array_push($arrAux, $jug2);
        array_push($arrAux, $jug3);
        array_push($arrAux, $jug4);
        array_push($arrAux, $jug5);

        $this->equipo->setJugadores($arrAux);
    }

    public function getEquipo()
    {
        return $this->equipo;
    }
}
