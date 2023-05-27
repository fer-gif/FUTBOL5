<?php

require_once 'TorneoView.php';
require_once 'libs/smarty/Smarty.class.php';

class UserView
{
    private $torneoView;
    private $plantilla;
    public function __construct()
    {
        $this->plantilla = new Smarty();
        $this->torneoView = new TorneoView();
    }

    public function renderMiEquipo()
    {
        $this->torneoView->cargarHeader($this->plantilla, "MI EQUIPO", true, false);
        $this->plantilla->display('miequipo.tpl');
    }
    public function renderIngresoLogin()
    {
        $this->torneoView->cargarHeader($this->plantilla, "LOGIN", false, false);
        $this->plantilla->display('login.tpl');
    }
}
