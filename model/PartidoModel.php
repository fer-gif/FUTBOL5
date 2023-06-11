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
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("SELECT * FROM partidos");
        $sentence->execute();

        $sentence->setFetchMode(PDO::FETCH_ASSOC);
        $partidos = $sentence->fetchAll();

        return $partidos;
    }

    public function getPartido($idPartido)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("SELECT * FROM partidos WHERE id_partiddo=?");
        $sentence->execute(array($idPartido));
        $sentence->setFetchMode(PDO::FETCH_ASSOC);
        $partido = $sentence->fetchAll();

        return $partido;
    }

    public function getCruceDePartido($id_equipo1,$id_equipo2){
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("SELECT COUNT(*) 
                                    FROM partidos
                                    WHERE ((id_equipo1 = :idEquipo1 AND id_equipo2 = :idEquipo2)
                                    OR (id_equipo1 = :idEquipo2 AND id_equipo2 = :idEquipo1))");
        $sentence->execute(array($id_equipo1,$id_equipo2));

        $sentence->setFetchMode(PDO::FETCH_ASSOC);
        $partidos = $sentence->fetchAll();

        return $partidos;
    }

   
    public function addPartido($id_equipo1,$id_equipo2,$golesEquipo1,$golesEquipo2,$fecha)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("INSERT INTO partidos(id_equipo1,id_equip2,goles_equipo1,goles_equipo2,fecha) VALUES(?,?,?,?,?)");
        $sentence->execute(array($id_equipo1,$id_equipo2,$golesEquipo1,$golesEquipo2,$fecha));
        $lastId = $conexion->lastInsertId();
        $conexion = null;
        return $lastId;
    }

    public function deletePartido($id_partido)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("DELETE FROM partidos WHERE id_partido=?");
        $response = $sentence->execute(array($id_partido));
        $conexion = null;

        return $response;
    }

    public function updatePartido($id_equipo1,$id_equipo2,$golesEquipo1,$golesEquipo2,$fecha)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("UPDATE equipos
                                    SET id_equipo1 = ?, id_equipo2=?,goles_equipo1=?,goles_equipo2=?,fecha=?
                                    WHERE id_equipo = ?");
        $response = $sentence->execute(array($id_equipo1,$id_equipo2,$golesEquipo1,$golesEquipo2,$fecha));
        $conexion = null;

        return $response;
    }



    
    public function getPuntos($id_equipo)
    {
        $conexion=$this->connection->getConnection();
        $consultaGanados=$conexion->prepare("SELECT COUNT(*) 
        FROM partidos
        WHERE (id_equipo1 = :idEquipo AND goles_equipo1 > goles_equipo2)
        OR (id_equipo2 = :idEquipo AND goles_equipo2 > goles_equipo1)");
        $consultaGanados->bindParam(':idEquipo',$id_equipo);
        $consultaGanados->execute();
        $partidosGanados=$consultaGanados->fetch(PDO::FETCH_ASSOC);

        $consultaEmpatados = $conexion->prepare("SELECT COUNT(*) 
        FROM partidos
        WHERE (id_equipo1 = :idEquipo AND goles_equipo1 = goles_equipo2)
        OR (id_equipo2 = :idEquipo AND goles_equipo2 = goles_equipo1)");
        $consultaEmpatados->bindParam(':idEquipo1',$id_equipo);
        $consultaEmpatados->execute();
        $partidosEmpatados=$consultaEmpatados->fetch(PDO::FETCH_ASSOC);

        $puntos=($partidosGanados*3)+$partidosEmpatados;

        return $puntos;
    }

    public function getGolesDeEqipo($id_equipo)
    {
        $conexion=$this->connection->getConnection();
        $response=$conexion->prepare("SELECT SUM(goles_equipo1) 
        FROM partidos
        WHERE id_equipo1 = :idEquipo
        UNION ALL
        SELECT SUM(goles_equipo2) 
        FROM partidos
        WHERE id_equipo2 = :idEquipo");

        $response->bindParam(':idEquipo',$id_equipo);
        $response->execute();
        $golesConvertidos=$response->fetch(PDO::FETCH_ASSOC);
        $conexion=null;

        return $golesConvertidos;

    }

    public function getGolesRecibidos($id_equipo)
    {
        $conexion=$this->connection->getConnection();
        $response=$conexion->prepare("SELECT SUM(goles_equipo2) 
                            FROM partidos
                            WHERE id_equipo1 = :idEquipo
                            UNION ALL
                            SELECT SUM(goles_equipo1) 
                            FROM partidos
                            WHERE id_equipo2 = :idEquipo");

        $response->bindParam(':idEquipo',$id_equipo);
        $response->execute();
        $golesRecibidos=$response->fetch(PDO::FETCH_ASSOC);
        $conexion=null;

        return $golesRecibidos;
        

    }

    public function getPartidoPerdidos($id_equipo)
    {
        $conexion=$this->connection->getConnection();
        $response=$conexion->prepare("SELECT COUNT(*) 
                        FROM partidos
                        WHERE (id_equipo1 = :idEquipo AND goles_equipo1 < goles_equipo2)
                         OR (id_equipo2 = :idEquipo AND goles_equipo2 < goles_equipo1)");

        $response->bindParam(':idEquipo',$id_equipo);
        $response->execute();

        $partidosPerdidos = $response->fetch(PDO::FETCH_ASSOC);
        $conexion = null;
                    
        return $partidosPerdidos;
        
    }
    public function getPartidoJugados($id_equipo)   
    {
        $conexion=$this->connection->getConnection();
        $response=$conexion->prepare("SELECT COUNT(*) 
                            FROM partidos
                            WHERE id_equipo1 = :idEquipo OR id_equipo2 = :idEquipo");
        $response->bindParam(':idEquipo',$id_equipo);
        $response->execute();
 
        $partidosJugados = $response->fetch(PDO::FETCH_ASSOC);
        $conexion = null;
                    
        return $partidosJugados;
        
    }


    public function getPartidoGanado($id_equipo)
    {
        $conexion=$this->connection->getConnection();
        $response=$conexion->prepare("SELECT COUNT(*) 
                        FROM partidos
                        WHERE (id_equipo1 = :idEquipo AND goles_equipo1 > goles_equipo2)
                         OR (id_equipo2 = :idEquipo AND goles_equipo2 > goles_equipo1)");
        $response->bindParam(':idEquipo',$id_equipo);
        $response->execute();
        $partidosGanados = $response->fetch(PDO::FETCH_ASSOC);
       
        $conexion = null;
                    
        return $partidosGanados;
    }

    public function getPartidoEmpatado($id_equipo)
    {
        $conexion=$this->connection->getConnection();
        $response=$conexion->prepare("SELECT COUNT(*) 
                        FROM partidos
                        WHERE (id_equipo1 = :idEquipo AND goles_equipo1 = goles_equipo2)
                         OR (id_equipo2 =  AND goles_equipo2 = goles_equipo1)");
       $response->bindParam(':idEquipo',$id_equipo);
       $response->execute();

       $partidosEmpatados = $response->fetch(PDO::FETCH_ASSOC);
        $conexion = null;
                    
        return $partidosEmpatados;
    }
    

}
