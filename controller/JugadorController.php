<?php
require_once 'model/JugadorModel.php';
require_once 'view/JugadorView.php';
require_once 'model/SesionHelper.php';
require_once 'model/Utils.php';
require_once 'model/EquipoModel.php';

class JugadorController
{
    private $jugadorModel;
    private $jugadorView;
    private $sesion;
    private $utils;
    private $equipoModel;

    public function __construct()
    {
        $this->jugadorModel = new JugadorModel();
        $this->jugadorView = new JugadorView();
        $this->sesion = new SesionHelper();
        $this->utils = new Utils();
        $this->equipoModel = new EquipoModel();
    }
    public function mostrarJugadores()
    {
        $jugadores = $this->jugadorModel->getJugadores();
        $this->utils->ordenarPorApellido($jugadores);
        $this->jugadorView->renderJugadores($jugadores);
    }
    public function mostrarJugador($idJugador)
    {
        $jugador = $this->jugadorModel->getJugador($idJugador);
        if ($jugador)
            $this->jugadorView->renderJugador($jugador);
        else
            $this->utils->redirigirPagina("jugadores", "El jugador que intenta visualizar no se encuentra en la base de datos.");
    }
    public function mostrarEditarJugador($idJugador)
    {
        $this->utils->comprobarAdministrador();
        $jugador = $this->jugadorModel->getJugador($idJugador);
        $this->jugadorView->renderEditarJugador($jugador);
    }
    public function editarJugador($idJugador)
    {
        $this->utils->comprobarAdministrador();
        if (!empty($_REQUEST['nombre']) && !empty($_REQUEST['apellido']) && !empty($_REQUEST['dni'])) {
            $dni = $_REQUEST['dni'];
            $jugador = $this->jugadorModel->getJugador(null, $dni);
            if (!$jugador || ($jugador->id_jugador == $idJugador)) {
                $nombre = $_REQUEST['nombre'];
                $apellido = $_REQUEST['apellido'];
                $tel = $_REQUEST['telefono'];
                $posicion = $_REQUEST['posicion'];
                $result = $this->jugadorModel->updateJugador($idJugador, $nombre, $apellido, $dni, $tel, $posicion);
                if ($result)
                    $this->utils->redirigirPagina('jugadores/editar/' . $idJugador, "Jugador editado correctamente.");
                else
                    $this->utils->redirigirPagina("jugadores", "Hubo un error al editar el jugador.");
            } else
                $this->utils->redirigirPagina("jugadores", "Error al editar el jugador. El DNI ingresado esta asociado a otro jugador.");
        } else
            $this->utils->redirigirPagina('jugadores/editar/' . $idJugador, "Los campos nombre, apellido y dni deben estar completos.");
    }
    public function registrarJugador()
    {
        if ($this->sesion->esAdministrador() || $this->sesion->esCapitan()) {
            if (!empty($_REQUEST['nombreJugador']) && !empty($_REQUEST['apellidoJugador']) && !empty($_REQUEST['dni'])) {
                $dni = $_REQUEST['dni'];
                $jugador = $this->jugadorModel->getJugador(null, $dni);
                if (!$jugador) {
                    $nombre = $_REQUEST['nombreJugador'];
                    $apellido = $_REQUEST['apellidoJugador'];
                    $telefono = $_REQUEST['telefono'];
                    if ($this->sesion->esCapitan())
                        $equipo = $this->sesion->getEquipo();
                    else
                        $equipo = $_REQUEST['equipo'];
                    if (!isset($_REQUEST["foto"]) || empty($_REQUEST["foto"]))
                        $foto = 'sin-foto.png';
                    else
                        $foto = $_REQUEST["foto"];
                    $posicion = $_REQUEST['posicion'];
                    $result = $this->jugadorModel->addJugador($nombre, $apellido, $dni, $posicion, $telefono, $foto, $equipo);
                    if ($result > 0) {
                        if ($this->sesion->esAdministrador())
                            $this->utils->redirigirPagina("admin", "Jugador agregado correctamente.");
                        else
                            $this->utils->redirigirPagina("miequipo", "Jugador agregado correctamente.");
                    } else {
                        $this->utils->redirigirPagina("jugadores", "Hubo un error al registrar el jugador.");
                    }
                } else {
                    if ($this->sesion->esAdministrador())
                        $this->utils->redirigirPagina("admin", "Ya existe un jugador con el DNI ingresado.");
                    else
                        $this->utils->redirigirPagina("miequipo", "Ya existe un jugador con el DNI ingresado.");
                }
            } else {
                if ($this->sesion->esAdministrador())
                    $this->utils->redirigirPagina("admin", "Los campos nombre, apellido y DNI deben estar completos.");
                else
                    $this->utils->redirigirPagina("miequipo", "Los campos nombre, apellido y DNI deben estar completos.");
            }
        } else
            $this->utils->redirigirPagina("login");
    }
    public function eliminarJugador($idJugador)
    {
        $this->utils->comprobarAdministrador();
        $jugador = $this->jugadorModel->getJugador($idJugador);
        if ($jugador) {
            $this->jugadorView->renderJugador($jugador, true);
        } else
            $this->utils->redirigirPagina("jugadores", "El jugador que intenta borrar no existe en nuestra base de datos.");
    }
    public function eliminarConfirmado($idJugador)
    {
        $this->utils->comprobarAdministrador();
        $jugador = $this->jugadorModel->getJugador($idJugador);
        if ($jugador) {
            $result = $this->jugadorModel->deleteJugador($idJugador);
            if ($result)
                $this->utils->redirigirPagina("jugadores", "El jugador ha sido borrado correctamente.");
            else
                $this->utils->redirigirPagina("jugadores", "Hubo un error al intentar borar el jugador.");
        } else
            $this->utils->redirigirPagina("jugadores", "El jugador que intenta borrar no existe en nuestra base de datos.");
    }

    public function mostrarJugadoresxEquipo($idEquipo)
    {
        $equipo = $this->equipoModel->getEquipo($idEquipo);
        if ($equipo) {
            $jugadores = $this->jugadorModel->getJugadores($idEquipo);
            $this->jugadorView->renderJugadoresXEquipo($jugadores, $equipo);
        } else
            $this->utils->redirigirPagina('equipos', "el equipo que intenta visualizar no se encuentra en la base de datos");
    }

    public function mostrarEliminarEquipo($idEquipo)
    {
        $this->utils->comprobarAdministrador();
        $equipo = $this->equipoModel->getEquipo($idEquipo);
        if ($equipo) {
            $jugadores = $this->jugadorModel->getJugadores($idEquipo);
            $this->jugadorView->renderJugadoresXEquipo($jugadores, $equipo, true);
        } else
            $this->utils->redirigirPagina('equipos', "el equipo que intenta eliminar no se encuentra en la base de datos");
    }
}
