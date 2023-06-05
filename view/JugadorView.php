<?php
require_once 'libs/smarty/Smarty.class.php';
require_once 'ComponentHelper.php';

class JugadorView
{
    private $plantilla;
    private $component;

    public function __construct()
    {
        $this->plantilla = new Smarty();
        $this->component = new ComponentHelper();
    }
    //Mostraria Jugadores del menu
    public function renderJugadores($jugadores)
    {
        $this->component->cargarEstructuraHtml($this->plantilla, "Jugadores");
        $this->plantilla->assign("jugadores", $jugadores);
        $this->plantilla->display("jugadores.tpl");
    }
    public function renderJugador($jugador, $confirmacion = null)
    {
        $this->component->cargarEstructuraHtml($this->plantilla, "Jugador");
        $this->plantilla->assign("jugador", $jugador);
        if (isset($confirmacion) && $confirmacion)
            $this->plantilla->assign("confirmacion", true);
        $this->plantilla->display("jugador.tpl");
    }
    public function renderEditarJugador($jugador)
    {
        $this->component->cargarEstructuraHtml($this->plantilla, "Editar jugador");
        $this->plantilla->assign("jugador", $jugador);
        $this->plantilla->display("editarjugador.tpl");
    }
    public function renderJugadoresXEquipo($jugadores, $equipo, $confirmacion = null)
    {
        $this->component->cargarEstructuraHtml($this->plantilla, $equipo->nombre);
        if (isset($confirmacion) && $confirmacion)
            $this->plantilla->assign("confirmacion", true);
        $this->plantilla->assign("equipo", $equipo);
        $this->plantilla->assign("jugadores", $jugadores);
        $this->plantilla->display('equipo.tpl');
    }
}
