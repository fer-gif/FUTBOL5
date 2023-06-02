<?php
require_once 'libs/smarty/Smarty.class.php';
require_once '../templates';
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
        $this->plantilla->display('templates/home.tpl');

    }

    public function renderEquipos($equipos)
    {
        $this->plantilla->assign("equipos",$equipos);
        $this->plantilla->display('templates/equipos.tpl');
    }
    
    /* va en jugadorVIEW*/
    public function renderEquipo($jugadores)
    {
        $this->plantilla->assign("jugadores",$jugadores);
        $this->plantilla->display('templates/equipo.tpl');
    } 

    public function renderFixture($equipos)
    {
        $this->plantilla->assign("equipos",$equipos);
        $this->plantilla->assign('templates/fixture.tpl');
    }

    
}

?>