<?php
require_once 'Conexion.php';
class UserModel
{
    private $conexion;

    public function __construct()
    {
        try {
            $this->conexion = new Conexion();
        } catch (PDOException $e) {
            throw new Exception($e);
        }
    }

    public function addUsuario($usuario, $pass, $email, $permisos, $id_equipo)
    {
        $con = $this->conexion->getConnection();
        $sentence = $con->prepare("INSERT INTO usuarios(usuario,password,email,permisos,id_equipo) VALUE (?,?,?,?,?)");
        $password = password_hash($pass, PASSWORD_BCRYPT);
        $sentence->execute(array($usuario, $password, $email, $permisos, $id_equipo));
        $lastId = $con->lastInsertId();
        $con = null;
        return $lastId;
    }

    public function getUsuarios()
    {
        $con = $this->conexion->getConnection();
        $sentence = $con->prepare("SELECT u.id_usuario, u.usuario, e.nombre AS nombre_equipo FROM usuarios u
                                   LEFT JOIN equipos e ON u.id_equipo = e.id_equipo");
        $sentence->execute();
        $result = $sentence->fetchAll(PDO::FETCH_OBJ);
        $con = null;
        return $result;
    }
    public function getUsuario($nombre = null, $idUsuario = null)
    {
        $con = $this->conexion->getConnection();
        if (isset($nombre)) {
            $sentence = $con->prepare("SELECT u.id_usuario, u.usuario, u.email, u.permisos, u.id_equipo, e.nombre AS nombre_equipo
                                        FROM usuarios u 
                                        LEFT JOIN equipos e ON e.id_equipo = u.id_equipo 
                                        WHERE u.usuario = :usuario");
            $sentence->bindParam(":usuario", $nombre);
        } elseif (isset($idUsuario)) {
            $sentence = $con->prepare("SELECT u.id_usuario, u.usuario, u.email, u.permisos, u.id_equipo, e.nombre AS nombre_equipo
                                        FROM usuarios u 
                                        LEFT JOIN equipos e ON e.id_equipo = u.id_equipo 
                                        WHERE u.id_usuario = :idUsuario");
            $sentence->bindParam(":idUsuario", $idUsuario);
        } else {
            return null;
            exit();
        }
        $sentence->execute();
        $result = $sentence->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function getUsuarioxEquipo($idEquipo)
    {
        $con = $this->conexion->getConnection();

        $sentence = $con->prepare("SELECT u.id_usuario, u.usuario, u.email, u.permisos, u.id_equipo
                                        FROM usuarios u  
                                        WHERE u.id_equipo = :idEquipo");
        $sentence->bindParam(":idEquipo", $idEquipo);

        $sentence->execute();
        $result = $sentence->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function deleteUsuario($idUsuario)
    {
        $con = $this->conexion->getConnection();
        $sentence = $con->prepare("DELETE FROM usuarios WHERE id_usuario=?");
        $response = $sentence->execute(array($idUsuario));
        $con = null;

        return $response;
    }

    public function updateUsuario($idUsuario, $usuario, $email)
    {
        $con = $this->conexion->getConnection();
        $sentence = $con->prepare("UPDATE usuarios
                                    SET usuario = :usuario , email=:email 
                                    WHERE id_usuario = :idUsuario");
        $sentence->bindParam(":usuario", $usuario);
        $sentence->bindParam(":email", $email);
        $sentence->bindParam(":idUsuario", $idUsuario);
        $response = $sentence->execute();
        $con = null;

        return $response;
    }

    public function comprobarUsuario($usuario, $pass)
    {
        $con = $this->conexion->getConnection();
        $sentence = $con->prepare("SELECT u.id_usuario, u.usuario, u.password, u.permisos, e.id_equipo, e.nombre AS nombre_equipo FROM usuarios u 
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
