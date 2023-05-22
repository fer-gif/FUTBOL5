<?php

class Equipo
{
    private $idEquipo;
    private $nombre;
    private $jugadores;
    private $pj;
    private $pg;
    private $pe;
    private $pp;
    private $gf;
    private $gc;
    private $puntos;

    public function __construct($id, $nombre, $jugadores, $pj, $pg, $pe, $pp, $gf, $gc, $puntos)
    {
        $this->idEquipo = $id;
        $this->nombre = $nombre;
        $this->jugadores = $jugadores;
        $this->pj = $pj;
        $this->pg = $pg;
        $this->pe = $pe;
        $this->pp = $pp;
        $this->gf = $gf;
        $this->gc = $gc;
        $this->puntos = $puntos;
    }

    public function getIdEquipo()
    {
        return $this->idEquipo;
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
    public function getPJ()
    {
        return $this->pj;
    }
    public function setPJ($pj)
    {
        $this->pj = $pj;
    }
    public function getPG()
    {
        return $this->pg;
    }
    public function setPG($pg)
    {
        $this->pg = $pg;
    }
    public function getPE()
    {
        return $this->pe;
    }
    public function setPE($pe)
    {
        $this->pe = $pe;
    }
    public function getPP()
    {
        return $this->pp;
    }
    public function setPP($pp)
    {
        $this->pp = $pp;
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
            $this->pg += 1;
        } elseif ($puntos === 1) {
            $this->pe += 1;
        } elseif ($puntos === 0) {
            $this->pp += 1;
        }
        $this->pj += 1;
        $this->puntos += $puntos;
        $this->gf = $gf;
        $this->gc = $gc;
    }
    public function addJugador($jugador)
    {
        array_push($this->jugadores, $jugador);
    }
}
