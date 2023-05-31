<?php
require_once 'model/ConexionModel.php';
require_once 'Usuario.php';
class UserModel
{
    private $connection;

    public function __construct()
    {
        $this->connection = new Conexion();
    }

    public function addUsuario($nombre, $pass, $email, $permisos, $id_equipo)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("INSERT INTO usuarios(nombre,email,password,permisos,id_equipo)
                                        VALUES (?,?,?,?,?)");
        $password = password_hash($pass, PASSWORD_BCRYPT);
        $sentence->execute(array($nombre, $email, $password, $permisos, $id_equipo));
        $lastId = $conexion->lastInsertId();
        $conexion = null;
        return $lastId;
    }
    public function comprobarUsuario($usuario, $pass)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("SELECT * FROM usuarios WHERE usuarios.nombre = :nombre");
        $sentence->bindParam(":nombre", $usuario);
        $sentence->execute();
        $result = $sentence->fetch(PDO::FETCH_OBJ);

        if ($result && password_verify($pass, $result->password)) {
            $usuario = new Usuario($result->nombre, $result->permisos, $result->id_equipo);
        } else
            $usuario = null;
        return $usuario;
    }
}
