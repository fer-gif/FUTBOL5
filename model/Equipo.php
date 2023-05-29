<?php

require_once 'model/ConexionModel.php';

class Equipo
{
    private $idEquipo;
    private $nombre;
    private $jugadores;
    private $partidos_jugados;
    private $ganados;
    private $perdidos;
    private $empatados;
    private $puntos;
    private $connection;
    /*
    public function __construct($id, $nombre, $jugadores, $partidos_jugados, $pg, $pe, $pp, $gf, $gc, $puntos)
    {
        $this->idEquipo = $id;
        $this->nombre = $nombre;
        $this->jugadores = $jugadores;
        $this->partidos_jugados = $partidos_jugados;
        $this->pg = $pg;
        $this->pe = $pe;
        $this->pp = $pp;
        $this->gf = $gf;
        $this->gc = $gc;
        $this->puntos = $puntos;
    }*/
    public function __construct()
    {
        $this->connection=new Conexion();
    }


    public function getEquipo($id)
    {
        $c = $this->connection->getConnection();
        $sentence=$c->prepare("SELECT * from equipos WHERE id_equipo=$id");
        $sentence->execute();
        $sentence->fetch(PDO::FETCH_ASSOC);
        $id_equipo=$sentence->fetch();
        return $id_equipo;
    }

    public function getNombre($name)
    {
        $c = $this->connection->getConnection();
        $sentence=$c->prepare("SELECT nombre from equipos WHERE nombre=$name");
        $sentence->execute();
        $sentence->fetch(PDO::FETCH_ASSOC);
        $nombre=$sentence->fetch();
        return $nombre;
    }
    public function setNombre($nombre)
    {   
        $this->nombre = $nombre;
    }
    public function getJugadores($equipo)
    {   
        $c=$this->connection->getConnection();
        $sentence=$c->prepare("SELECT nombre, apellido
        FROM jugadores
        INNER JOIN equipos ON id_equipo = id_equipo
        WHERE nombre = $equipo");
        $sentence->execute();
        $jugadores=$sentence->fetchAll(PDO::FETCH_OBJ);
        return $jugadores;
    }
    public function setJugadores($jugadores)
    {
        $this->jugadores = $jugadores;
    }
    public function getPartidos_jugados()
    {
        return $this->partidos_jugados;
    }
    public function setPartidos_jugados($partidos_jugados)
    {
        $this->partidos_jugados = $partidos_jugados;
    }
    public function getPG()
    {
        return $this->ganados;
    }
    public function setPG($ganados)
    {
        $this->ganados = $ganados;
    }
    public function getPE()
    {
        return $this->empatados;
    }
    public function setPE($empatados)
    {
        $this->empatados = $empatados;
    }
    public function getPP()
    {
        return $this->perdidos;
    }
    public function setPP($perdidos)
    {
        $this->perdidos = $perdidos;
    }
    public function getGF()
    {
        return $this->gf;
    }
    public function setGF($gf)
    {
        $this->gf = $gf;
    }
    public function getGC()
    {
        return $this->gc;
    }
    public function setGC($gc)
    {
        $this->gc = $gc;
    }
    public function getPuntos()
    {
        return $this->puntos;
    }
    public function setPuntos($puntos)
    {
        $this->puntos = $puntos;
    }
    public function registrarPartido($puntos, $gf, $gc)
    {
        if ($puntos === 3) {
            $this->ganados += 1;
        } elseif ($puntos === 1) {
            $this->empatados += 1;
        } elseif ($puntos === 0) {
            $this->perdidos += 1;
        }
        $this->partidos_jugados += 1;
        $this->puntos += $puntos;
        $this->gf = $gf;
        $this->gc = $gc;
    }
    public function addJugador($jugador)
    {
        array_push($this->jugadores, $jugador);
    }
}
