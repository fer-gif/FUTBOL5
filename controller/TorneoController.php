<?php

require_once 'view/TorneoView.php';
require_once 'model/EquiposModel.php';


class TorneoCOntroller
{
    private $torneoView;
    private $adminModel;

    public function __construct()
    {
        $this->torneoView = new TorneoView();
        $this->adminModel = new EquiposModel();
    }


    public function mostrarGestionAdmin()
    {
        $equipos = $this->adminModel->getEquipos();
        $this->torneoView->renderAdmin($equipos);
    }

    public function mostrarMiEquipo()
    {
        $this->torneoView->renderMiEquipo();
    }
}
