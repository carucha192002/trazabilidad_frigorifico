<?php
include_once 'conexion.php';
class Reporte{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    
    function buscar(){
        
        $sql="SELECT id_venta,fecha,venta.cliente as cliente,dni,SUM(detalle_venta.det_cantidad) as total, CONCAT(usuario.nombre_us,' ',usuario.apellidos_us) as vendedor,destino,estado  FROM venta  
        join usuario on vendedor=id_usuario 
        join detalle_venta on id_venta=id_det_venta  
        WHERE estado='EN PROCESO' GROUP by detalle_venta.id_det_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function verificar($id_venta,$id_usuario){
        $sql="SELECT * FROM venta WHERE vendedor=:id_usuario and id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario,':id_venta'=>$id_venta)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            return 1;
        }
        else{
            return 0;
        }
    }
    function recuperar_vendedor($id_venta){
        $sql="SELECT us_tipo FROM venta join usuario on id_usuario=vendedor WHERE id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta'=>$id_venta)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function venta_dia_vendedor(){
        $sql="SELECT count(detalle_venta.garron) as venta_dia_vendedor FROM `venta` 
        join detalle_venta on id_venta=id_det_venta
        WHERE  day(fecha)=day(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function venta_diaria(){
        $sql="SELECT SUM(total) as venta_diaria FROM `venta` WHERE date(fecha)=date(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function venta_mensual(){
        $sql="SELECT count(detalle_venta.garron) as venta_mensual FROM `venta` 
        join detalle_venta on id_venta=id_det_venta
        WHERE year(fecha)=year(curdate()) and month(fecha)=month(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function venta_anual(){
        $sql="SELECT count(detalle_venta.garron)as venta_anual FROM `venta` 
        join detalle_venta on id_venta=id_det_venta
         WHERE year(fecha)=year(curdate())
        ";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscar_id($id_venta){
        $sql="SELECT id_venta,fecha,cliente,dni,total, CONCAT(usuario.secretaria,' ',usuario.nombre_us,' ',usuario.apellidos_us) as vendedor,usuario.adicional_us as secretaria,calidad.nombre as calidad1,quien FROM venta 
        join usuario on vendedor=id_usuario join calidad on calidad=id_calidad and id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta'=>$id_venta)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
}