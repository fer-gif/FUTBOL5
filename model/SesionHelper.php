<?php

class SesionHelper
{
    public function setLogeo($usuario)
    {
        if (!self::estaLogeado()) {
            session_start();
            $_SESSION["usuario"] = $usuario;
        }
    }
    public static function estaLogeado()
    {
        session_start();
        if (isset($_SESSION["usuario"]))
            return true;
        else
            return false;
    }
    public static function esAdmin()
    {
        return self::comprobarPermiso(5);
    }
    public static function esCapitan()
    {
        return self::comprobarPermiso(3);
    }
    private static function comprobarPermiso($numero)
    {

        if (self::estaLogeado()) {
            session_start();
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
