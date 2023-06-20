<?php
require_once 'model/EquipoModel.php';
require_once 'model/PartidoModel.php';
require_once 'model/SesionHelper.php';
require_once 'model/Utils.php';
require_once 'view/PartidoView.php';

class PartidoController
{
    private $equipoModel;
    private $partidoModel;
    private $partidoView;
    private $sesion;
    private $utils;


    public function __construct()
    {
        $this->partidoView = new PartidoView();
        $this->sesion = new SesionHelper();
        $this->utils = new Utils();
        try {
            $this->equipoModel = new EquipoModel();
            $this->partidoModel = new PartidoModel();
        } catch (Exception $e) {
            $this->utils->redirigirPagina("error");
            exit();
        }
    }


    public function mostrarHome()
    {

        $posiciones = array();
        $equipos = $this->equipoModel->getEquipos();
        foreach ($equipos as $equipo) {
            $partidos = $this->partidoModel->getPartidosXEquipo($equipo->id_equipo);
            $estadisticas = $this->calcularEstadistica($partidos, $equipo->id_equipo);
            $estadisticas["nombre"] = $equipo->nombre;
            array_push($posiciones, $estadisticas);
        }

        usort($posiciones, function ($a, $b) {
            return $b['puntos'] - $a['puntos'];
        });

        $this->partidoView->cargarHome($posiciones);

        return $posiciones;
    }

    public function calcularEstadistica($partidos, $idEquipo)
    {
        $equipoArreglo = array(
            "puntos" => 0,
            "pj" => 0,
            "pg" => 0,
            "pe" => 0,
            "pp" => 0,
            "gf" => 0,
            "gc" => 0
        );
        foreach ($partidos as $partido) {
            if ($partido['id_equipo1'] == $idEquipo)
                $this->calcularPartido($equipoArreglo, $partido['goles_equipo1'], $partido['goles_equipo2']);
            else
                $this->calcularPartido($equipoArreglo, $partido['goles_equipo2'], $partido['goles_equipo1']);
        }
        return $equipoArreglo;
    }

    public function calcularPartido(&$arreglo, $golesEquipo, $golesElotro)
    {
        if ($golesEquipo > $golesElotro) {
            $arreglo["puntos"] += 3;
            $arreglo["pg"] += 1;
            $arreglo["gf"] += $golesEquipo;
            $arreglo["gc"] += $golesElotro;
        } elseif ($golesEquipo == $golesElotro) {
            $arreglo["puntos"] += 1;
            $arreglo["pe"] += 1;
            $arreglo["gf"] += $golesEquipo;
            $arreglo["gc"] += $golesElotro;
        } else {
            $arreglo["pp"] += 1;
            $arreglo["gf"] += $golesEquipo;
            $arreglo["gc"] += $golesElotro;
        }
        $arreglo["pj"] += 1;
    }

    public function mostrarFixture()
    {
        $partidos = $this->partidoModel->getPartidos();
        $this->partidoView->showFixture($partidos);
    }


    public function registrarPartido()
    {
        $this->utils->comprobarAdministrador();

        if (
            isset($_REQUEST["golesEquipo1"]) && ($_REQUEST["golesEquipo1"] != "")
            && isset($_REQUEST["golesEquipo2"]) && ($_REQUEST["golesEquipo2"] != "")
            && isset($_REQUEST["fecha"]) && ($_REQUEST["fecha"] != "")
        ) {
            $equipo1 = $_REQUEST["equipo1"];
            $equipo2 = $_REQUEST["equipo2"];
            if ($equipo1 === $equipo2)
                $this->utils->redirigirPagina("admin", "Al registrar un partido los equipos deben ser diferentes");
            $golesEquipo1 = $_REQUEST["golesEquipo1"];
            $golesEquipo2 = $_REQUEST["golesEquipo2"];
            $fecha = $_REQUEST["fecha"];
            $partido = $this->partidoModel->getCruceDePartido($equipo1, $equipo2);
            if (!$partido) {
                $result = $this->partidoModel->addPartido($equipo1, $equipo2, $golesEquipo1, $golesEquipo2, $fecha);
                if ($result)
                    $this->utils->redirigirPagina("admin", "Partido agregado correctamente");
                else
                    $this->utils->redirigirPagina("admin", "Hubo un error al intentar agregar el partido ");
            } else
                $this->utils->redirigirPagina("admin", "Los equipos ingresados ya poseen un partido jugado entre ellos");
        } else
            $this->utils->redirigirPagina("admin", "Los campos goles y fecha deben estar completos en el registro de un partido.");
    }

    public function editarPartido($id_partido)
    {
        $this->utils->comprobarAdministrador();
        if (
            isset($_REQUEST["golesEquipo1"]) && ($_REQUEST["golesEquipo1"] != "")
            && isset($_REQUEST["golesEquipo2"]) && ($_REQUEST["golesEquipo2"] != "")
            && isset($_REQUEST["fecha"]) && ($_REQUEST["fecha"] != "")
        ) {
            $golesEquipo1 = $_REQUEST["golesEquipo1"];
            $golesEquipo2 = $_REQUEST["golesEquipo2"];
            $fecha = $_REQUEST["fecha"];

            $result = $this->partidoModel->updatePartido($id_partido, $golesEquipo1, $golesEquipo2, $fecha);
            if ($result)
                $this->utils->redirigirPagina("fixture", "Partido actualizado correctamente");
            else
                $this->utils->redirigirPagina("admin", "Hubo un error al intentar actualizar el partido ");
        } else
            $this->utils->redirigirPagina("fixture/editar/" . $id_partido, "Los campos goles y fecha deben estar completos en el registro de un partido.");
    }

    public function mostrarEditarPartido($idPartido)
    {
        $this->utils->comprobarAdministrador();
        $partido = $this->partidoModel->getPartido($idPartido);
        $this->partidoView->renderEditarPartido($partido);
    }

    public function confirmaEliminarPartido($idPartido)
    {
        $this->utils->comprobarAdministrador();
        $partidos = $this->partidoModel->getPartidos();
        $this->partidoView->showFixture($partidos, $idPartido, true);
    }
    public function eliminarPartido($idParatido)
    {
        $this->utils->comprobarAdministrador();
        $partido = $this->partidoModel->getPartido($idParatido);
        if ($partido) {
            $result = $this->partidoModel->deletePartido($idParatido);
            if ($result) {
                $this->utils->redirigirPagina("fixture", "Partido eliminado correctamente.");
            } else
                $this->utils->redirigirPagina("fixture", "Hubo en error al intentar eliminar el partido.");
        } else
            $this->utils->redirigirPagina("fixture", "El partido que intenta eliminar no existe en nuestra base de datos.");
    }
}
