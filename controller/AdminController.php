<?php

require_once 'view/AdminView.php';

class AdminController
{
    private $adminView;
    private $adminModel;

    public function __construct()
    {
        $this->adminView = new AdminView();
    }


    public function mostrarGestionAdmin()
    {
        $this->adminView->renderAdmin();
    }
}
