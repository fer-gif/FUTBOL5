<?php
require_once 'model/SesionHelper.php';

class Utils
{
    private $sesion;

    public function __construct()
    {
        $this->sesion = new SesionHelper();
    }

    public function redirigirPagina($url, $mensaje = null)
    {

        if ($url == 'login')
            $this->sesion->destruirSesion();
        if (!empty($mensaje))
            $this->sesion->setMensajeError($mensaje);
        header('Location: ' . BASE_URL . '/' . $url);
        exit();
    }

    public function ordenarPorApellido(&$jugadores)
    {
        usort($jugadores, function ($jugador1, $jugador2) {
            return strcmp($jugador1["apellido"], $jugador2["apellido"]);
        });
    }
    public function comprobarAdministrador()
    {
        if (!$this->sesion->esAdministrador()) {
            $this->redirigirPagina("login");
        }
    }
    public function comprobarCapitan()
    {
        if (!$this->sesion->esCapitan()) {
            $this->redirigirPagina("login");
        }
    }
}
