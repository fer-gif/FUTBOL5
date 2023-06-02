<?php
require_once 'Conexion.php';
class UserModel
{
    private $key = 'emailEncriptado';
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function addUsuario($usuario, $pass, $email, $permisos, $id_equipo)
    {
        $con = $this->conexion->getConnection();
        $sentence = $con->prepare("INSERT INTO usuarios(usuario,password,email,permisos,id_equipo) VALUE (?,?,?,?,?)");
        $password = password_hash($pass, PASSWORD_BCRYPT);
        /* if (!empty($email)) {
            $email = openssl_encrypt($email, 'AES-128-ECB', $this->key);
        }*/
        $sentence->execute(array($usuario, $password, $email, $permisos, $id_equipo));
        //$lastId=$con->lastInsertId();
    }

    public function getUsuario($nombre)
    {
        $con = $this->conexion->getConnection();
        $sentence = $con->prepare("SELECT nombre,email,permisos,id_equipo FROM usuarios WHERE usuarios.usuario = :usuario");
        $sentence->bindParam(":usuario", $nombre);
        $sentence->execute();
        $result = $sentence->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function eliminarUsuario($idUsuario)
    {
    }

    public function actualizarUsuario($idUsuario, $email, $permisos)
    {
    }

    public function comprobarUsuario($usuario, $pass)
    {
        $con = $this->conexion->getConnection();
        $sentence = $con->prepare("SELECT u.id_usuario, u.usuario, u.password, u.permisos, e.nombre AS nombre_equipo FROM usuarios u 
                                        LEFT JOIN equipos e ON u.id_equipo = e.id_equipo
                                        WHERE u.usuario = :nombre");
        $sentence->bindParam(":nombre", $usuario);
        $sentence->execute();
        $result = $sentence->fetch(PDO::FETCH_OBJ);
        if ($result && password_verify($pass, $result->password)) {
            unset($result->password);
            return $result;
        } else
            return null;
    }
}
