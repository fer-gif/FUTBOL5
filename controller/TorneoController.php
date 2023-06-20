<?php
require_once('view/TorneoView.php');

class TorneoController
{
    private $torneoView;

    public function __construct()
    {
        $this->torneoView = new TorneoView();
    }
    public function errorEnServidor()
    {
        $this->torneoView->renderErrorServidor();
    }
}
