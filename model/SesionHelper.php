<?php

class SesionHelper
{

    public function __construct()
    {
    }
    public function setSesion($idUsuario, $usuario, $permisos, $equipo = null)
    {
        $this->comprobarSession();
        $_SESSION["usuario"] = $usuario;
        $_SESSION["permisos"] = $permisos;
        $_SESSION["idUsuario"] = $idUsuario;
        if (isset($equipo))
            $_SESSION["equipo"] = $equipo;
    }
    public function esAdministrador()
    {
        return $this->comprobarPermisos(5);
    }

    public function esCapitan()
    {
        return $this->comprobarPermisos(3);
    }

    public function esUsuario()
    {
        return $this->comprobarPermisos(1);
    }

    private function comprobarPermisos($permiso)
    {
        $this->comprobarSession();
        if (isset($_SESSION["usuario"]) && ($_SESSION["permisos"] == $permiso))
            return true;
        else
            return false;
    }

    private function comprobarSession()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function getUsuario()
    {
        $this->comprobarSession();
        if (isset($_SESSION["usuario"]))
            return ($_SESSION["usuario"]);
        else
            return null;
    }
    public function destruirSesion()
    {
        $this->comprobarSession();
        if (isset($_SESSION["usuario"])) {
            session_destroy();
        }
    }
    public function setMensajeError($mensaje)
    {
        $this->comprobarSession();
        $_SESSION["mensajeError"] = $mensaje;
    }
    public function destruirMensaje()
    {
        $this->comprobarSession();
        if (isset($_SESSION["mensajeError"])) {
            unset($_SESSION["mensajeError"]);
        }
    }
    public function hayError()
    {
        $this->comprobarSession();
        if (isset($_SESSION["mensajeError"]))
            return true;
        else
            return false;
    }
    public function getMensajeError()
    {
        $this->comprobarSession();
        if (isset($_SESSION["mensajeError"]))
            return $_SESSION["mensajeError"];
        else
            return "";
    }
}
