<?php
require_once 'model/EquipoModel.php';
require_once 'model/PartidoModel.php';
require_once 'view/EquipoView.php';
require_once 'model/SesionHelper.php';
require_once 'model/Utils.php';
require_once 'view/PartidoView.php';

class PartidoController
{
    private $equipoModel;
    private $partidoModel;
    private $partidoView;
    private $sesion;
    private $utils;
   

    public function __construct()
    {
        $this->equipoModel = new EquipoModel();
        $this->partidoModel = new PartidoModel();
        $this->partidoView= new PartidoView();
        $this->sesion = new SesionHelper();
        $this->utils = new Utils();
    }

    
    public function mostrarHome()
    {

        $posiciones=array();
        $equipos=$this->equipoModel->getEquipos();
        $totalEquipos=count($equipos);
        $id=1;
        while($id<=$totalEquipos){
                if($this->equipoModel->getEquipo($id)){
                    $equipoArreglo=array(
                        "nombre"=>$this->equipoModel->getEquipo($id),
                        "puntos"=>$this->partidoModel->getPuntos($id),
                        "pg"=>$this->partidoModel->getPartidoGanado($id),
                        "pe"=>$this->partidoModel->getPartidoEmpatado($id),
                        "pp"=>$this->partidoModel->getPartidoPerdidos($id),
                        "gf"=>$this->partidoModel->getGolesDeEqipo($id),
                        "gc"=>$this->partidoModel->getGolesRecibidos($id)
                    );
                    array_push($posiciones,$equipoArreglo);
                }
            $id++;  
        }
        
        usort($posiciones, function($a,$b){
            return $b['puntos'] - $a['puntos'];
        });

        $this->partidoView->cargarHome($posiciones);

        return $posiciones;
           
    }

    public function mostrarFixture()
    {
        $partidos=$this->partidoModel->getPartidos();
        $this->partidoView->showFixture($partidos);
    }


    public function registrarPartido($id_equipo1,$id_equipo2,$golesEquipo1,$golesEquipo2,$fecha)
    {
        if($this->sesion->esAdministrador()){
            if((isset($_REQUEST["equipo1"])&&!empty($_REQUEST["equipo1"]))
            && 
            (isset($_REQUEST["equipo"])&&!empty($_REQUEST["equipo2"]))
            &&
            (isset($_REQUEST["golesEquipo1"])&&!empty($_REQUEST["GolesEquipo1"]))
            &&
            (isset($_REQUEST["golesEquipo2"])&&!empty($_REQUEST["GolesEquipo2"]))
            &&
            (isset($_REQUEST["fecha"])&&!empty($_REQUEST["fecha"]))){
                $equipo1=$_REQUEST["equipo1"];
                $equipo2=$_REQUEST["equipo2"];
                $golesEquipo1=$_REQUEST["golesEquipo1"];
                $golesEquipo2=$_REQUEST["golesEquipo2"];
                $fecha=$_REQUEST["fecha"];
                $partido=$this->partidoModel->getPartido($equipo1,$equipo2);
                
                if($partido==0){
                    $result=$this->partidoModel->addPartido($id_equipo1,$id_equipo2,$golesEquipo1,$golesEquipo2,$fecha);
                    $this->partidoView->showFixture($result);
                    if($result)
                        $this->utils->redirigirPagina("admin","Partido agregado correctamente");
                    else
                        $this->utils->redirigirPagina("admin", "Hubo un error al intentar agregar el partido ");   
                }
                else
                    $this->utils->redirigirPagina("admin","Partido ya existe");

            }else
            $this->utils->redirigirPagina("admin", "Faltan datos que completar.");
        }
        else
            $this->utils->redirigirPagina("login");

        
    }



    public function editarPartido($id_equipo1,$id_equipo2,$golesEquipo1,$golesEquipo2,$fecha)
    {
        if($this->sesion->esAdministrador()){
            if((isset($_REQUEST["equipo1"])&&!empty($_REQUEST["equipo1"]))
            || 
            (isset($_REQUEST["equipo"])&&!empty($_REQUEST["equipo2"]))
            ||
            (isset($_REQUEST["golesEquipo1"])&&!empty($_REQUEST["GolesEquipo1"]))
            ||
            (isset($_REQUEST["golesEquipo2"])&&!empty($_REQUEST["GolesEquipo2"]))
            ||
            (isset($_REQUEST["fecha"])&&!empty($_REQUEST["fecha"]))){
                $equipo1=$_REQUEST["equipo1"];
                $equipo2=$_REQUEST["equipo2"];
                $golesEquipo1=$_REQUEST["golesEquipo1"];
                $golesEquipo2=$_REQUEST["golesEquipo2"];
                $fecha=$_REQUEST["fecha"];
                
                    $result=$this->partidoModel->updatePartido($equipo1,$equipo2,$golesEquipo1,$golesEquipo2,$fecha);
                    if($result)
                        $this->utils->redirigirPagina("admin","Partido actualizado correctamente");
                    else
                        $this->utils->redirigirPagina("admin", "Hubo un error al intentar actualizar el partido ");   
            }else
            $this->utils->redirigirPagina("admin", "Faltan datos que completar.");
        }
        else
            $this->utils->redirigirPagina("login");
    }


    public function eliminarPartido($idParatido)
    {
        if ($this->sesion->esAdministrador()) {
            $partido = $this->partidoModel->getPartido($idParatido);
            if ($partido) {
                $result = $this->partidoModel->deletePartido($idParatido);
                if ($result) {
                    $this->utils->redirigirPagina("fixture", "Partido eliminado correctamente.");
                } else
                    $this->utils->redirigirPagina("fixture", "Hubo en error al intentar eliminar el partido.");
            } else
                $this->utils->redirigirPagina("fixture", "El partido que intenta eliminar no existe en nuestra base de datos.");
        } else
            $this->utils->redirigirPagina("login");
    }


}
