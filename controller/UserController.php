<?php
require_once 'model/UserModel.php';
require_once 'model/SesionHelper.php';
require_once 'view/UserView.php';
require_once 'model/EquipoModel.php';
require_once 'model/JugadorModel.php';
require_once 'model/Utils.php';
class UserController
{
    private $userModel;
    private $userView;
    private $sesion;
    private $equipoModel;
    private $utils;
    private $jugadorModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userView = new UserView();
        $this->sesion = new SesionHelper();
        $this->equipoModel = new EquipoModel();
        $this->utils = new Utils();
        $this->jugadorModel = new JugadorModel();
    }

    public function registrarUsuario()
    {
        if ($this->sesion->esAdministrador())
            if (!empty($_REQUEST["nombreUsuario"]) && !empty($_REQUEST["password"])) {
                $nombreUsuario = $_REQUEST["nombreUsuario"];
                $user = $this->userModel->getUsuario($nombreUsuario);
                if (!$user) {
                    $password = $_REQUEST["password"];
                    $email = $_REQUEST["email"];
                    $permisos = $_REQUEST["permisos"];
                    if ($permisos > 0) {
                        if ($permisos == 3) {
                            $equipo = $_REQUEST["equipo"];
                            $user = $this->userModel->getUsuarioxEquipo($equipo);
                            if ($user)
                                $this->utils->redirigirPagina('admin', "Solo puede haber una cuenta para cada equipo (Capitan).");
                        } else
                            $equipo = null;
                        $result = $this->userModel->addUsuario($nombreUsuario, $password, $email, $permisos, $equipo);
                        if ($result > 0)
                            $this->utils->redirigirPagina('admin', "Usuario agregado correctamente.");
                        else
                            $this->utils->redirigirPagina('admin', "Hubo un error al intentar registrar el usuario.");
                    } else
                        $this->utils->redirigirPagina('admin', "Debe seleccionar un tipo de usuario.");
                } else
                    $this->utils->redirigirPagina('admin', "Nombre incorrecto. Ya existe ese usuario en la base de datos.");
            } else
                $this->utils->redirigirPagina('admin', "El campo Usuario y Contraseña son obligatorios para registrar un usuario.");
        else
            $this->utils->redirigirPagina('login');
    }

    public function mostrarUsuario($idUsuario)
    {
        if ($this->sesion->esAdministrador()) {
            $usuario = $this->userModel->getUsuario(null, $idUsuario);
            if ($usuario) {
                $this->userView->renderUsuario($usuario);
            } else
                $this->utils->redirigirPagina("admin", "El usuario que intenta visualizar no existe en la base de datos.");
        } else
            $this->utils->redirigirPagina("login");
    }

    public function mostrarEliminarUser($idUsuario)
    {
        if ($this->sesion->esAdministrador()) {
            $user = $this->userModel->getUsuario(null, $idUsuario);
            if ($user) {
                $this->userView->renderUsuario($user, true);
            } else
                $this->utils->redirigirPagina('admin', "El usuario que intenta eliminar no se encuentra en la base de datos");
        } else
            $this->utils->redirigirPagina("login");
    }

    public function eliminarUsuario($idUsuario)
    {
        if ($this->sesion->esAdministrador()) {
            $usuario = $this->userModel->getUsuario(null, $idUsuario);
            if ($usuario) {
                $result = $this->userModel->deleteUsuario($idUsuario);
                if ($result)
                    $this->utils->redirigirPagina("admin", "El usuario ha sido borrado correctamente.");
                else
                    $this->utils->redirigirPagina("admin", "Hubo un error al intentar borrar el usuario.");
            } else
                $this->utils->redirigirPagina("admin", "El usuario que intenta borrar no existe en nuestra base de datos.");
        } else
            $this->utils->redirigirPagina("login");
    }

    public function mostrarEditarUsuario($idUsuario)
    {
        if ($this->sesion->esAdministrador()) {
            $usuario = $this->userModel->getUsuario(null, $idUsuario);
            if ($usuario) {
                $equipos = $this->equipoModel->getEquipos();
                $this->userView->renderEditarUsuario($usuario, $equipos);
            } else
                $this->utils->redirigirPagina("admin", "El usuario que intenta editar no existe en la base de datos.");
        } else
            $this->utils->redirigirPagina("login");
    }

    public function updateUsuario($idUsuario)
    {
    }

    public function mostrarLogin()
    {
        $this->userView->cargarLogin();
    }

    public function procesarLogin()
    {
        if (!empty($_REQUEST["nombreUsuario"]) && !empty($_REQUEST["password"])) {
            $nombreUsuario = $_REQUEST["nombreUsuario"];
            $password = $_REQUEST["password"];
            $result = $this->userModel->comprobarUsuario($nombreUsuario, $password);
            if ($result != null) {
                $sesion = new SesionHelper();
                $sesion->setSesion($result->id_usuario, $result->usuario, $result->permisos, $result->id_equipo);
                $this->utils->redirigirPagina("home");
            } else {
                $this->utils->redirigirPagina('login', "Usuario o contraseña incorrecto.");
            }
        } else {
            $this->utils->redirigirPagina('login', "Debe ingresar usuario y contraseña.");
        }
    }

    public function logout()
    {
        $this->sesion->destruirSesion();
        $this->utils->redirigirPagina('login', "Gracias por todo. Vuelva prontos!!");
    }

    public function mostrarGestionAdmin()
    {
        if ($this->sesion->esAdministrador()) {
            $equipos = $this->equipoModel->getEquipos();
            $usuarios = $this->userModel->getUsuarios();
            $this->userView->cargarGestionAdmin($equipos, $usuarios);
        } else
            $this->utils->redirigirPagina('login');
    }

    public function mostrarMiEquipo()
    {
        if ($this->sesion->esCapitan()) {
            $equipo = $this->equipoModel->getEquipo($this->sesion->getEquipo());
            $jugadores = $this->jugadorModel->getJugadores($this->sesion->getEquipo());
            $this->utils->ordenarPorApellido($jugadores);
            $this->userView->renderMiEquipo($equipo, $jugadores);
        } else
            $this->utils->redirigirPagina("login");
    }

    public function paginaNoExiste()
    {
        $this->userView->renderNoExiste();
    }
}
