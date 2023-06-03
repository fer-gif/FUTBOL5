<?php
require_once 'libs/smarty/Smarty.class.php';
require_once 'ComponentHelper.php';
class EquipoView
{
    private $plantilla;
    private $component;

    public function __construct()
    {
        $this->plantilla = new Smarty();
        $this->component = new ComponentHelper();
    }

    public function renderHome($equipos)
    {
        $this->component->cargarEstructuraHtml($this->plantilla, "Home");
        $this->plantilla->assign("equipos", $equipos);
        $this->plantilla->display("home.tpl");
    }

    public function renderEquipos($equipos)
    {
        $this->plantilla->assign("equipos", $equipos);
        $this->plantilla->display('templates/equipos.tpl');
    }

    /* va en jugadorVIEW*/
    public function renderEquipo($jugadores)
    {
        $this->plantilla->assign("jugadores", $jugadores);
        $this->plantilla->display('templates/equipo.tpl');
    }
}
