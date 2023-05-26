<?php

require_once 'view/jugadorView.php';
//require_once 'model/JugadorModel.php';
require_once 'model/TorneoModel.php';

class JugadorController
{
    private $jugadorView;
    private $jugadorModel;

    public function __construct()
    {
        $this->jugadorView = new JugadorView();
        //$this->jugadorModel = new JugadorModel();
        $this->jugadorModel = new TorneoModel();
    }
    public function mostrarJugadoresxEquipo($id)
    {
        $this->jugadorView->renderJugadoresxEquipo($id);
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
}
