<?php
include 'conexion.php';
class Productor{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function crear($nombre,$avatar,$cuit,$establecimiento){
        $sql="SELECT id_productor FROM productor where nombre=:nombre";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
        $sql="INSERT INTO productor(nombre,avatar,cuit,establecimiento) values (:nombre,:avatar,:cuit,:establecimiento);";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':nombre'=>$nombre,':avatar'=>$avatar,':cuit'=>$cuit,':establecimiento'=>$establecimiento));
          echo 'add';
        }
    }
    function buscar(){
        if(!empty($_POST['consulta'])){
           $consulta=$_POST['consulta'];
           $sql="SELECT * FROM productor where nombre LIKE :consulta";
           $query = $this->acceso->prepare($sql);
           $query->execute(array(':consulta'=>"%$consulta%")); 
           $this->objetos=$query->fetchall();
           return $this->objetos;
        }
        else{
          $sql="SELECT * FROM productor where nombre NOT LIKE '' ORDER BY id_productor LIMIT 25";
          $query = $this->acceso->prepare($sql);
          $query->execute(); 
          $this->objetos=$query->fetchall();
          return $this->objetos;
        }
    }
   
    function editar($nombre,$id_editado,$cuit,$establecimiento){
        $sql="UPDATE productor SET nombre=:nombre,cuit=:cuit,establecimiento=:establecimiento where id_productor=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_editado,':nombre'=>$nombre,':cuit'=>$cuit,':establecimiento'=>$establecimiento));
        echo 'edit';
    }
    function cambiar_logo($id,$nombre){
        $sql="SELECT avatar FROM productor where id_productor=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos = $query->fetchall();
      
            $sql="UPDATE productor SET avatar=:nombre where id_productor=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':nombre'=>$nombre));
        return $this->objetos;
        }
 function borrar($id){
        $sql="DELETE FROM productor where id_productor=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';
        }
        else{
            echo 'no borrado';
        }
    }
   function rellenar_productor(){
        $sql="SELECT * FROM productor order by nombre asc";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function rellenar_productorcuit($id){
        $sql="SELECT cuit FROM productor where id_productor=:id order by nombre asc";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
}
?>