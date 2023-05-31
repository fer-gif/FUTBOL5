<?php

define("BASE_URL", 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']));

require_once('controller/EquipoController.php');
require_once('controller/JugadorController.php');
require_once('controller/TorneoController.php');
require_once('controller/PartidoController.php');
require_once('controller/UserController.php');


if (!empty($_REQUEST['action']))
    $accion = $_REQUEST['action'];
else
    $accion = 'home';

$params = explode("/", $accion);

switch ($params[0]) {
    case 'home':
        $control = new PartidoController();
        $control->mostrarHome();
        break;
    case 'equipos':
        $control = new EquipoController();
        $control->mostrarEquipos();
        break;
    case 'equipo':
        switch ($params[1]) {
            case 'editar':
                break;
            case 'eliminar':
                break;
            case 'ver':
                $control = new JugadorController();
                $control->mostrarJugadoresxEquipo($params[2]);
                break;
            case 'registrar':
                $control = new EquipoController();
                $control->registrarEquipo();
                break;
        }
        break;
    case 'jugador':
        switch ($params[1]) {
            case 'editar':
                $control = new JugadorController();
                $control->mostrarEditarJugador($params[2]);
                break;
            case 'update':
                $control = new JugadorController();
                $control->editarJugador($params[2]);
                break;
            case 'eliminar':
                break;
            case 'registrar':
                $control = new JugadorController();
                $control->registrarJugador();
                break;
        }
        break;
    case 'admin':
        $control = new TorneoController();
        $control->mostrarGestionAdmin();
        break;
    case 'miequipo':
        $control = new TorneoController();
        $control->mostrarMiEquipo();
        break;
    case 'fixture':
        $control = new EquipoController();
        $control->mostrarFixture();
        break;
    case 'login':
        $control = new UserController();
        $control->mostrarLogin();
        break;
    case 'ingreso':
        $control = new UserController();
        $control->procesarLogin();
        break;
    case 'usuario':
        switch ($params[1]) {
            case 'registrar':
                $control = new UserController();
                $control->registrarUsuario();
        }
        break;
    case 'registrarPartido':
        $control = new EquipoController();
        $control->registrarPartido();
        break;
}
