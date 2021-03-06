<?php
include 'conexion.php';
class Procedencia{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function crear($nombre,$avatar){
        $sql="SELECT id_procedencia FROM procedencia where nombre=:nombre";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
        $sql="INSERT INTO procedencia(nombre,avatar) values (:nombre,:avatar);";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':nombre'=>$nombre,':avatar'=>$avatar));
          echo 'add';
        }
    }
    function buscar(){
        if(!empty($_POST['consulta'])){
           $consulta=$_POST['consulta'];
           $sql="SELECT * FROM procedencia where nombre LIKE :consulta";
           $query = $this->acceso->prepare($sql);
           $query->execute(array(':consulta'=>"%$consulta%")); 
           $this->objetos=$query->fetchall();
           return $this->objetos;
        }
        else{
          $sql="SELECT * FROM procedencia where nombre NOT LIKE '' ORDER BY id_procedencia LIMIT 25";
          $query = $this->acceso->prepare($sql);
          $query->execute(); 
          $this->objetos=$query->fetchall();
          return $this->objetos;
        }
    }
   
    function editar($nombre,$id_editado){
        $sql="UPDATE procedencia SET nombre=:nombre where id_procedencia=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_editado,':nombre'=>$nombre));
        echo 'edit';
    }
    function cambiar_logo($id,$nombre){
        $sql="SELECT avatar FROM procedencia where id_procedencia=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos = $query->fetchall();
      
            $sql="UPDATE procedencia SET avatar=:nombre where id_procedencia=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':nombre'=>$nombre));
        return $this->objetos;
        }
 function borrar($id){
        $sql="DELETE FROM procedencia where id_procedencia=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';
        }
        else{
            echo 'no borrado';
        }
    }
    function rellenar_procedencia(){
        $sql="SELECT * FROM procedencia order by nombre asc";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
}
?>