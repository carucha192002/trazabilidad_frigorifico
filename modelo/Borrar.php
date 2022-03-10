<?php
include 'conexion.php';
class Borrar{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    
    function borrartropa($id){
        $sql="UPDATE ingresos SET estado='I',etapa='BORRADO' WHERE id_ingresos=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        echo'borrado';
    }
                
}
?>