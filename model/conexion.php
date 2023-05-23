<?php

class Conexion
{
    private $host = "localhost";
    private $db = "dbw_casadelimpieza";
    private $user = "root";
    private $pass = "";
    private $conexion;

    public function __construct()
    {
        try {
            $this->conexion = new PDO("mysql:host=" . $this->host . "; dbname=" . $this->db . "; charset=utf8", $this->user, $this->pass);
        } catch (PDOException $e) {
           /* $this->conexion = null;*/
        }
        /*return $this->conexion;*/
    }

    public function getConnection()
    {
        return $this->conexion;
    }

    public function dissconect()
    {
        $this->conexion=null;
    }
}
?>