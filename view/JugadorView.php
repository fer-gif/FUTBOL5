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
        $this->torneoView->cargarHeader($this->plantilla, $equipo->getNombre());
        $this->plantilla->assign("nombreEquipo", $equipo->getNombre());
        $this->plantilla->assign("jugadores", $equipo->getJugadores());
        $this->plantilla->display('equipo.tpl');
    }

    public function renderEditarJugador($jugador)
    {
        $this->torneoView->cargarHeader($this->plantilla, "EDITAR JUGADOR");
        $this->plantilla->assign("jugador", $jugador);
        $this->plantilla->display('editarjugador.tpl');
    }
}
