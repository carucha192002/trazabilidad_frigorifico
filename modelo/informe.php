<?php
include_once 'conexion.php';
class Informe{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function traer(){
        $sql="SELECT * FROM legajo";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchall();
        return $this->objetos;
    } 
    function listar_busqueda($id_usuario,$desde,$hasta,$submatarife){
        $sql="SELECT id,faenas.fecha as fecha,tropa,id_matarife,Dte,faenas.cantidad as cantidad,desde,hasta,clasificacion FROM `faenas` 
        join ingresos on id_ingreso=id_ingresos
        WHERE faenas.matarife=:usuario and faenas.fecha>=:desde and faenas.fecha<=:hasta and ingresos.matarifesub_item=:submatarife GROUP BY id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario'=>$id_usuario,':desde'=>$desde,':hasta'=>$hasta,':submatarife'=>$submatarife));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    } 
    
    function listar_busqueda_comun($id_usuario,$desde,$hasta){
        $sql="SELECT id,faenas.fecha as fecha,tropa,id_matarife,Dte,faenas.cantidad as cantidad,desde,hasta,clasificacion FROM `faenas` 
        join ingresos on id_ingreso=id_ingresos
        WHERE faenas.matarife=:usuario and faenas.fecha>=:desde and faenas.fecha<=:hasta GROUP BY id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario'=>$id_usuario,':desde'=>$desde,':hasta'=>$hasta));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    } 
    function sumas($id,$desde,$hasta,$submatarife){
        $sql="SELECT SUM(faenas.cantidad) as cantidad  FROM `faenas` 
        join ingresos on id_ingreso=id_ingresos
        WHERE faenas.matarife=:usuario and faenas.fecha>=:desde and faenas.fecha<=:hasta and ingresos.matarifesub_item=:submatarife";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario'=>$id,':desde'=>$desde,':hasta'=>$hasta,':submatarife'=>$submatarife));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    } 
    function sumas_comun($id,$desde,$hasta){
        $sql="SELECT SUM(faenas.cantidad) as cantidad  FROM `faenas` 
        join ingresos on id_ingreso=id_ingresos
        WHERE faenas.matarife=:usuario and faenas.fecha>=:desde and faenas.fecha<=:hasta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario'=>$id,':desde'=>$desde,':hasta'=>$hasta));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    } 
    function listar_busqueda_todas($id_usuario,$desde,$hasta){
        $sql="SELECT id,faenas.fecha as fecha,tropa,id_matarife,Dte,faenas.cantidad as cantidad,desde,hasta,clasificacion FROM `faenas` 
        join ingresos on id_ingreso=id_ingresos
        WHERE faenas.matarife=:usuario and faenas.fecha>=:desde and faenas.fecha<=:hasta  GROUP by id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario'=>$id_usuario,':desde'=>$desde,':hasta'=>$hasta));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    } 
    function listar_busqueda_todas_comun($id_usuario,$desde,$hasta){
        $sql="SELECT id,faenas.fecha as fecha,tropa,id_matarife,Dte,faenas.cantidad as cantidad,desde,hasta,clasificacion FROM `faenas` 
        join ingresos on id_ingreso=id_ingresos
        WHERE faenas.fecha>=:desde and faenas.fecha<=:hasta  GROUP by id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':desde'=>$desde,':hasta'=>$hasta));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    } 
    function buscar($id_usuario,$desde,$hasta){
        $sql="SELECT * FROM `faenas` WHERE matarife=:usuario and fecha>=:desde and fecha<=:hasta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario'=>$id_usuario,':desde'=>$desde,':hasta'=>$hasta));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    } 
    function buscardatos($id){
        $sql="SELECT * FROM faenas where  id=:usuario";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario'=>$id));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    } 
    function buscardatostodos($id,$desde,$hasta,$sub){
        $sql="SELECT @ROW := @ROW + 1 as ID, SUM(faenas.cantidad) as total, faenas.fecha as fecha, faenas.id_matarife as matarife,faenas.clasificacion as clasificacion FROM `faenas` 
        join ingresos on id_ingreso=id_ingresos
        join (SELECT @ROW := 0) t2
        WHERE faenas.matarife=:usuario and faenas.fecha>=:desde and faenas.fecha<=:hasta and ingresos.matarifesub_item=:sub group by ingresos.matarifesub_item";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario'=>$id,':desde'=>$desde,':hasta'=>$hasta,':sub'=>$sub));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    } 
    function buscardatostodos_comun($id,$desde,$hasta,$sub){
        $sql="SELECT @ROW := @ROW + 1 as ID,faenas.matarife as id_matarife, SUM(faenas.cantidad) as total, faenas.fecha as fecha, faenas.id_matarife as matarife,faenas.clasificacion as clasificacion FROM `faenas` 
        join ingresos on id_ingreso=id_ingresos
        join (SELECT @ROW := 0) t2
        WHERE faenas.matarife=:sub and faenas.fecha>=:desde and faenas.fecha<=:hasta ";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':desde'=>$desde,':hasta'=>$hasta,':sub'=>$sub));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    } 
    function usuario(){
        $sql="SELECT matarife.id_matarife as id, concat(matarife.nombre,' --  ',submatarife.nombre) as nombre,id_submatarife FROM `matarife`
        JOIN submatarife on matarife.id_matarife=submatarife.id_matarife";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function usuario_comun(){
        $sql="SELECT id_matarife as id,matarife.nombre as nombre FROM `matarife`";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
   
}