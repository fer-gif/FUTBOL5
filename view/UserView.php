<?php
require_once 'libs/smarty/Smarty.class.php';
require_once 'ComponentHelper.php';
class UserView
{
    private $plantilla;
    private $component;
    public function __construct()
    {
        $this->plantilla = new Smarty();
        $this->component = new ComponentHelper();
    }

    public function cargarLogin()
    {
        $this->component->cargarEstructuraHtml($this->plantilla, "Login");
        $this->plantilla->display("login.tpl");
    }

    public function cargarGestionAdmin($mensaje = null)
    {
        $this->component->cargarEstructuraHtml($this->plantilla, "Administrador");
        if (isset($mensaje))
            $this->plantilla->assign("mensaje", $mensaje);
        $this->plantilla->display("gestionadmin.tpl");
    }
}
