<?php
require_once 'model/EquipoModel.php';
require_once 'model/PartidoModel.php';
require_once 'view/EquipoView.php';
class PartidoController
{
    private $equipoModel;
    private $partidoModel;
    private $equipoView;

    public function __construct()
    {
        $this->equipoModel = new EquipoModel();
        $this->partidoModel = new PartidoModel();
        $this->equipoView = new EquipoView();
    }

    public function mostrarHome()
    {

        $posiciones=array();
        $totalEquipos=$this->equipoModel->totalEquipos();

        for($id=1;$id<$totalEquipos;$id++){
                $equipoArreglo=array(
                    "nombre"=>$this->equipoModel->getEquipo($id),
                    "puntos"=>$this->partidoModel->getPuntos($id),
                    "pg"=>$this->partidoModel->getPartidoGanado($id),
                    "pe"=>$this->partidoModel->getPartidoEmpatado($id),
                    "pp"=>$this->partidoModel->getPartidoPerdidos($id),
                    "gf"=>$this->partidoModel->getGolesDeEqipo($id),
                    "gc"=>$this->partidoModel->getGolesRecibidos($id)
                );
            array_push($posiciones,$equipoArreglo);
        }
        
        usort($posiciones, function($a,$b){
            return $b['puntos'] - $a['puntos'];
        });

        $this->torneoView->cargarHome($posiciones);

        return $posiciones;
           
    }

    public function registrarPartido()
    {
        
    }
}
