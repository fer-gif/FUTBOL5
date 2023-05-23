<?php

class Connection{
    private $db;

    public function __construct($db)
    {
        $this->db=$db;
    }
    public function conectar(){
        try{
            $this->db=new PDO('mysql:host=localhost;'.'dbname=db_appfutbol;charset=utf8', 'root', '');
            return true;
        }catch(Exception $e){
            $e->getMessage();
        
        }
        
    }

    public function getConnection(){
        return $this->db;
    }

}

?>