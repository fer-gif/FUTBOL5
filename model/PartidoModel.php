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



    
    public function getResultado($id_partido)
    {    }

    public function getGolesDeEqipo($id_equipo)
    {
        $conexion=$this->connection->getConnection();
        $conexion->prepare("SELECT SUM(goles_equipo1) 
        FROM partidos
        WHERE id_equipo1 = :idEquipo
        UNION ALL
        SELECT SUM(goles_equipo2) 
        FROM partidos
        WHERE id_equipo2 = :idEquipo");

        $conexion->brindParam(':idEquipo',$id_equipo);
        $conexion->execute();
        $golesConvertidos=$conexion->fetch(PDO::FETCH_ASSOC);
        $conexion=null;

        return $golesConvertidos;

    }

    public function getGolesRecibidos($id_equipo)
    {
        $conexion=$this->connection->getConnection();
        $conexion->prepare("SELECT SUM(goles_equipo2) 
                            FROM partidos
                            WHERE id_equipo1 = :idEquipo
                            UNION ALL
                            SELECT SUM(goles_equipo1) 
                            FROM partidos
                            WHERE id_equipo2 = :idEquipo");

        $conexion->brindParam(':idEquipo',$id_equipo);
        $conexion->execute();
        $golesRecibidos=$conexion->fetch(PDO::FETCH_ASSOC);
        $conexion=null;

        return $golesRecibidos;
        

    }

    public function getPartidoPerdidos($id_equipo)
    {
        $conexion=$this->connection->getConnection();
        $conexion->prepare("SELECT COUNT(*) 
                        FROM partidos
                        WHERE (id_equipo1 = :idEquipo AND goles_equipo1 < goles_equipo2)
                         OR (id_equipo2 = :idEquipo AND goles_equipo2 < goles_equipo1)");
        $conexion->brindParam(':idEquipo',$id_equipo);
        $conexion->execute();

        $partidosPerdidos = $conexion->fetch(PDO::FETCH_ASSOC);
        $conexion = null;
                    
        return $partidosPerdidos;
        
    }
    public function getPartidoJugados($id_equipo)   
    {
        $conexion=$this->connection->getConnection();ç
        $conexion->prepare("SELECT COUNT(*) 
                            FROM partidos
                            WHERE id_equipo1 = :idEquipo OR id_equipo2 = :idEquipo");
         $conexion->brindParam(':idEquipo',$id_equipo);
         $conexion->execute();
 
         $partidosJugados = $conexion->fetch(PDO::FETCH_ASSOC);
        $conexion = null;
                    
        return $partidosJugados;
        
    }


    public function getPartidoGanado($id_equipo)
    {
        $conexion=$this->connection->getConnection();
        $conexion->prepare("SELECT COUNT(*) 
                        FROM partidos
                        WHERE (id_equipo1 = :idEquipo AND goles_equipo1 > goles_equipo2)
                         OR (id_equipo2 = :idEquipo AND goles_equipo2 > goles_equipo1)");
        $conexion->brindParam(':idEquipo',$id_equipo);
        $conexion->execute();
        $partidosGanados = $conexion->fetch(PDO::FETCH_ASSOC);
       
        $conexion = null;
                    
        return $partidosGanados;
    }

    public function getPartidoEmpatado($id_equipo)
    {
        $conexion=$this->connection->getConnection();
        $conexion->prepare("SELECT COUNT(*) 
                        FROM partidos
                        WHERE (id_equipo1 = :idEquipo AND goles_equipo1 = goles_equipo2)
                         OR (id_equipo2 =  AND goles_equipo2 = goles_equipo1)");
       $conexion->brindParam(':idEquipo',$id_equipo);
       $conexion->execute();

       $partidosEmpatados = $conexion->fetch(PDO::FETCH_ASSOC);
        $conexion = null;
                    
        return $partidosEmpatados;
    }
    

}
