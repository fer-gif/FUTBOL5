<?php

require_once 'view/UserView.php';
//require_once 'model/UserModel.php';
require_once 'model/TorneoModel.php';

class UserController
{
    private $userView;

    public function __construct()
    {
        $this->userView = new UserView();
    }
    public function mostrarMiEquipo()
    {
        $this->userView->renderMiEquipo();
    }
    public function mostrarLogin()
    {
        $this->userView->renderIngresoLogin();
    }
}
