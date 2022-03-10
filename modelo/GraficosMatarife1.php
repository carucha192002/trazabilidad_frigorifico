<?php
include_once 'conexion.php';
class Graficos1{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
     function faena_mes_matarife($id_matarife,$id_matarife1){
        $sql="SELECT sum(seleccionado) as cantidad, month(faenas.fecha) as mes FROM `faenas` 
        join ingresos on id_ingreso=id_ingresos
        WHERE faenas.matarife=:id_matarife and ingresos.matarifesub_item=:id_matarife1 and year(faenas.fecha)=year(curdate()) group by month(faenas.fecha)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_matarife'=>$id_matarife,':id_matarife1'=>$id_matarife1)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function faena_mes_matarife_comun($id_matarife){
        $sql="SELECT sum(seleccionado) as cantidad, month(faenas.fecha) as mes FROM `faenas` join ingresos on id_ingreso=id_ingresos WHERE faenas.matarife=:id_matarife and year(faenas.fecha)=year(curdate()) group by month(faenas.fecha)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_matarife'=>$id_matarife)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function faena_mes_matarife1($id_matarife){
        $sql="SELECT sum(faenas.cantidad) as cantidad, month(faenas.fecha) as mes FROM `faenas` 
        join ingresos on id_ingreso=id_ingresos
        WHERE faenas.matarife=:id_matarife and year(faenas.fecha)=year(curdate()) group by month(faenas.fecha)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_matarife'=>$id_matarife)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function faena_mes_matarife1_comun($id_matarife){
        $sql="SELECT sum(faenas.cantidad) as cantidad, month(faenas.fecha) as mes FROM `faenas` 
        join ingresos on id_ingreso=id_ingresos
        WHERE year(faenas.fecha)=year(curdate()) group by month(faenas.fecha)";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
 
    function faena_mes_anterior_productor($id_matarife,$id_matarife1){
        $sql="SELECT sum(seleccionado) as cantidad, month(faenas.fecha) as mes FROM `faenas` 
    join ingresos on id_ingreso=id_ingresos
        WHERE faenas.matarife=:id_matarife and ingresos.matarifesub_item=:id_matarife1 and year(faenas.fecha)=year(date_add(curdate(),INTERVAL -1 YEAR)) group by month(faenas.fecha)
        ";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_matarife'=>$id_matarife,':id_matarife1'=>$id_matarife1)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function faena_mes_anterior_productor_comun($id_matarife){
        $sql="SELECT sum(seleccionado) as cantidad, month(faenas.fecha) as mes FROM `faenas` 
        join ingresos on id_ingreso=id_ingresos
            WHERE faenas.matarife=:id_matarife  and year(faenas.fecha)=year(date_add(curdate(),INTERVAL -1 YEAR)) group by month(faenas.fecha)
        ";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_matarife'=>$id_matarife)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    
    function faena_mes_anterior_productor1($id_matarife){
        $sql="SELECT sum(faenas.cantidad) as cantidad, month(faenas.fecha) as mes FROM `faenas` 
           join ingresos on id_ingreso=id_ingresos
        WHERE faenas.matarife=:id_matarife and year(faenas.fecha)=year(date_add(curdate(),INTERVAL -1 YEAR)) group by month(faenas.fecha)
        ";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_matarife'=>$id_matarife)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function faena_mes_anterior_productor1_comun($id_matarife){
        $sql="SELECT sum(faenas.cantidad) as cantidad, month(faenas.fecha) as mes FROM `faenas` 
           join ingresos on id_ingreso=id_ingresos
        WHERE year(faenas.fecha)=year(date_add(curdate(),INTERVAL -1 YEAR)) group by month(faenas.fecha)
        ";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_matarife'=>$id_matarife)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
}