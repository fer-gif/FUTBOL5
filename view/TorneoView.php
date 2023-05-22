<?php


require_once 'libs/smarty/Smarty.class.php';
require_once 'equiposTest.php';
require_once 'equipoTest.php';

class TorneoView
{

    public function visualizaHome()
    {
        $equipos = new EquiposTest();
        $plantilla = new Smarty();
        $plantilla = $this->cargarHeader($plantilla, "HOME", true, true);
        $plantilla->assign("equipos", $equipos->getEquipos());
        $plantilla->display('home.tpl');
    }

    public function visualizarEquipos()
    {
        $equipos = new EquiposTest();
        $plantilla = new Smarty();
        $plantilla = $this->cargarHeader($plantilla, "EQUIPOS", true, true);
        $plantilla->assign("equipos", $equipos->getEquipos());
        $plantilla->display('equipos.tpl');
    }
    public function visualizarEquipo($idEquipo)
    {
        $equipos = new EquipoTest();
        $equipo = $equipos->getEquipo();
        $plantilla = new Smarty();
        $plantilla = $this->cargarHeader($plantilla, $equipo->getNombre(), true, true);
        $plantilla->assign("nombreEquipo", $equipo->getNombre());
        $plantilla->assign("jugadores", $equipo->getJugadores());
        $plantilla->display('equipo.tpl');
    }

    public function visualizarEditarJugador($jugador)
    {
        $equipos = new EquipoTest();
        $equipo = $equipos->getEquipo();
        $jug = $equipo->getJugadores()[0];
        $plantilla = new Smarty();
        $plantilla = $this->cargarHeader($plantilla, "EDITAR JUGADOR", true, true);
        $plantilla->assign("jugador", $jug);
        $plantilla->display('editarjugador.tpl');
    }
    private function cargarHeader($plantilla, $titulo, $user, $admin)
    {
        $plantilla->assign("titulo", $titulo);
        $plantilla->assign("base", BASE_URL);
        $plantilla->assign("user", $user);
        $plantilla->assign("admin", $admin);
        return $plantilla;
    }
}
