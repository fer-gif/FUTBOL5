<?php


require_once 'libs/smarty/Smarty.class.php';
require_once 'equiposTest.php';
require_once 'equipoTest.php';

class TorneoView
{
    private $plantilla;
    public function __construct()
    {
        $this->plantilla = new Smarty();
    }
    private function cargarHeader($titulo, $user, $admin)
    {
        $this->plantilla->assign("titulo", $titulo);
        $this->plantilla->assign("base", BASE_URL);
        $this->plantilla->assign("user", $user);
        $this->plantilla->assign("admin", $admin);
    }
    public function renderHome($equipos)
    {
        //$equipos = new EquiposTest();
        $this->cargarHeader("HOME", true, true);
        $this->plantilla->assign("equipos", $equipos);
        $this->plantilla->display('home.tpl');
    }

    public function renderEquipos($equipos)
    {
        //$equipos = new EquiposTest();
        $this->cargarHeader("EQUIPOS", true, true);
        $this->plantilla->assign("equipos", $equipos);
        $this->plantilla->display('equipos.tpl');
    }
    public function renderEquipo($idEquipo)
    {
        $equipos = new EquipoTest();
        $equipo = $equipos->getEquipo();
        $this->cargarHeader($equipo->getNombre(), true, true);
        $this->plantilla->assign("nombreEquipo", $equipo->getNombre());
        $this->plantilla->assign("jugadores", $equipo->getJugadores());
        $this->plantilla->display('equipo.tpl');
    }

    public function renderEditarJugador($jugador)
    {
        $equipos = new EquipoTest();
        $equipo = $equipos->getEquipo();
        $jug = $equipo->getJugadores()[0];
        $this->cargarHeader("EDITAR JUGADOR", true, true);
        $this->plantilla->assign("jugador", $jug);
        $this->plantilla->display('editarjugador.tpl');
    }

    public function renderAdmin()
    {
        $this->cargarHeader("ADMINISTRADOR", false, true);
        $this->plantilla->display('gestionadmin.tpl');
    }
    public function renderMiEquipo()
    {
        $this->cargarHeader("MI EQUIPO", true, false);
        $this->plantilla->display('miequipo.tpl');
    }
}
