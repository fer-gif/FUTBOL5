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
        $this->utils->comprobarAdministrador();

        if (empty($_REQUEST["nombreUsuario"]) || empty($_REQUEST["password"]))
            $this->utils->redirigirPagina('admin', "El campo Usuario y Contraseña son obligatorios para registrar un usuario.");

        $nombreUsuario = $_REQUEST["nombreUsuario"];
        $user = $this->userModel->getUsuario($nombreUsuario);
        if ($user)
            $this->utils->redirigirPagina('admin', "Nombre incorrecto. Ya existe ese usuario en la base de datos.");

        $password = $_REQUEST["password"];
        $passwordRep = $_REQUEST["passwordRep"];
        if ($password != $passwordRep)
            $this->utils->redirigirPagina("admin", "Los password ingresado no coinciden.");

        $email = $_REQUEST["email"];
        $permisos = $_REQUEST["permisos"];
        if ($permisos < 1)
            $this->utils->redirigirPagina('admin', "Debe seleccionar un tipo de usuario.");
        else {
            if ($permisos == 3) {
                $equipo = $_REQUEST["equipo"];
                if ($equipo < 1)
                    $this->utils->redirigirPagina('admin', "Para un usuario capitan debe seleccionar un equipo.");
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
        }
    }

    public function mostrarUsuario($idUsuario)
    {
        $this->utils->comprobarAdministrador();
        $usuario = $this->userModel->getUsuario(null, $idUsuario);
        if ($usuario) {
            $this->userView->renderUsuario($usuario);
        } else
            $this->utils->redirigirPagina("admin", "El usuario que intenta visualizar no existe en la base de datos.");
    }

    public function mostrarEliminarUser($idUsuario)
    {
        $this->utils->comprobarAdministrador();
        $user = $this->userModel->getUsuario(null, $idUsuario);
        if ($user) {
            $this->userView->renderUsuario($user, true);
        } else
            $this->utils->redirigirPagina('admin', "El usuario que intenta eliminar no se encuentra en la base de datos");
    }

    public function eliminarUsuario($idUsuario)
    {
        $this->utils->comprobarAdministrador();
        $usuario = $this->userModel->getUsuario(null, $idUsuario);
        if ($usuario) {
            $result = $this->userModel->deleteUsuario($idUsuario);
            if ($result)
                $this->utils->redirigirPagina("admin", "El usuario ha sido borrado correctamente.");
            else
                $this->utils->redirigirPagina("admin", "Hubo un error al intentar borrar el usuario.");
        } else
            $this->utils->redirigirPagina("admin", "El usuario que intenta borrar no existe en nuestra base de datos.");
    }

    public function mostrarEditarUsuario($idUsuario)
    {
        $this->utils->comprobarAdministrador();
        $usuario = $this->userModel->getUsuario(null, $idUsuario);
        if ($usuario) {
            $this->userView->renderEditarUsuario($usuario);
        } else
            $this->utils->redirigirPagina("admin", "El usuario que intenta editar no existe en la base de datos.");
    }

    public function updateUsuario($idUsuario)
    {
        $this->utils->comprobarAdministrador();
        if (empty($_REQUEST["usuario"]))
            $this->utils->redirigirPagina('usuario/editar/' . $idUsuario, "El campo Usuario es obligatorio para editar un usuario.");
        $nombreUsuario = $_REQUEST["usuario"];
        $user = $this->userModel->getUsuario($nombreUsuario);
        if (!$user || $user->id_usuario == $idUsuario) {
            $email = $_REQUEST["email"];
            $result = $this->userModel->updateUsuario($idUsuario, $nombreUsuario, $email);
            if ($result > 0)
                $this->utils->redirigirPagina('admin', "Usuario editado correctamente.");
            else
                $this->utils->redirigirPagina('admin', "Hubo un error al intentar editar el usuario.");
        } else
            $this->utils->redirigirPagina('usuario/editar/' . $idUsuario, "Ya existe un usuario con ese nombre en la base de datos.");
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
        $this->utils->comprobarAdministrador();
        $equipos = $this->equipoModel->getEquipos();
        $usuarios = $this->userModel->getUsuarios();
        $this->userView->cargarGestionAdmin($equipos, $usuarios);
    }

    public function mostrarMiEquipo()
    {
        $this->utils->comprobarCapitan();
        $equipo = $this->equipoModel->getEquipo($this->sesion->getEquipo());
        $jugadores = $this->jugadorModel->getJugadores($this->sesion->getEquipo());
        $this->utils->ordenarPorApellido($jugadores);
        $this->userView->renderMiEquipo($equipo, $jugadores);
    }

    public function paginaNoExiste()
    {
        $this->userView->renderNoExiste();
    }
}
