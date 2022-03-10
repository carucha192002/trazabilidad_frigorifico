
<?php
include 'conexion.php';
class Diarios{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    
    function buscar(){
        $sql="SELECT id,fecha,id_ingreso FROM `faenas` WHERE etapa='A' GROUP by fecha";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function ver_todo($fecha){
        $sql="SELECT id_ingreso,faenas.fecha as fecha,id_matarife,tropa,faenas.cantidad as cantidad,clasificacion,concat(desde,'-',hasta)as garron,Dte as dte,corral.nombre as corral,ingresos.kilosenpie as kilosenpie,faenas.tci as tci  FROM `faenas`
        JOIN corral on corral=id_corral
        JOIN ingresos on id_ingreso=id_ingresos
        WHERE faenas.fecha=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$fecha)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
       
    }
    function ver($id,$fecha,$id_ingreso){
        $sql="SELECT garron,tropa,especie,peso,productor,productor.establecimiento as establecimiento FROM `faenados` JOIN productor on productor=nombre WHERE id_ingreso=:id and year(fecha)=:fecha order by garron asc";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_ingreso,':fecha'=>$fecha)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
       
    }
    function cantidad($id,$fecha,$id_ingreso){
        $sql="SELECT count(*) as cantidad FROM `faenados` WHERE id_ingreso=:id and year(fecha)=:fecha";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_ingreso,':fecha'=>$fecha)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
       
    }
    function promedios($id_ingreso){
        $sql="SELECT AVG(peso)as promedio, sum(peso)as kgcarne,count(*) as cantidad FROM `faenados` where id_ingreso=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_ingreso)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function kgcarne($tropa){
        $sql="SELECT sum(peso)as kgcarne FROM `faenados` where tropa=:tropa";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':tropa'=>$tropa)); 
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
    function ver_todo_caprinos($fecha,$especie){
        $sql="SELECT faenas.id_ingreso as id_ingreso,faenas.fecha as fecha,id_matarife,faenas.tropa as tropa,faenas.cantidad as cantidad,clasificacion,concat(desde,'-',hasta)as garron,Dte as dte,faenas.corral as corral,faenas.kilosenpie as kilosenpie ,faenas.tci as tci FROM `faenas`
        JOIN ingresos on faenas.id_ingreso=ingresos.id_ingresos
        WHERE faenas.fecha=:fecha and ingresos.especie=:especie";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':fecha'=>$fecha,':especie'=>$especie)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
       
    }
    function sumas($fecha,$especie){
        $sql="SELECT SUM(faenas.cantidad) as cantidad_animales,SUM(faenas.kilosenpie) as kilosenpie_animales FROM `faenas`
        JOIN ingresos on faenas.id_ingreso=ingresos.id_ingresos
        WHERE faenas.fecha=:fecha and ingresos.especie=:especie";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':fecha'=>$fecha,':especie'=>$especie)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
       
    }
}