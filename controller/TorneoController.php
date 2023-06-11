<?php
require_once 'model/EquipoModel.php';
require_once 'model/PartidoModel.php';
require_once 'view/EquipoView.php';
require_once 'view/TorneoView.php';
class TorneoController
{
    private $equipoModel;
    private $partidoModel;
    private $equipoView;
    private $torneoView;

    public function __construct()
    {
        $this->equipoModel = new EquipoModel();
        $this->partidoModel = new PartidoModel();
        $this->equipoView = new EquipoView();
        $this->torneoView= new TorneoView();
    }


}
