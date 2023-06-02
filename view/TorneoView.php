<?php
require_once 'libs/smarty/Smarty.class.php';
class TorneoView
{
    private $plantilla;

    public function __construct()
    {
        $this->plantilla=new Smarty();
    }
}
?>