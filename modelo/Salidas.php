<?php
include_once 'conexion.php';
class Salidas{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    
    function buscar(){
        $sql="SELECT id_venta,fecha,cliente,dni,SUM(detalle_venta.det_cantidad) as total, CONCAT(usuario.nombre_us,' ',usuario.apellidos_us) as vendedor,destino,estado  FROM venta  
        join usuario on vendedor=id_usuario 
        join detalle_venta on id_venta=id_det_venta  
        WHERE estado='ENTREGADO' GROUP by detalle_venta.id_det_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
   
}