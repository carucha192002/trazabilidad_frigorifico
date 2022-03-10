<?php
include_once 'conexion.php';
class Graficos{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
     function faena_mes_matarife($id_matarife){
        $sql="SELECT sum(seleccionado) as cantidad, month(fecha) as mes FROM `faenas` WHERE matarife=:id_matarife and year(fecha)=year(curdate()) group by month(fecha)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_matarife'=>$id_matarife)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
 
    function faena_mes_anterior_productor($id_matarife){
        $sql="SELECT sum(seleccionado) as cantidad, month(fecha) as mes FROM `faenas` WHERE matarife=:id_matarife and year(fecha)=year(date_add(curdate(),INTERVAL -1 YEAR)) group by month(fecha)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_matarife'=>$id_matarife)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
}