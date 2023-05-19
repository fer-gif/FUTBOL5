<?php

define("BASE_URL", '' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']));

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
}
