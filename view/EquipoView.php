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



    public function renderEquipos($equipos)
    {
        $this->component->cargarEstructuraHtml($this->plantilla, "Equipos");
        $this->plantilla->assign("equipos", $equipos);
        $this->plantilla->display('equipos.tpl');
    }

    public function renderEditarEquipo($equipo)
    {
        $this->component->cargarEstructuraHtml($this->plantilla, "Editar equipo");
        $this->plantilla->assign("equipo", $equipo);
        $this->plantilla->display('editarequipo.tpl');
    }
}
