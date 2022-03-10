<?php
include_once 'conexion.php';
class Venta{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function crear($fecha,$nombre,$dni,$total,$vendedor,$destino,$estado){
        $sql="INSERT INTO venta(fecha,cliente,dni,total,vendedor,destino,estado) values (:fecha,:cliente,:dni,:total,:vendedor,:destino,:estado);";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':fecha'=>$fecha,':cliente'=>$nombre,':dni'=>$dni,':total'=>$total,':vendedor'=>$vendedor,':destino'=>$destino,':estado'=>$estado));
    }
    function ultima_venta(){
        $sql="SELECT MAX(id_venta) as ultima_venta FROM venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function borrar($id_venta){
        $sql="DELETE FROM venta where id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta'=>$id_venta));
        echo 'delete';
    }
    function buscar(){
        $sql="SELECT id_venta,fecha,cliente,dni,total, CONCAT(usuario.nombre_us,' ',usuario.apellidos_us) as vendedor, CONCAT('',' ',calidad.nombre) as calidad,destino,estado FROM venta join usuario on vendedor=id_usuario join calidad on calidad=id_calidad";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function despachos($id){
        $sql="SELECT id_ingreso,garron FROM `faenados` WHERE id_faenados=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array('id' => $id)); 
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
    function venta_dia_vendedor($id_usuario){
        $sql="SELECT SUM(total) as venta_dia_vendedor FROM `venta` WHERE vendedor=:id_usuario and date(fecha)=date(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario)); 
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
        $sql="SELECT SUM(total) as venta_mensual FROM `venta` WHERE year(fecha)=year(curdate()) and month(fecha)=month(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function venta_anual(){
        $sql="SELECT SUM(total) as venta_anual FROM `venta` WHERE year(fecha)=year(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscar_id($id){
        $sql="SELECT id_venta,fecha,matarife.nombre as cliente,dni,total, CONCAT(usuario.secretaria,' ',usuario.nombre_us,' ',usuario.apellidos_us) as vendedor FROM venta 
        join matarife on cliente=id_matarife
        join usuario on vendedor=id_usuario and id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscardatostodos1($id,$desde,$hasta){
        $sql="SELECT SUM(faenas.cantidad)as total FROM faenas 
        join ingresos on id_ingreso=id_ingresos
        where faenas.matarife=:usuario and faenas.fecha>=:desde and faenas.fecha<=:hasta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario'=>$id,':desde'=>$desde,':hasta'=>$hasta));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscardatostodos1_comun($id,$desde,$hasta){
        $sql="SELECT SUM(faenas.cantidad)as total FROM faenas 
        join ingresos on id_ingreso=id_ingresos
        where faenas.fecha>=:desde and faenas.fecha<=:hasta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':desde'=>$desde,':hasta'=>$hasta));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function submatarife($id){
        $sql="SELECT id_submatarife FROM `submatarife` where id_matarife=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function matarife(){
        $sql="SELECT id_matarife FROM `matarife`";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscar_id_total($id){
        $sql="SELECT id_venta,fecha,matarife.nombre as cliente,dni,sum(detalle_venta.det_cantidad) as total, CONCAT(usuario.secretaria,' ',usuario.nombre_us,' ',usuario.apellidos_us) as vendedor FROM venta 
        join matarife on cliente=id_matarife
        join detalle_venta on id_venta=id_det_venta
        join usuario on vendedor=id_usuario and id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function facturacion2($id){
        $sql="SELECT round(SUM(faenados.peso),3) as peso, count(faenados.garron) as reses,round( SUM(faenados.peso)/ COUNT(faenados.garron),3) as rendimiento FROM ingresos
        JOIN faenas on id_ingresos=faenas.id_ingreso
         JOIN faenados on id_ingresos=faenados.id_ingreso
        WHERE ingresos.etapa='FINALIZADO' and id_ingresos=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function facturacion22($id,$fecha,$id_ingreso){
        $sql="SELECT round(SUM(faenados.peso),3) as peso, COUNT(faenados.garron) as reses,round( SUM(faenados.peso)/ COUNT(faenados.garron),3) as rendimiento FROM ingresos
        JOIN faenas on id_ingresos=faenas.id_ingreso
             JOIN faenados on id_ingresos=faenados.id_ingreso
            WHERE ingresos.etapa='FINALIZADO' and ingresos.id_ingresos=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_ingreso)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
  
}