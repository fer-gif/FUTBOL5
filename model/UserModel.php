<?php
require_once 'Conexion.php';
class UserModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function addUsuario($usuario, $pass, $email, $permisos, $id_equipo)
    {
        $con = $this->conexion->getConnection();
        $sentence = $con->prepare("INSERT INTO usuarios(usuario,password,email,permisos,id_equipo) VALUE (?,?,?,?,?)");
        $sentence->execute(array($usuario, $pass, $email, $permisos, $id_equipo));
        //$lastId=$con->lastInsertId();
    }

    public function getUsuario($nombre)
    {
        $con = $this->conexion->getConnection();
        $sentence = $con->prepare("SELECT * FROM usuarios WHERE usuarios.usuario = :usuario");
        $sentence->bindParam(":usuario", $nombre);
        $sentence->execute();
        $result = $sentence->fetch(PDO::FETCH_OBJ);
        return $result;
    }
}
