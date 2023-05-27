<?php
require_once 'view/EquipoView.php';
require_once 'modelPrueba/EquipoModel.php';
require_once('model/TorneoModel.php');


class EquipoController
{
    private $equipoView;
    private $equipoModel;
    private $equipoModelPrueba;
    public function __construct()
    {
        $this->equipoView = new EquipoView();
        $this->equipoModel = new TorneoModel();
        $this->equipoModelPrueba = new EquipoModel();
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
        $equipos = $this->equipoModel->getTorneo();
        $this->equipoView->renderFixture($equipos);
    }
    public function registrarPartido()
    {
        if (!empty($_REQUEST['golesEquipo1']) && !empty($_REQUEST['golesEquipo2'])) {
            $equipo1 = $_REQUEST['equipo1'];
            $equipo2 = $_REQUEST['equipo2'];
            if ($equipo1 != $equipo2) {
                $golese1 = $_REQUEST['golesEquipo1'];
                $golese2 = $_REQUEST['golesEquipo2'];
                if ($golese1 < 0 || $golese2 < 0)
                    $result = "Lo goles deben ser positivos o 0";
                else
                    $result = $this->equipoModelPrueba->registrarPartido($equipo1, $equipo2, $golese1, $golese2);
            } else
                $result = "ERROR; EQUIPOS IGUALES";
            print($result);
            die();
        }
    }
}
