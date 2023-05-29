<?php

require_once 'view/AdminView.php';
require_once 'modelPrueba/EquipoModel.php';

class AdminController
{
    private $adminView;
    private $adminModel;

    public function __construct()
    {
        $this->adminView = new AdminView();
        $this->adminModel = new EquipoModel();
    }


    public function mostrarGestionAdmin()
    {
        $equipos = $this->adminModel->getEquipos();
        $this->adminView->renderAdmin($equipos);
    }
}
