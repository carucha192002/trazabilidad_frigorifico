<?php
include 'conexion.php';
class Resultado{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function cambiar_resultado($id,$fecha){
        $sql="UPDATE venta SET estado=:estado, est_fech=:est_fech where id_venta=:id" ;
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':estado'=>"ENTREGADO",':id'=>$id,':est_fech'=>$fecha));
        echo 'entregado';        
    }  
    function datos($id){
        $sql="SELECT id_ingreso FROM `venta`
        JOIN detalle_venta on id_venta=id_det_venta
        JOIN faenados on detalle_venta.id_faena=id_faenados
        WHERE id_venta=:id GROUP by id_ingreso";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscar($id_usuario){
        $sql="SELECT id_venta,fecha,cliente,dni,total, CONCAT(usuario.nombre_us,' ',usuario.apellidos_us) as vendedor, CONCAT('',' ',calidad.nombre) as calidad,destino,estado  FROM venta join usuario on vendedor=id_usuario join calidad on calidad=id_calidad WHERE vendedor=:id_usuario and estado=:consulta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario,':consulta'=>"EN PROCESO")); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscar_entregada($id_usuario){
        $sql="SELECT id_venta,fecha,cliente,dni,total, CONCAT(usuario.nombre_us,' ',usuario.apellidos_us) as vendedor, CONCAT('',' ',calidad.nombre) as calidad,destino,estado  FROM venta join usuario on vendedor=id_usuario join calidad on calidad=id_calidad WHERE vendedor=:id_usuario and estado=:consulta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario,':consulta'=>"ENTREGADO")); 
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
    function venta_semanal($id_usuario){
        $sql="SELECT SUM(total) as venta_semanal FROM `venta` WHERE vendedor=:id_usuario and week(fecha)=week(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    } 
    function venta_mensual($id_usuario){
        $sql="SELECT SUM(total) as venta_mensual FROM `venta` WHERE vendedor=:id_usuario and year(fecha)=year(curdate()) and month(fecha)=month(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function venta_anual($id_usuario){
        $sql="SELECT SUM(total) as venta_anual FROM `venta` WHERE vendedor=:id_usuario and year(fecha)=year(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscar_id($id_venta){
        $sql="SELECT id_venta,fecha,cliente,dni,total, CONCAT(usuario.nombre_us,' ',usuario.apellidos_us) as vendedor FROM venta join usuario on vendedor=id_usuario 
        and id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta'=>$id_venta)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function contar_entregas($id_usuario){
        $sql="SELECT COUNT(estado) as contar_entregas FROM `venta` WHERE vendedor=:id_usuario and estado=:consulta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario,':consulta'=>"ENTREGADO")); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function contar_procesos($id_usuario){
        $sql="SELECT COUNT(estado) as contar_procesos FROM `venta` WHERE vendedor=:id_usuario and estado=:consulta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario,':consulta'=>"EN PROCESO")); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscar_id_nuevo($id){
        $sql="SELECT id_faenados,salio,faenados.camara,faenados.etiqueta FROM faenados
        join detalle_venta on id_faenados=id_faena
        where detalle_venta.id_det_venta=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function cambiarestado($id){
        $sql="UPDATE faenados SET salio='SI' where id_faenados=:id" ;
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        echo 'entregado';    
    }
    function despachos(){
        $sql="SELECT COUNT(id_venta) as cantidad FROM `venta` WHERE estado='EN PROCESO'";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
}