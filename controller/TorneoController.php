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
        $this->modelo=new TorneoModel();
    }

    public function mostrarHome()
    {
        $this->modelo->getTorneo();
        $this->vista->visualizaHome();
    }
    public function mostrarEquipos()
    {
        $this->vista->visualizarEquipos();
    }
    public function mostrarEquipo($id)
    {
        $this->vista->visualizarEquipo($id);
    }
    public function mostrarEditarJugador($id)
    {
        $jugador = null;
        $this->vista->visualizarEditarJugador($jugador);
    }
    public function editarJugador()
    {
    }
}
