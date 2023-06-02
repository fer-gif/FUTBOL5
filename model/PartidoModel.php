<?php
require_once 'model/Conexion.php';
class PartidoModel
{
    private $connection;

    public function __construct()
    {
        $this->connection=new Conexion();
    }

    public function getPartidos()
    {

    }

    public function getPartidoxEquipo()
    {}

    public function addPartido()
    {}

    public function deletePartido()
    {}

    public function updatePartido()
    {}



    
    public function getResultado()
    {}

    public function getGolesDeEqipo()
    {}

    public function getGolesRecibidos()
    {}

    public function getPartidoPerdido()   
    {}

    public function getPartidoGanado()
    {}

    public function getPartidoEmpatado()
    {}
    

}
