<?php
include 'conexion.php';
class Inicio{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
  
    function traer($id){
        $sql="SELECT  nombre_us,dni_us,tipo_us.nombre_tipo as tipo,email_us as email,avatar,telefono_us,us_tipo as categoria FROM `usuario`
        join tipo_us on us_tipo=id_tipo_us
        WHERE id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
        
   
}
?>