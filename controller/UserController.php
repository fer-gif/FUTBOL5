<?php
require_once 'model/UserModel.php';
require_once 'model/SesionHelper.php';
require_once 'view/UserView.php';
class UserController
{
    private $userModel;
    private $userView;
    private $sesion;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userView = new UserView();
        $this->sesion = new SesionHelper();
    }

    public function registrarUsuario()
    {
        if ($this->sesion->esAdministrador())
            if (!empty($_REQUEST["nombreUsuario"]) && !empty($_REQUEST["password"])) {
                $nombreUsuario = $_REQUEST["nombreUsuario"];
                $password = $_REQUEST["password"];
                $email = $_REQUEST["email"];
                $permisos = $_REQUEST["permisos"];
                if ($permisos > 0) {
                    if ($permisos == 3)
                        $equipo = $_REQUEST["equipo"];
                    else
                        $equipo = null;
                    $result = $this->userModel->addUsuario($nombreUsuario, $password, $email, $permisos, $equipo);
                    if ($result > 0)
                        print("Insertado COrrectamente");
                    else
                        print("ERROR");
                } else
                    print("DEBE SELECCIONAR UN TIPO DE USUARIO");
            } else
                print("DEBE INGRESAR USUARIO Y CONTRASEÑA");
        else
            header('Location: ' . BASE_URL . '/login');
    }

    public function eliminarUsuario($idUsuario)
    {
    }

    public function actualizarUsuario($idUsuario)
    {
    }

    public function obtenerUsuario($idUsuario)
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
                $sesion->setSesion($result->id_usuario, $result->usuario, $result->permisos, $result->nombre_equipo);
                header('Location: ' . BASE_URL . '/home');
            } else {
                $this->sesion->setMensajeError("Usuario o contraseña incorrecto.");
                header('Location: ' . BASE_URL . '/login');
                exit();
            }
        } else {
            $this->sesion->setMensajeError("Debe ingresar usuario y contraseña.");
            header('Location: ' . BASE_URL . '/login');
            exit();
        }
    }
    public function logout()
    {
        $this->sesion->destruirSesion();
        header('Location: ' . BASE_URL . '/login');
    }
    public function mostrarGestionAdmin()
    {
        if ($this->sesion->esAdministrador())
            $this->userView->cargarGestionAdmin();
        else
            header('Location: ' . BASE_URL . '/login');
    }
}
