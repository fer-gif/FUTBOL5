<?php

class Conexion
{
    private $host = "localhost";
    private $db = "db_appfutbol5";
    private $user = "root";
    private $pass = "";
    private $conexion;

    public function __construct()
    {
        try {
            $this->conexion = new PDO("mysql:host=" . $this->host . "; dbname=" . $this->db . "; charset=utf8", $this->user, $this->pass);
        } catch (PDOException $e) {
            throw new Exception($e);
        }
    }

    public function getConnection()
    {
        return $this->conexion;
    }

    public function dissconect()
    {
        $this->conexion = null;
    }
}
