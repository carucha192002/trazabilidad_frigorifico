<?php
include 'conexion.php';
class Despieces{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function buscardatos(){
        $sql="SELECT @ROW := @ROW + 1 as ID,codigo,espeice,despiece,id_despieces as idreal FROM despieces
        join (SELECT @ROW := 0) t2
        LIMIT 100";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
   
    function editar($id,$nombre,$codigo,$despiece){
        $sql="UPDATE despieces SET codigo=:codigo,espeice=:espeice,despiece=:despiece where id_despieces=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':codigo'=>$codigo,':espeice'=>$nombre,':despiece'=>$despiece,':id'=>$id));
          echo 'add';
        
    }
 
    
}
?>