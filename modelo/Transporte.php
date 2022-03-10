<?php
include 'conexion.php';
class Transporte{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function crear($nombre,$avatar,$habilitacion){
        $sql="SELECT id_transporte FROM transporte where nombre=:nombre";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
        $sql="INSERT INTO transporte(nombre,avatar,habilitacion) values (:nombre,:avatar,:habilitacion);";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':nombre'=>$nombre,':avatar'=>$avatar,':habilitacion'=>$habilitacion));
          echo 'add';
        }
    }
    function buscar(){
        if(!empty($_POST['consulta'])){
           $consulta=$_POST['consulta'];
           $sql="SELECT * FROM transporte where nombre LIKE :consulta";
           $query = $this->acceso->prepare($sql);
           $query->execute(array(':consulta'=>"%$consulta%")); 
           $this->objetos=$query->fetchall();
           return $this->objetos;
        }
        else{
          $sql="SELECT * FROM transporte where nombre NOT LIKE '' ORDER BY id_transporte LIMIT 25";
          $query = $this->acceso->prepare($sql);
          $query->execute(); 
          $this->objetos=$query->fetchall();
          return $this->objetos;
        }
    }
   
    function editar($nombre,$id_editado,$habilitacion){
        $sql="UPDATE transporte SET nombre=:nombre,habilitacion=:habilitacion where id_transporte=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_editado,':nombre'=>$nombre,':habilitacion'=>$habilitacion));
        echo 'edit';
    }
    function cambiar_logo($id,$nombre){
        $sql="SELECT avatar FROM transporte where id_transporte=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos = $query->fetchall();
      
            $sql="UPDATE transporte SET avatar=:nombre where id_transporte=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':nombre'=>$nombre));
        return $this->objetos;
        }
 function borrar($id){
        $sql="DELETE FROM transporte where id_transporte=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';
        }
        else{
            echo 'no borrado';
        }
    }
    function rellenar_transporte(){
        $sql="SELECT * FROM transporte order by nombre asc";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function rellenar_transporte1($habilitacion){
        $sql="SELECT habilitacion FROM transporte  where id_transporte=:id order by nombre asc";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$habilitacion)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }

}
?>