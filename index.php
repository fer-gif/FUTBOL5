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
/*HACER TODOS LOS NEW DE LOS CONTROLLER ACA. NO EN CADA CASE*/
switch ($params[0]) {
    case 'home':
        $control = new PartidoController();
        $control->mostrarHome();
        break;
    case 'jugadores':
        if (isset($params[1]) && !empty($params[1])) {
            switch ($params[1]) {
                case 'ver':
                    $control = new JugadorController();
                    $control->mostrarJugador($params[2]);
                    break;
                case 'editar':
                    $control = new JugadorController();
                    $control->mostrarEditarJugador($params[2]);
                    break;
                case 'update':
                    $control = new JugadorController();
                    $control->editarJugador($params[2]);
                    break;
                case 'eliminar':
                    $control = new JugadorController();
                    $control->eliminarJugador($params[2]);
                    break;
                case 'eliminarconfirmado':
                    $control = new JugadorController();
                    $control->eliminarConfirmado($params[2]);
                    break;
                case 'registrar':
                    $control = new JugadorController();
                    $control->registrarJugador();
                    break;
                default:
                    header("HTTP/1.0 404 Not Found");
                    $control = new UserController();
                    $control->paginaNoExiste();
            }
        } else {
            $control = new JugadorController();
            $control->mostrarJugadores();
        }
        break;
    case 'equipos':
        if (isset($params[1]) && !empty($params[1])) {
            switch ($params[1]) {
                case 'editar':
                    $control = new EquipoController();
                    $control->mostrarEditarEquipo($params[2]);
                    break;
                case 'update':
                    $control = new EquipoController();
                    $control->editarEquipo($params[2]);
                    break;
                case 'eliminar':
                    $control = new JugadorController();
                    $control->mostrarEliminarEquipo($params[2]);
                    break;
                case 'eliminarconfirmado':
                    $control = new EquipoController();
                    $control->eliminarEquipoConfirmado($params[2]);
                    break;
                case 'ver':
                    $control = new JugadorController();
                    $control->mostrarJugadoresxEquipo($params[2]);
                    break;
                case 'registrar':
                    $control = new EquipoController();
                    $control->registrarEquipo();
                    break;
                case 'editarescudo':
                    $control = new EquipoController();
                    $control->editarEscudo($params[2]);
                    break;
                default:
                    header("HTTP/1.0 404 Not Found");
                    $control = new UserController();
                    $control->paginaNoExiste();
            }
        } else {
            $control = new EquipoController();
            $control->mostrarEquipos();
        }
        break;
    case 'admin':
        $control = new UserController();
        $control->mostrarGestionAdmin();
        break;
    case 'miequipo':
        $control = new UserController();
        $control->mostrarMiEquipo();
        break;
        /*case 'fixture':
        $control = new EquipoController();
        $control->mostrarFixture();
        break;*/
    case 'login':
        if (isset($params[1]) && !empty($params[1]))
            switch ($params[1]) {
                case 'ingreso':
                    $control = new UserController();
                    $control->procesarLogin();
                    break;
                case 'logout':
                    $control = new UserController();
                    $control->logout();
                    break;
                default:
                    header("HTTP/1.0 404 Not Found");
                    $control = new UserController();
                    $control->paginaNoExiste();
            }
        else {
            $control = new UserController();
            $control->mostrarLogin();
        }
        break;
    case 'usuario':
        switch ($params[1]) {
            case 'registrar':
                $control = new UserController();
                $control->registrarUsuario();
                break;
            case 'ver':
                $control = new UserController();
                $control->mostrarUsuario($params[2]);
                break;
            case 'eliminarconfirmado':
                $control = new UserCOntroller();
                $control->eliminarUsuario($params[2]);
                break;
            case 'eliminar':
                $control = new UserController();
                $control->mostrarEliminarUser($params[2]);
                break;
            case 'editar':
                $control = new UserController();
                $control->mostrarEditarUsuario($params[2]);
                break;
            case 'update':
                $control = new UserController();
                $control->updateUsuario($params[2]);
                break;
            default:
                header("HTTP/1.0 404 Not Found");
                $control = new UserController();
                $control->paginaNoExiste();
        }
        break;
        /*case 'registrarPartido':
        $control = new PartidoController();
        $control->registrarPartido();
        break;*/
    default: {
            $control = new UserController();
            $control->paginaNoExiste();
            //header("HTTP/1.0 404 Not Found");
        }
}
