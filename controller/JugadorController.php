<?php

require_once 'view/jugadorView.php';
require_once 'modelPrueba/JugadorModel.php';
require_once 'modelPrueba/EquipoModel.php';
require_once 'model/TorneoModel.php';

class JugadorController
{
    private $jugadorView;
    private $jugadorModel;
    private $equipoModel;


    public function __construct()
    {
        $this->jugadorView = new JugadorView();
        $this->jugadorModel = new JugadorModel();
        $this->equipoModel = new EquipoModel();
        //$this->jugadorModel = new TorneoModel();
    }
    public function mostrarJugadoresxEquipo($id)
    {
        //$jugadores = $this->jugadorModel->getjugadores($id);
        $equipo = $this->equipoModel->getEquipo($id);
        $this->jugadorView->renderJugadoresxEquipo($equipo);
    }

    public function mostrarEditarJugador($id)
    {
        $jugador = null;
        $this->jugadorView->renderEditarJugador($jugador);
    }
    public function editarJugador()
    {
        if (!empty($_REQUEST['nombre']) && !empty($_REQUEST['apellido']) && !empty($_REQUEST['posicion'])) {
            echo $_REQUEST['nombre'];
        }
    }
    public function registrarJugador()
    {
        if (!empty($_REQUEST['nombreJugador']) && !empty($_REQUEST['apellidoJugador']) && !empty($_REQUEST['dni'])) {
            $nombre = $_REQUEST['nombreJugador'];
            $apellido = $_REQUEST['apellidoJugador'];
            $dni = $_REQUEST['dni'];
            $telefono = $_REQUEST['telefono'];
            $equipo = $_REQUEST['equipo'];
            $posicion = $_REQUEST['posicion'];
            $result = $this->jugadorModel->addJugador($nombre, $apellido, $dni, $posicion, $telefono, $equipo);
            if ($result > 0)
                print($result);
            else
                print("ERRORRRRRRRRRRR");
            die();
        }
    }
}
