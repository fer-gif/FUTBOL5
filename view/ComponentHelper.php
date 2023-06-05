<?php
require_once 'libs/smarty/Smarty.class.php';
require_once 'model/SesionHelper.php';

class ComponentHelper
{
    private $sesion;
    public function __construct()
    {
        $this->sesion = new SesionHelper();
    }
    /**
     * Carga la estructura html basica de la pagina
     * 
     * Comprueba los permisos del usuario para armar el header.
     * Setea el titulo de la pagina.<br>
     * La plantilla es pasada por referencia con lo cual vuelve modificada.
     * 
     * @acces public
     * @param mixed $plantilla Plantilla a la que se quiere añadir la estructura
     * @param mixed $titulo Titulo de la pagina 
     */
    public function cargarEstructuraHtml(&$plantilla, $titulo)
    {
        $this->cargarHeader($plantilla, $titulo);
        $this->cargarFooter($plantilla);
    }

    private function cargarHeader(&$plantilla, $titulo)
    {
        $plantilla->assign("titulo", $titulo);
        $plantilla->assign("base", BASE_URL);
        //Aca se comprueban los permisos de SesionHelper
        $plantilla->assign("capitan", $this->sesion->esCapitan());
        $plantilla->assign("admin", $this->sesion->esAdministrador());
        //$plantilla->assign("capitan", false);
        //$plantilla->assign("admin", true);
        if ($this->sesion->hayError()) {
            $plantilla->assign("mensaje", $this->sesion->getMensajeError());
            $this->sesion->destruirMensaje();
        }
    }

    private function cargarFooter(&$plantilla)
    {
    }
}
