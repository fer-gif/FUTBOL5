<?php
require_once 'TorneoView.php';
require_once 'libs/smarty/Smarty.class.php';

class EquipoView
{
    private $torneoView;
    private $plantilla;
    public function __construct()
    {
        $this->plantilla = new Smarty();
        $this->torneoView = new TorneoView();
    }

    public function renderHome($equipos)
    {
        //$equipos = new EquiposTest();
        $this->torneoView->cargarHeader($this->plantilla, "HOME");
        $this->plantilla->assign("equipos", $equipos);
        $this->plantilla->display('home.tpl');
    }

    public function renderEquipos($equipos)
    {
        //$equipos = new EquiposTest();
        $this->torneoView->cargarHeader($this->plantilla, "EQUIPOS");
        $this->plantilla->assign("equipos", $equipos);
        $this->plantilla->display('equipos.tpl');
    }

    public function renderFixture($equipos)
    {
        $this->torneoView->cargarHeader($this->plantilla, "FIXTURE");
        $this->plantilla->assign("equipos", $equipos);
        $this->plantilla->display('fixture.tpl');
    }
}
