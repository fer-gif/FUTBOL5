<?php
require_once 'view/EquipoView.php';
require_once 'model/EquiposModel.php';

class EquipoController
{
    private $equipoView;
    private $equipoModel;
    public function __construct()
    {
        $this->equipoView = new EquipoView();
        $this->equipoModel = new EquiposModel();
    }

    /**
     * Muestra una lista de los equipos en la cual se puede hacer click sobre un elemento
     * y ver la lista de los jugadores anotados en dicho equipo
     */
    public function mostrarEquipos()
    {
        $equipos = $this->equipoModel->getEquipos();
        $this->equipoView->renderEquipos($equipos);
    }

    public function registrarEquipo()
    {
        if (!empty($_REQUEST['nombreEquipo'])) {
            $nombre = $_REQUEST['nombreEquipo'];
            $result = $this->equipoModel->addEquipo($nombre);
            if ($result > 0)
                print($result);
            else
                print("ERROR DE REGISTRO EQUIPO");
        }
    }

    public function editarEquipo()
    {
    }
    public function mostrarFixture()
    {
        $equipos = $this->equipoModel->getEquipos();
        $this->equipoView->renderFixture($equipos);
    }
}
