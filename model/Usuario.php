<?php

class Usuario
{
    private $usuario;
    private $permisos;
    private $equipo;

    public function __construct($usuario, $permisos, $equipo)
    {
        $this->usuario = $usuario;
        $this->permisos = $permisos;
        $this->equipo = $equipo;
    }
    public function getUsuario()
    {
        return $this->usuario;
    }
    public function getEquipo()
    {
        return $this->equipo;
    }
    public function getPermisos()
    {
        return $this->permisos;
    }
}
