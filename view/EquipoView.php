<?php
require_once 'libs/smarty/Smarty.class.php';
class EquipoView
{
    private $plantilla;
    
    
    public function __construct()
    {
        $this->plantilla=new Smarty();

    }

    public function renderHome($equipos)
    {
        $this->plantilla->assign("equipos",$equipos);

    }

    public function renderEquipos()
    {}

    public function renderFixture()
    {}
}

?>