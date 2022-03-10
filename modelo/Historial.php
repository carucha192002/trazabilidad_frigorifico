<?php
include_once 'conexion.php';
class Historial{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function traerid(){
        $sql="SELECT max(id_ingresos) as ultimo FROM `ingresos`";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function retornar($id){
        $sql="SELECT tropa,id_ingreso FROM `faenados` WHERE id_faenados=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function datosroot($id_usuario){
        $sql="SELECT usuario.nombre_us as nombre,usuario.apellidos_us as apellido FROM `usuario` 
        WHERE id_usuario=:usuario";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario'=>$id_usuario)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function llenar_historial($id_usuario){
        $sql="SELECT h.id as id,descripcion,fecha,th.nombre as tipo_historial,th.icono as th_icono,m.nombre as modulo,m.icono as m_icono FROM historial h 
        JOIN tipo_historial th on h.id_tipo_historial=th.id
        join modulo m on h.id_modulo=m.id WHERE id_usuario=:usuario ORDER by fecha DESC";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario'=>$id_usuario)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function crear_historial($descripcion,$tipo_historial,$modulo,$id_usuario){
        $sql="INSERT INTO historial(descripcion,id_tipo_historial,id_modulo,id_usuario)VALUES (:descripcion,:id_tipo_historial,:id_modulo,:id_usuario)";
        $query = $this->acceso->prepare($sql);
        $variables=array(
            ':descripcion'=>$descripcion,
            ':id_tipo_historial'=>$tipo_historial,
            ':id_modulo'=>$modulo,
            ':id_usuario'=>$id_usuario
        );
        $query->execute($variables); 
    }
    
}
?>