<?php

class JugadorModel
{




    public function getJugadores($idEquipo)
    {
        $conexion=$this->connection->getConnection();
        $sentence = $conexion->prepare("SELECT * FROM jugadores j 
                                        INNER JOIN equipos e
                                        ON j.id_equipo=e.id_equipo
                                        WHERE e.id_equipo=?");
        $sentence->execute(array($idEquipo));

        $sentence->setFetchMode(PDO::FETCH_ASSOC);
        $jugadores = $sentence->fetchAll();
        
        return $jugadores;
    }
}
