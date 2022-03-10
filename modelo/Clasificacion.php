<?php
include 'conexion.php';
class Clasificacion{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function crear($nombre,$avatar){
        $sql="SELECT id_clasificacion FROM clasificacion where nombre=:nombre";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
        $sql="INSERT INTO clasificacion(nombre,avatar) values (:nombre,:avatar);";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':nombre'=>$nombre,':avatar'=>$avatar));
          echo 'add';
        }
    }
    function buscar(){
        if(!empty($_POST['consulta'])){
           $consulta=$_POST['consulta'];
           $sql="SELECT id_clasificacion,nombre,avatar FROM clasificacion where nombre LIKE :consulta LIMIT 25";
           $query = $this->acceso->prepare($sql);
           $query->execute(array(':consulta'=>"%$consulta%")); 
           $this->objetos=$query->fetchall();
           return $this->objetos;
        }
        else{
          $sql="SELECT id_clasificacion,nombre,avatar FROM clasificacion where nombre NOT LIKE '' ORDER BY id_clasificacion LIMIT 25";
          $query = $this->acceso->prepare($sql);
          $query->execute(); 
          $this->objetos=$query->fetchall();
          return $this->objetos;
        }
    }
    function cambiar_logo($id,$nombre){
        $sql="SELECT avatar FROM clasificacion where id_clasificacion=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos = $query->fetchall();
      
            $sql="UPDATE clasificacion SET avatar=:nombre where id_clasificacion=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':nombre'=>$nombre));
        return $this->objetos;
        }
       
    function borrar($id){
        $sql="DELETE FROM clasificacion where id_clasificacion=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';
        }
        else{
            echo 'no borrado';
        }
    }
    function editar($nombre,$id_editado){
        $sql="UPDATE clasificacion SET nombre=:nombre where id_clasificacion=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_editado,':nombre'=>$nombre));
        echo 'edit';
    }
    function rellenar_Laboratorios(){
        $sql="SELECT * FROM laboratorio order by nombre asc";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }
}
?>