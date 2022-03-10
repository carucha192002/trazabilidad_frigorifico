<?php
include_once 'conexion.php';
class Graficos{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function faena_mes(){
        $sql="SELECT sum(seleccionado) as cantidad, month(fecha) as mes FROM `faenas` WHERE year(fecha)=year(curdate()) group by month(fecha)";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function faena_mes_anterior(){
        $sql="SELECT sum(seleccionado) as cantidad, month(fecha) as mes FROM `faenas` WHERE year(fecha)=year(date_add(curdate(),INTERVAL -1 YEAR)) group by month(fecha)";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
}