<?php
require_once('view/TorneoView.php');
require_once('model/TorneoModel.php');
class TorneoController
{
    private $vista;
    private $modelo;

    public function __construct()
    {
        $this->vista = new TorneoView();
        $this->modelo = new TorneoModel();
    }

    public function mostrarHome()
    {
        $this->modelo->getTorneo();
        $this->vista->renderHome();
    }
    public function mostrarEquipos()
    {
        $this->vista->renderEquipos();
    }
    public function mostrarEquipo($id)
    {
        $this->vista->renderEquipo($id);
    }
    public function mostrarEditarJugador($id)
    {
        $jugador = null;
        $this->vista->renderEditarJugador($jugador);
    }
    public function editarJugador()
    {
        if (!empty($_REQUEST['nombre']) && !empty($_REQUEST['apellido']) && !empty($_REQUEST['posicion'])) {
            echo $_REQUEST['nombre'];
        }
    }
    public function mostrarGestionAdmin()
    {
        $this->vista->renderAdmin();
    }
    public function registrarEquipo()
    {
        if (isset($_REQUEST['nombreEquipo']) && (!empty($_REQUEST['nombreEquipo']))) {
            $nombre = $_REQUEST['nombreEquipo'];
            $this->modelo->addEquipo($nombre);
        }
    }
}
