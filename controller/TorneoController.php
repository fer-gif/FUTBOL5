<?php
require_once('view/TorneoView.php');
class TorneoController
{
    private $vista;
    private $modelo;

    public function __construct()
    {
        $this->vista = new TorneoView();
    }

    public function mostrarHome()
    {
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
        if (!empty($_REQUEST['nombre']) && !empty($_REQUEST['apellido']) && !empty($_REQUEST['posicion'])) {
            echo $_REQUEST['nombre'];
        }
    }
}
