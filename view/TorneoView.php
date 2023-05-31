<?php

require_once 'libs/smarty/Smarty.class.php';
require_once 'model/AuthHelper.php';
require_once 'model/SesionHelper.php';

class TorneoView
{
    private $plantilla;
    private $usuario;
    public function __construct()
    {
        $this->plantilla = new Smarty();
        $this->usuario = new AuthHelper();
    }
    public function cargarHeader(&$plantilla, $titulo)
    {
        $plantilla->assign("titulo", $titulo);
        $plantilla->assign("base", BASE_URL);
        //$plantilla->assign("user", $this->usuario->esCapitan());
        $plantilla->assign("user", SesionHelper::esCapitan());

        //$admin = $this->usuario->esAdmin();
        //$plantilla->assign("admin", $admin);
        $plantilla->assign("admin", SesionHelper::esAdmin());
    }

    public function renderMiEquipo()
    {
        $this->cargarHeader($this->plantilla, "MI EQUIPO");
        $this->plantilla->display('miequipo.tpl');
    }
    public function renderIngresoLogin()
    {
        $this->cargarHeader($this->plantilla, "LOGIN");
        $this->plantilla->display('login.tpl');
    }
    public function renderAdmin($equipos)
    {
        $this->cargarHeader($this->plantilla, "ADMINISTRADOR");
        $this->plantilla->assign("equipos", $equipos);
        $this->plantilla->display('gestionadmin.tpl');
    }
}
