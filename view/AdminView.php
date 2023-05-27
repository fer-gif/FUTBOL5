<?php
require_once 'TorneoView.php';
require_once 'libs/smarty/Smarty.class.php';

class AdminView
{
    private $torneoView;
    private $plantilla;
    public function __construct()
    {
        $this->plantilla = new Smarty();
        $this->torneoView = new TorneoView();
    }

    public function renderAdmin($equipos)
    {
        $this->torneoView->cargarHeader($this->plantilla, "ADMINISTRADOR", false, true);
        $this->plantilla->assign("equipos", $equipos);
        $this->plantilla->display('gestionadmin.tpl');
    }
}
