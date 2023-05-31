<?php

require_once 'model/ConexionModel.php';

class Equipo
{
    private $id_equipo;
    private $nombre;
    private $jugadores;
    private $puntos;
    private $partidos_jugados;
    private $connection;
    private $ganados;
    private $empatados;
    private $perdidos;
    private $gc;
    private $gf;



    public function __construct($id, $nombre)
    {
        $this->id_equipo = $id;
        $this->nombre = $nombre;
        $this->connection = new Conexion();
    }



    public function getIdEquipo()
    {
        return $this->id_equipo;
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getJugadores()
    {
        return $this->jugadores;
    }

    public function setJugadores($jugadores)
    {
        $this->jugadores = $jugadores;
    }

    public function getPartidos_jugados()
    {
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
