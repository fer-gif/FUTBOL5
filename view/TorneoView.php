<?php
require_once 'libs/smarty/Smarty.class.php';
require_once 'ComponentHelper.php';

class TorneoView
{
    private $plantilla;
    private $component;
    public function __construct()
    {
        $this->plantilla = new Smarty();
        $this->component = new ComponentHelper();
    }

    public function cargarHome($estadisticasEquipos)
    {
        $this->component->cargarEstructuraHtml($this->plantilla, "Home");
        $this->plantilla->assign("equipos", $estadisticasEquipos);
        $this->plantilla->display("home.tpl");
    }
    public function renderErrorServidor()
    {
        $this->component->cargarEstructuraHtml($this->plantilla, "Error");
        $this->plantilla->display("errorenservidor.tpl");
    }
}
