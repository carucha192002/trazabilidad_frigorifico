<?php
include 'conexion.php';
class Agenda{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function verificar(){
        $sql="SELECT * FROM `agenda` order by start asc";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    
}
?>