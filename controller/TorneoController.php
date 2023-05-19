<?php
require_once('view/TorneoView.php');
class TorneoController
{
    private $vista;
    private $modelo;

    public function __construct()
    {
        $this->vista = new TorneoView();
    }

    public function mostrarHome()
    {
        $this->vista->visualizaHome();
    }
}
