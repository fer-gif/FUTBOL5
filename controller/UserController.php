<?php
require_once 'view/TorneoView.php';
require_once 'model/UserModel.php';
require_once 'model/AuthHelper.php';

class UserController
{

    private $torneoView;
    private $userModel;

    public function __construct()
    {
        $this->torneoView = new TorneoView();
        $this->userModel = new UserModel();
    }
    public function mostrarLogin()
    {
        $this->torneoView->renderIngresoLogin();
    }
    public function registrarUsuario()
    {
        if (!empty($_REQUEST["nombreUsuario"]) && !empty($_REQUEST["password"])) {
            $nombreUsuario = $_REQUEST["nombreUsuario"];
            $password = password_hash($_REQUEST["password"], PASSWORD_BCRYPT);
            $email = $_REQUEST["email"];
            $permisos = $_REQUEST["permisos"];
            if ($permisos > 0) {
                if ($permisos == 3)
                    $equipo = $_REQUEST["equipo"];
                else
                    $equipo = null;
                if (!empty($email)) {
                    $key = 'emailEncriptado';
                    $email = openssl_encrypt($email, 'AES-128-ECB', $key);
                }
                $result = $this->userModel->addUsuario($nombreUsuario, $password, $email, $permisos, $equipo);
                if ($result > 0)
                    print("Insertado COrrectamente");
                else
                    print("ERROR");
            } else
                print("DEBE SELECCIONAR UN TIPO DE USUARIO");
        } else
            print("DEBE INGRESAR USUARIO Y CONTRASEÑA");

        die();
    }
    public function procesarLogin()
    {
        if (!empty($_REQUEST["nombreUsuario"]) && !empty($_REQUEST["password"])) {
            $nombreUsuario = $_REQUEST["nombreUsuario"];
            $password = $_REQUEST["password"];
            $result = $this->userModel->comprobarUsuario($nombreUsuario, $password);
            if ($result != null) {
                $sesion = new AuthHelper();
                $sesion->setLogeo($result);
                header('Location: ' . BASE_URL . '/home');
            }
        }
    }
}
