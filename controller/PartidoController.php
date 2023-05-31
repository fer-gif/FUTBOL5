<?php
require_once 'model/PartidoModel.php';
require_once 'model/Equipo.php';
require_once 'model/EquiposModel.php';

class PartidoController
{
    private $equipoView;
    private $equipoModel;
    private $partidoModel;

    public function __construct()
    {
        $this->equipoView = new EquipoView();
        $this->equipoModel = new EquiposModel();
        $this->partidoModel = new PartidoModel();
    }
    /**
     * Muestra la tabla de posiciones de los equipos
     */
    public function mostrarHome()
    {
        $equipos = $this->armarTablaPosiciones();
        $this->equipoView->renderHome($equipos);
    }

    public function armarTablaPosiciones()
    {
        $equipos = $this->equipoModel->getEquipos();
        $tabla = [];
        foreach ($equipos as $equipo) {
            $partidos = $this->partidoModel->getPartidosxEquipo($equipo->getIdEquipo());
            $equipo = $this->calcularEstadisticaEquipo($equipo, $partidos);
            array_push($tabla, $equipo);
        }

        usort($tabla, function ($equipo1, $equipo2) {
            if ($equipo2->getPuntos() < $equipo1->getPuntos())
                return -1;
            elseif ($equipo2->getPuntos() > $equipo1->getPuntos())
                return 1;
            else {
                if (($equipo2->getGF() - $equipo2->getGC()) < ($equipo1->getGF() - $equipo1->getGC()))
                    return -1;
                else
                    return 1;
            }
        });
        return $tabla;
    }

    public function calcularEstadisticaEquipo($equipo, $partidos)
    {
        foreach ($partidos as $partido) {
            if ($partido->getEquipo1()->getIdEquipo() === $equipo->getIdEquipo())
                $equipo = $this->compararPartido($equipo, $partido->getGolesEquipo1(), $partido->getGolesEquipo2());
            else
                $equipo = $this->compararPartido($equipo, $partido->getGolesEquipo2(), $partido->getGolesEquipo1());
        }
        return $equipo;
    }

    public function compararPartido($equipo1, $goles1, $goles2)
    {
        if ($goles1 > $goles2) {
            $equipo1->setPuntos($equipo1->getPuntos() + 3);
            $equipo1->setPG($equipo1->getPG() + 1);
        } elseif ($goles1 === $goles2) {
            $equipo1->setPuntos($equipo1->getPuntos() + 1);
            $equipo1->setPE($equipo1->getPE() + 1);
        } elseif ($goles1 < $goles2) {
            $equipo1->setPP($equipo1->getPP() + 1);
        }
        $equipo1->setPartidos_jugados($equipo1->getPartidos_jugados() + 1);
        $equipo1->setGF($equipo1->getGF() + $goles1);
        $equipo1->setGC($equipo1->getGC() + $goles2);
        return $equipo1;
    }

    public function registrarPartido()
    {
        if (!empty($_REQUEST['golesEquipo1']) && !empty($_REQUEST['golesEquipo2'])) {
            $equipo1 = $_REQUEST['equipo1'];
            $equipo2 = $_REQUEST['equipo2'];
            if ($equipo1 != $equipo2) {
                $golese1 = $_REQUEST['golesEquipo1'];
                $golese2 = $_REQUEST['golesEquipo2'];
                $fecha = $_REQUEST['fecha'];
                if ($golese1 < 0 || $golese2 < 0)
                    $result = "Lo goles deben ser positivos o 0";
                else
                    $result = $this->partidoModel->registrarPartido($equipo1, $equipo2, $golese1, $golese2, $fecha);
            } else
                $result = "ERROR; EQUIPOS IGUALES";
            print($result);
            die();
        }
    }
}
