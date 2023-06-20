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

    public function cargarHome($estadisticasEquipos)
    {
        $this->component->cargarEstructuraHtml($this->plantilla, "Home");
        $this->plantilla->assign("equipos", $estadisticasEquipos);
        $this->plantilla->display("home.tpl");
    }

    /*POSIBLE MODIFICACION*/
    public function showFixture($partidos, $idPartido = null, $confirmacion = null)
    {
        $this->component->cargarEstructuraHtml($this->plantilla, "Fixture");
        if (isset($confirmacion) && $confirmacion) {
            $this->plantilla->assign("confirmacion", true);
            $this->plantilla->assign("idPartido", $idPartido);
        }
        $this->plantilla->assign("partidos", $partidos);
        $this->plantilla->display("fixture.tpl");
    }

    public function renderEditarPartido($partido)
    {
        $this->component->cargarEstructuraHtml($this->plantilla, "Editar partido");
        $this->plantilla->assign("partido", $partido);
        $this->plantilla->display("editarpartido.tpl");
    }
}
