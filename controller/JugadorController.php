<?php

require_once 'view/jugadorView.php';
require_once 'model/JugadoresModel.php';
require_once 'model/EquiposModel.php';


class JugadorController
{
    private $jugadorView;
    private $jugadorModel;
    private $equipoModel;


    public function __construct()
    {
        $this->jugadorView = new JugadorView();
        $this->jugadorModel = new JugadoresModel();
        $this->equipoModel = new EquiposModel();
        //$this->jugadorModel = new TorneoModel();
    }
    public function mostrarJugadoresxEquipo($idEquipo)
    {
        //$jugadores = $this->jugadorModel->getjugadores($id);
        $equipo = $this->jugadorModel->getJugadores($idEquipo);
        $this->jugadorView->renderJugadoresxEquipo($equipo);
    }

    public function mostrarEditarJugador($idJugador)
    {
        $jugador = $this->jugadorModel->getJugador($idJugador);
        $this->jugadorView->renderEditarJugador($jugador);
    }
    public function editarJugador($idJugador)
    {   //controlas si tiene permisos de admin
        if (!empty($_REQUEST['nombre']) && !empty($_REQUEST['apellido']) && !empty($_REQUEST['dni'])) {
            $nombre = $_REQUEST['nombre'];
            $apellido = $_REQUEST['apellido'];
            $dni = $_REQUEST['dni'];
            $tel = $_REQUEST['telefono'];
            $posicion = $_REQUEST['posicion'];
            $result = $this->jugadorModel->updateJugador($idJugador, $nombre, $apellido, $dni, $tel, $posicion);
            if ($result)
                print("UPDATEADO");
            else
                print("WOWOWOWOWOWOW");

            die();
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
