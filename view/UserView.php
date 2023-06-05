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

    public function cargarGestionAdmin($equipos, $usuarios)
    {
        $this->component->cargarEstructuraHtml($this->plantilla, "Administrador");
        $this->plantilla->assign("usuarios", $usuarios);
        $this->plantilla->assign("equipos", $equipos);
        $this->plantilla->display("gestionadmin.tpl");
    }

    public function renderMiEquipo($equipo, $jugadores)
    {
        $this->component->cargarEstructuraHtml($this->plantilla, "Mi equipo");
        $this->plantilla->assign("equipo", $equipo);
        $this->plantilla->assign("jugadores", $jugadores);
        $this->plantilla->display("miequipo.tpl");
    }
    public function renderUsuario($usuario, $confirmacion = null)
    {
        $this->component->cargarEstructuraHtml($this->plantilla, "Usuario");
        if (isset($confirmacion) && $confirmacion)
            $this->plantilla->assign("confirmacion", true);
        $this->plantilla->assign("usuario", $usuario);
        $this->plantilla->display("usuario.tpl");
    }
    public function renderEditarUsuario($usuario, $equipos)
    {
        $this->component->cargarEstructuraHtml($this->plantilla, "Editar usuario");
        $this->plantilla->assign("usuario", $usuario);
        $this->plantilla->assign("equipos", $equipos);
        $this->plantilla->display("editarusuario.tpl");
    }
    public function renderNoExiste()
    {
        $this->component->cargarEstructuraHtml($this->plantilla, "Página no encontrada");
        $this->plantilla->display("noencontrada.tpl");
    }
}
