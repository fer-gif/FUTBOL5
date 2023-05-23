<?php


require_once 'libs/smarty/Smarty.class.php';
require_once 'equiposTest.php';
require_once 'equipoTest.php';

class TorneoView
{
    private function cargarHeader($plantilla, $titulo, $user, $admin)
    {
        $plantilla->assign("titulo", $titulo);
        $plantilla->assign("base", BASE_URL);
        $plantilla->assign("user", $user);
        $plantilla->assign("admin", $admin);
        return $plantilla;
    }
    public function renderHome($equipos)
    {
        //$equipos = new EquiposTest();
        $plantilla = new Smarty();
        $plantilla = $this->cargarHeader($plantilla, "HOME", true, true);
        $plantilla->assign("equipos", $equipos);
        $plantilla->display('home.tpl');
    }

    public function renderEquipos()
    {
        $equipos = new EquiposTest();
        $plantilla = new Smarty();
        $plantilla = $this->cargarHeader($plantilla, "EQUIPOS", true, true);
        $plantilla->assign("equipos", $equipos->getEquipos());
        $plantilla->display('equipos.tpl');
    }
    public function renderEquipo($idEquipo)
    {
        $equipos = new EquipoTest();
        $equipo = $equipos->getEquipo();
        $plantilla = new Smarty();
        $plantilla = $this->cargarHeader($plantilla, $equipo->getNombre(), true, true);
        $plantilla->assign("nombreEquipo", $equipo->getNombre());
        $plantilla->assign("jugadores", $equipo->getJugadores());
        $plantilla->display('equipo.tpl');
    }

    public function renderEditarJugador($jugador)
    {
        $equipos = new EquipoTest();
        $equipo = $equipos->getEquipo();
        $jug = $equipo->getJugadores()[0];
        $plantilla = new Smarty();
        $plantilla = $this->cargarHeader($plantilla, "EDITAR JUGADOR", true, true);
        $plantilla->assign("jugador", $jug);
        $plantilla->display('editarjugador.tpl');
    }

    public function renderAdmin()
    {
        $plantilla = new Smarty();
        $plantilla = $this->cargarHeader($plantilla, "EDITAR JUGADOR", true, true);
        $plantilla->display('gestionadmin.tpl');
    }
}
