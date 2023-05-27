<?php
require_once 'TorneoView.php';
require_once 'libs/smarty/Smarty.class.php';


class JugadorView
{
    private $plantilla;
    private $torneoView;

    public function __construct()
    {
        $this->plantilla = new Smarty();
        $this->torneoView = new TorneoView();
    }

    /**
     * Muestra una lista de jugadores que pertenecen al mmismo equipo
     */
    public function renderJugadoresxEquipo($equipo)
    {
        //$equipos = new EquipoTest();
        //$equipo = $equipos->getEquipo();
        $this->torneoView->cargarHeader($this->plantilla, $equipo->getNombre(), true, true);
        $this->plantilla->assign("nombreEquipo", $equipo->getNombre());
        $this->plantilla->assign("jugadores", $equipo->getJugadores());
        $this->plantilla->display('equipo.tpl');
    }

    public function renderEditarJugador($jugador)
    {
        $equipos = new EquipoTest();
        $equipo = $equipos->getEquipo();
        $jug = $equipo->getJugadores()[0];
        $this->torneoView->cargarHeader($this->plantilla, "EDITAR JUGADOR", true, true);
        $this->plantilla->assign("jugador", $jug);
        $this->plantilla->display('editarjugador.tpl');
    }
}
