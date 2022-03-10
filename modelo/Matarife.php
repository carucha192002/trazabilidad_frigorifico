<?php
include 'conexion.php';
class Matarife{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function crear($nombre,$avatar,$cuit,$establecimiento,$email,$ultimo){
        $sql="SELECT id_matarife FROM matarife where nombre=:nombre";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
        $sql="INSERT INTO matarife(nombre,avatar,cuit,establecimiento,email) values (:nombre,:avatar,:cuit,:establecimiento,:email);";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':nombre'=>$nombre,':avatar'=>$avatar,':cuit'=>$cuit,':establecimiento'=>$establecimiento,':email'=>$email));
          $sql="INSERT INTO usuario(dni_us,contrasena_us,email_us,us_tipo,avatar,nombre_us,id_matarife) values (:dni_us,:contrasena_us,:email_us,:us_tipo,:avatar,:nombre_us,:id_matarife);";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':dni_us'=>$cuit,':contrasena_us'=>$cuit,':email_us'=>$email,':us_tipo'=>"4",':avatar'=>"avatar.png",':nombre_us'=>$nombre,':id_matarife'=>$ultimo));
          echo 'add';
        }
    }

    function crear_subitem($nombre,$cuit,$identificador,$id){
        $sql="INSERT INTO submatarife(nombre,cuit,identificador,id_matarife) values (:nombre,:cuit,:identificador,:id_matarife);";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':nombre'=>$nombre,':cuit'=>$cuit,':identificador'=>$identificador,':id_matarife'=>$id));
          echo 'add';
          $sql="UPDATE matarife SET cantidad=cantidad+1 where id_matarife=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':id'=>$id));
          
        }
        function editar_subitem($nombre,$cuit,$identificador,$id){
            $sql="UPDATE submatarife SET nombre=:nombre,cuit=:cuit,identificador=:identificador where id_submatarife=:id";
              $query = $this->acceso->prepare($sql);
              $query->execute(array(':nombre'=>$nombre,':cuit'=>$cuit,':identificador'=>$identificador,':id'=>$id));
              echo 'add';

            }
    function ultimo_matarife(){
        $sql="SELECT max(id_matarife)+1 as ultimo FROM matarife";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscar(){
        if(!empty($_POST['consulta'])){
           $consulta=$_POST['consulta'];
           $sql="SELECT * FROM matarife where nombre LIKE :consulta";
           $query = $this->acceso->prepare($sql);
           $query->execute(array(':consulta'=>"%$consulta%")); 
           $this->objetos=$query->fetchall();
           return $this->objetos;
        }
        else{
          $sql="SELECT * FROM matarife where nombre NOT LIKE '' ORDER BY id_matarife LIMIT 25";
          $query = $this->acceso->prepare($sql);
          $query->execute(); 
          $this->objetos=$query->fetchall();
          return $this->objetos;
        }
    }
   
    function editar($nombre,$id_editado,$cuit,$establecimiento,$email){
        $sql="UPDATE matarife SET nombre=:nombre,cuit=:cuit,establecimiento=:establecimiento,email=:email where id_matarife=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_editado,':nombre'=>$nombre,':cuit'=>$cuit,':establecimiento'=>$establecimiento,':email'=>$email));
        $sql="UPDATE usuario SET dni_us=:dni_us,contrasena_us=:contrasena_us,email_us=:email_us,nombre_us=:nombre_us where id_matarife=:id_matarife;";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':dni_us'=>$cuit,':contrasena_us'=>$cuit,':email_us'=>$email,':nombre_us'=>$nombre,':id_matarife'=>$id_editado));
        echo 'edit';
    }
    function cambiar_logo($id,$nombre){
        $sql="SELECT avatar FROM matarife where id_matarife=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos = $query->fetchall();
      
            $sql="UPDATE matarife SET avatar=:nombre where id_matarife=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':nombre'=>$nombre));
        return $this->objetos;
        }
 function borrar($id){
        $sql="DELETE FROM matarife where id_matarife=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';
        }
        else{
            echo 'no borrado';
        }
    }
    function rellenar_matarife(){
        $sql="SELECT * FROM matarife order by nombre asc";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function rellenar_matarifecuit($id){
        $sql="SELECT cuit,nombre,id_matarife FROM matarife where id_matarife=:id
        order by nombre asc";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function fudepen_rellenar($id_matarife){
        $sql="SELECT nombre,cuit FROM `submatarife` WHERE id_matarife=:id
        order by nombre asc";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_matarife)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function cantidad_item(){
        $sql="SELECT submatarife.id_submatarife as id_submatarife,submatarife.nombre as nombre,submatarife.cuit as cuit, submatarife.identificador as identificador, matarife.nombre as matarife,submatarife.id_matarife as id_datos FROM submatarife JOIN matarife on submatarife.id_matarife=matarife.id_matarife where estado='A' ";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;            
    }
    function borraritem($id,$identificador){
        $sql="UPDATE submatarife SET estado='I' WHERE id_submatarife=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        echo'borrado';
        $sql="UPDATE matarife SET cantidad=cantidad-1 where id_matarife=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$identificador));
    }
    function ver_subitem($id){
        $sql="SELECT cantidad FROM `matarife` WHERE id_matarife=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function matarife_rellenar_sub($id){
        $sql="SELECT * FROM submatarife WHERE id_matarife=:id order by nombre asc";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
}
?>