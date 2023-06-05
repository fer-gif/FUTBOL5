<?php
require_once 'model/EquipoModel.php';
require_once 'model/PartidoModel.php';
require_once 'view/EquipoView.php';
require_once 'model/SesionHelper.php';
require_once 'model/Utils.php';


class EquipoController
{
    private $equipoModel;
    private $equipoView;
    private $sesion;
    private $utils;


    public function __construct()
    {
        $this->equipoModel = new EquipoModel();
        $this->equipoView = new EquipoView();
        $this->sesion = new SesionHelper();
        $this->utils = new Utils();
    }

    public function mostrarEquipos()
    {
        $equipos = $this->equipoModel->getEquipos();
        $this->equipoView->renderEquipos($equipos);
    }

    public function registrarEquipo()
    {
        if ($this->sesion->esAdministrador()) {
            if (!empty($_REQUEST["nombreEquipo"])) {
                $nombre = $_REQUEST["nombreEquipo"];
                $equipo = $this->equipoModel->getEquipo(null, $nombre);
                if (!$equipo) {
                    $result = $this->equipoModel->addEquipo($nombre);
                    if ($result)
                        $this->utils->redirigirPagina("admin", "Equipo agregado correctamente.");
                    else
                        $this->utils->redirigirPagina("admin", "Hubo un error al intentar agregar el equipo.");
                } else
                    $this->utils->redirigirPagina("admin", "Ya existe un equipo con el nombre ingresado");
            } else
                $this->utils->redirigirPagina("admin", "Debe completar el campo Nombre del equipo.");
        } else
            $this->utils->redirigirPagina("login");
    }
    public function mostrarEditarEquipo($idEquipo)
    {
        if ($this->sesion->esAdministrador()) {
            $equipo = $this->equipoModel->getEquipo($idEquipo);
            if ($equipo) {
                $this->equipoView->renderEditarEquipo($equipo);
            } else
                print("#ERROR");
        } else
            $this->utils->redirigirPagina("login");
    }

    public function editarEquipo($idEquipo)
    {
        if ($this->sesion->esAdministrador()) {
            if (isset($_REQUEST["nombreEquipo"]) && (!empty($_REQUEST["nombreEquipo"]))) {
                $nombre = $_REQUEST["nombreEquipo"];
                $equipo = $this->equipoModel->getEquipo(null, $nombre);
                if (!$equipo) {
                    $this->equipoModel->updateEquipo($idEquipo, $nombre);
                    $this->utils->redirigirPagina('equipos/editar/' . $idEquipo, "Equipo editado correctamente.");
                } else
                    $this->utils->redirigirPagina('equipos/editar/' . $idEquipo, "El nombre del equipo ya existe en nuestra base de datos.");
            } else
                $this->utils->redirigirPagina('equipos/editar/' . $idEquipo, "Debe elegir un nombre para el equipo.");
        } else
            $this->utils->redirigirPagina("login");
    }

    public function eliminarEquipoConfirmado($idEquipo)
    {
        if ($this->sesion->esAdministrador()) {
            $equipo = $this->equipoModel->getEquipo($idEquipo);
            if ($equipo) {
                $result = $this->equipoModel->deleteEquipo($idEquipo);
                if ($result)
                    $this->utils->redirigirPagina("equipos", "Equipo eliminado correctamente.");
                else
                    $this->utils->redirigirPagina("equipos", "Hubo en error al intentar eliminar el equipo.");
            } else
                $this->utils->redirigirPagina("equipos", "El equipo que intenta eliminar no existe en nuestra base de datos.");
        } else
            $this->utils->redirigirPagina("login");
    }
}
