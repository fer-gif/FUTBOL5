<?php

class AuthHelper
{
    public function __construct()
    {
    }
    public function setLogeo($usuario)
    {
        session_start();
        $_SESSION["usuario"] = $usuario;
    }
    public function estaLogeado()
    {
        
        if (!empty($_SESSION["usuario"]))
            return true;
        else
            return false;
    }
    public function esAdmin()
    {
        return $this->comprobarPermiso(5);
    }
    public function esCapitan()
    {
        return $this->comprobarPermiso(3);
    }
    private function comprobarPermiso($numero)
    {
        session_start();
        if ($this->estaLogeado()) {
            $usuario = $_SESSION["usuario"];
            if ($usuario->getPermisos() == $numero)
                return true;
            else
                return false;
        } else
            return false;
    }
    public function logout()
    {
        session_destroy();
    }
}
