<?php
require_once 'libs/smarty/Smarty.class.php';
require_once 'ComponentHelper.php';

class PartidoView
{
    private $plantilla;
    private $component;

    public function __construct()
    {
        $this->plantilla = new Smarty();
        $this->component = new ComponentHelper();
    }

    public function renderFixture($equipos)
    {
        $this->plantilla->assign("equipos", $equipos);
        $this->plantilla->assign('templates/fixture.tpl');
    }
    public function renderHome($equipos)
    {
        $this->component->cargarEstructuraHtml($this->plantilla, "Home");
        $this->plantilla->assign("equipos", $equipos);
        $this->plantilla->display("home.tpl");
    }
}
