<?php

define("BASE_URL", 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']));

require_once('controller/TorneoController.php');

if (!empty($_REQUEST['action']))
    $accion = $_REQUEST['action'];
else
    $accion = 'home';

$params = explode("/", $accion);

switch ($params[0]) {
    case 'home':
        $control = new TorneoController();
        $control->mostrarHome();
        break;
    case 'equipos':
        $control = new TorneoController();
        $control->mostrarEquipos();
        break;
    case 'equipo':
        switch ($params[1]) {
            case 'editar':
                break;
            case 'eliminar':
                break;
            case 'ver':
                $control = new TorneoController();
                $control->mostrarEquipo($params[1]);
                break;
        }
        break;
    case 'jugador':
        switch ($params[1]) {
            case 'editar':
                $control = new TorneoController();
                $control->mostrarEditarJugador($params[1]);
                break;
            case 'update':
                $control = new TorneoController();
                $control->editarJugador($params[1]);
                break;
            case 'eliminar':
                break;
        }
        break;
    case 'admin':
        $control = new TorneoController();
        $control->mostrarGestionAdmin();
    case 'registrarequipo':
        $control = new TorneoController();
        $control->registrarEquipo();
}
