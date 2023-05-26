<?php

class TorneoView
{
    public function __construct()
    {
    }
    public function cargarHeader(&$plantilla, $titulo, $user, $admin)
    {
        $plantilla->assign("titulo", $titulo);
        $plantilla->assign("base", BASE_URL);
        $plantilla->assign("user", $user);
        $plantilla->assign("admin", $admin);
    }
}
