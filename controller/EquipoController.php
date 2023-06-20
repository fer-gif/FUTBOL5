<?php
require_once 'model/EquipoModel.php';
require_once 'model/PartidoModel.php';
require_once 'view/EquipoView.php';
require_once 'model/Utils.php';


class EquipoController
{
    private $equipoModel;
    private $equipoView;
    private $utils;


    public function __construct()
    {
        $this->equipoModel = new EquipoModel();
        $this->equipoView = new EquipoView();
        $this->utils = new Utils();
    }

    public function mostrarEquipos()
    {
        $equipos = $this->equipoModel->getEquipos();
        $this->equipoView->renderEquipos($equipos);
    }

    public function registrarEquipo()
    {
        $this->utils->comprobarAdministrador();
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
    }
    public function mostrarEditarEquipo($idEquipo)
    {
        $this->utils->comprobarAdministrador();
        $equipo = $this->equipoModel->getEquipo($idEquipo);
        if ($equipo) {
            $this->equipoView->renderEditarEquipo($equipo);
        } else
            $this->utils->redirigirPagina("equipos", "El equipo buscado no existe en la base de datos");
    }

    public function editarEquipo($idEquipo)
    {
        $this->utils->comprobarAdministrador();

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
    }

    public function eliminarEquipoConfirmado($idEquipo)
    {
        $this->utils->comprobarAdministrador();
        $equipo = $this->equipoModel->getEquipo($idEquipo);
        if ($equipo) {
            $result = $this->equipoModel->deleteEquipo($idEquipo);
            if ($result) {
                $this->eliminarCarpetaEquipo($equipo);
                $this->utils->redirigirPagina("equipos", "Equipo eliminado correctamente.");
            } else
                $this->utils->redirigirPagina("equipos", "Hubo en error al intentar eliminar el equipo.");
        } else
            $this->utils->redirigirPagina("equipos", "El equipo que intenta eliminar no existe en nuestra base de datos.");
    }

    public function editarEscudo($idEquipo)
    {
        $this->utils->comprobarCapitan();
        if ($_FILES['escudo']['error'] === UPLOAD_ERR_OK) {
            $equipo = $this->equipoModel->getEquipo($idEquipo);
            $nombreTemp = $_FILES['escudo']['tmp_name'];
            $nombreArchivo = $_FILES['escudo']['name'];
            $carpetaDestino = getcwd() . '/image/escudos/' . $equipo->nombre;
            if (!is_dir($carpetaDestino)) {
                mkdir($carpetaDestino, 0777, true);
            } else {
                $this->limpiarCarpeta($carpetaDestino);
            }
            $rutaDestino = $carpetaDestino . '/' . $nombreArchivo;
            if (move_uploaded_file($nombreTemp, $rutaDestino)) {
                $result = $this->equipoModel->setEscudo($idEquipo, $nombreArchivo);
                if ($result)
                    $this->utils->redirigirPagina("miequipo", "El escudo ha sido actualizado.");
                else
                    $this->utils->redirigirPagina("miequipo", "Hubo un error al actualizar el escudo.");
            } else {
                $this->utils->redirigirPagina("miequipo", "Hubo un error al intentar guardar el escudo.");
            }
        } else {
            $this->utils->redirigirPagina("miequipo", "No se seleccionó un archivo valido.");
        }
    }
    private function eliminarCarpetaEquipo($equipo)
    {
        $carpetaDestino = getcwd() . '/image/escudos/' . $equipo->nombre;
        if (is_dir($carpetaDestino)) {
            $this->limpiarCarpeta($carpetaDestino);
            rmdir($carpetaDestino);
        }
    }
    private function limpiarCarpeta($carpeta)
    {
        $archivos = glob($carpeta . '/*');
        foreach ($archivos as $archivo) {
            if (is_file($archivo)) {
                unlink($archivo);
            }
        }
    }
}
