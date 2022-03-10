<?php
include 'conexion.php';
class Especies{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function buscardatos(){
        $sql="SELECT @ROW := @ROW + 1 as ID,codigo,diente,categoria,especies.nombre as especies,id_subespecies as idreal FROM subespeces
        join especies on id_especie=id_especies_sub
        join (SELECT @ROW := 0) t2
        LIMIT 100";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function crear($nombre,$avatar){
        $sql="SELECT id_especies FROM especies where nombre=:nombre";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
        $sql="INSERT INTO especies(nombre,avatar) values (:nombre,:avatar);";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':nombre'=>$nombre,':avatar'=>$avatar));
          echo 'add';
        }
    }
    function crearsubcategoria($id,$nombre,$codigo,$diente,$avatar){
        $sql="INSERT INTO subespeces(codigo,diente,categoria,nombre,id_especie,avatar) values (:codigo,:diente,:categoria,:nombre,:id_especie,:avatar);";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':codigo'=>$codigo,':diente'=>$diente,':categoria'=>$nombre,':nombre'=>$nombre,':id_especie'=>$id,':avatar'=>$avatar));
          echo 'add';
        
    }
    function editarsubcategoria($id,$nombre,$codigo,$diente){
        $sql="UPDATE subespeces SET codigo=:codigo,diente=:diente,categoria=:categoria,nombre=:nombre where id_subespecies=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':codigo'=>$codigo,':diente'=>$diente,':categoria'=>$nombre,':nombre'=>$nombre,':id'=>$id));
          echo 'add';
        
    }
    function buscarsubcategoria($id){
        $sql="SELECT * FROM subespeces where id_especie=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscar(){
        if(!empty($_POST['consulta'])){
           $consulta=$_POST['consulta'];
           $sql="SELECT * FROM especies where nombre LIKE :consulta";
           $query = $this->acceso->prepare($sql);
           $query->execute(array(':consulta'=>"%$consulta%")); 
           $this->objetos=$query->fetchall();
           return $this->objetos;
        }
        else{
          $sql="SELECT * FROM especies where nombre NOT LIKE '' ORDER BY id_especies LIMIT 25";
          $query = $this->acceso->prepare($sql);
          $query->execute(); 
          $this->objetos=$query->fetchall();
          return $this->objetos;
        }
    }
   
    function editar($nombre,$id_editado){
        $sql="UPDATE especies SET nombre=:nombre where id_especies=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_editado,':nombre'=>$nombre));
        echo 'edit';
    }
    function cambiar_logo($id,$nombre){
        $sql="SELECT avatar FROM especies where id_especies=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos = $query->fetchall();
      
            $sql="UPDATE especies SET avatar=:nombre where id_especies=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':nombre'=>$nombre));
        return $this->objetos;
        }
 function borrar($id){
        $sql="DELETE FROM especies where id_especies=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';
        }
        else{
            echo 'no borrado';
        }
    }
    function rellenar_especies(){
        $sql="SELECT * FROM especies order by nombre asc";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function codigos($id){
        $sql="SELECT * FROM subespeces WHERE id_especie=:id order by codigo asc";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
}
?>