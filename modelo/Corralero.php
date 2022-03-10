<?php
include 'conexion.php';
class Corraleros{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function crear($nombre,$avatar,$legajo){
        $sql="SELECT id_corraleros FROM corraleros where nombre=:nombre";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
        $sql="INSERT INTO corraleros(nombre,avatar,legajo) values (:nombre,:avatar,:legajo);";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':nombre'=>$nombre,':avatar'=>$avatar,':legajo'=>$legajo));
          echo 'add';
        }
    }
    function buscar(){
        if(!empty($_POST['consulta'])){
           $consulta=$_POST['consulta'];
           $sql="SELECT * FROM corraleros where nombre LIKE :consulta";
           $query = $this->acceso->prepare($sql);
           $query->execute(array(':consulta'=>"%$consulta%")); 
           $this->objetos=$query->fetchall();
           return $this->objetos;
        }
        else{
          $sql="SELECT * FROM corraleros where nombre NOT LIKE '' ORDER BY id_corraleros LIMIT 25";
          $query = $this->acceso->prepare($sql);
          $query->execute(); 
          $this->objetos=$query->fetchall();
          return $this->objetos;
        }
    }
   
    function editar($nombre,$id_editado,$legajo){
        $sql="UPDATE corraleros SET nombre=:nombre,legajo=:legajo where id_corraleros=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_editado,':nombre'=>$nombre,':legajo'=>$legajo));
        echo 'edit';
    }
    function cambiar_logo($id,$nombre){
        $sql="SELECT avatar FROM corraleros where id_corraleros=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos = $query->fetchall();
      
            $sql="UPDATE corraleros SET avatar=:nombre where id_corraleros=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':nombre'=>$nombre));
        return $this->objetos;
        }
 function borrar($id){
        $sql="DELETE FROM corraleros where id_corraleros=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';
        }
        else{
            echo 'no borrado';
        }
    }
function rellenar_corraleros(){
        $sql="SELECT * FROM corraleros  order by nombre asc";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
}
?>