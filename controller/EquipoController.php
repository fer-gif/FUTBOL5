<?php
require_once 'view/EquipoView.php';
//require_once 'EquipoModel.php';
require_once('model/TorneoModel.php');


class EquipoController
{
    private $equipoView;
    private $equipoModel;

    public function __construct()
    {
        $this->equipoView = new EquipoView();
        $this->equipoModel = new TorneoModel();
    }
    /**
     * Muestra la tabla de posiciones de los equipos
     */
    public function mostrarHome()
    {
        $equipos = $this->equipoModel->getTorneo();
        $this->equipoView->renderHome($equipos);
    }
    /**
     * Muestra una lista de los equipos en la cual se puede hacer click sobre un elemento
     * y ver la lista de los jugadores anotados en dicho equipo
     */
    public function mostrarEquipos()
    {
        $equipos = $this->equipoModel->getTorneo();
        $this->equipoView->renderEquipos($equipos);
    }

    public function registrarEquipo()
    {
        if (isset($_REQUEST['nombreEquipo']) && (!empty($_REQUEST['nombreEquipo']))) {
            $nombre = $_REQUEST['nombreEquipo'];
            $this->equipoModel->addEquipo($nombre);
        }
    }

    public function editarEquipo()
    {
    }
}
