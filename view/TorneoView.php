<?php


require_once 'libs/smarty/Smarty.class.php';

class TorneoView
{

    public function visualizaHome()
    {
        $plantilla = new Smarty();
        $plantilla->assign("titulo", "HOME");
        $plantilla->display('home.tpl');
    }
}
