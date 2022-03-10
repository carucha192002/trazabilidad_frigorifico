<?php
include_once 'conexion.php';
class Usuario{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }
 function Loguearse($dni,$pass){
    $sql="SELECT * FROM usuario INNER JOIN tipo_us ON us_tipo=id_tipo_us WHERE dni_us=:dni";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':dni'=>$dni));
    $objetos = $query->fetchall();
    foreach ($objetos as $objeto) {
      $contrasena_actual = $objeto->contrasena_us;
    }
      if(strpos($contrasena_actual,'$2y$10$')===0){
        if(password_verify($pass,$contrasena_actual)){
          return "logueado";  
            
        }        
      }
      else{
        if($pass==$contrasena_actual){  
          return "logueado";          
        }       
      }
    }
function obtener_dato_logueo($dni){
      $sql="SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us and dni_us=:dni";
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':dni'=>$dni));
      $this->objetos = $query->fetchall();
      return $this->objetos;
    }
function obtener_datos($id){
    $sql="SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us and id_usuario=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $this->objetos = $query->fetchall();
    return $this->objetos;
  }
function editar($id_usuario,$telefono,$domicilio,$email,$sexo,$adicional,$secretaria,$fnacimiento){
    $sql="UPDATE usuario SET telefono_us=:telefono,domicilio_us=:domicilio,email_us=:email,sexo_us=:sexo,adicional_us=:adicional,secretaria=:secretaria,edad=:edad where id_usuario=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id_usuario,':telefono'=>'549'.$telefono,':domicilio'=>$domicilio,':email'=>$email,':sexo'=>$sexo,':adicional'=>$adicional,':secretaria'=>$secretaria,':edad'=>$fnacimiento));
}
function cambiar_contra($id_usuario,$oldpass,$newpass){
  $sql="SELECT * FROM usuario where id_usuario=:id";
  $query = $this->acceso->prepare($sql);
  $query->execute(array(':id'=>$id_usuario));
  $this->objetos = $query->fetchall();
  foreach ($this->objetos as $objeto) {
    $contrasena_actual = $objeto->contrasena_us;
  }
    if(strpos($contrasena_actual,'$2y$10$')===0){
      if(password_verify($oldpass,$contrasena_actual)){
        $pass = password_hash($newpass,PASSWORD_BCRYPT,['cost'=>10]);
        $sql="UPDATE usuario SET contrasena_us=:newpass where id_usuario=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':newpass'=>$pass));
        echo 'update';
      }
      else{
        echo 'noupdate';
      }
    }
    else{
      if($oldpass==$contrasena_actual){
        $pass = password_hash($newpass,PASSWORD_BCRYPT,['cost'=>10]);
        $sql="UPDATE usuario SET contrasena_us=:newpass where id_usuario=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':newpass'=>$pass));
        echo 'update';
      }
      else{
        echo 'noupdate';
      }
    }
  }
 
function cambiar_photo($id_usuario,$nombre){
  $sql="SELECT avatar FROM usuario where id_usuario=:id";
  $query = $this->acceso->prepare($sql);
  $query->execute(array(':id'=>$id_usuario));
  $this->objetos = $query->fetchall();

      $sql="UPDATE usuario SET avatar=:nombre where id_usuario=:id";
      $query=$this->acceso->prepare($sql);
      $query->execute(array(':id'=>$id_usuario,':nombre'=>$nombre));
  return $this->objetos;
  }
  function buscar(){
    if(!empty($_POST['consulta'])){
       $consulta=$_POST['consulta'];
       $sql="SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us where nombre_us LIKE :consulta";
       $query = $this->acceso->prepare($sql);
       $query->execute(array(':consulta'=>"%$consulta%")); 
       $this->objetos=$query->fetchall();
       return $this->objetos;
    }
    else{
      $sql="SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us where nombre_us NOT LIKE '' ORDER BY id_usuario LIMIT 50";
      $query = $this->acceso->prepare($sql);
      $query->execute(); 
      $this->objetos=$query->fetchall();
      return $this->objetos;
    }
  }
  function crear($nombre,$apellido,$edad,$dni,$pass,$rol,$rolnombre,$avatar){
      $sql="SELECT id_usuario FROM usuario where dni_us=:dni";
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':dni'=>$dni)); 
      $this->objetos=$query->fetchall();
      if(!empty($this->objetos)){
          echo 'noadd';
      }
      else{
        $sql="INSERT INTO usuario(nombre_us,apellidos_us,edad,dni_us,contrasena_us,us_tipo,secretaria,avatar) VALUES (:nombre,:apellido,:edad,:dni,:contrasena,:tipo,:secretaria,:avatar);";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre,':apellido'=>$apellido,':edad'=>$edad,':dni'=>$dni,':contrasena'=>$pass,':tipo'=>$rol,':secretaria'=>$rolnombre,':avatar'=>$avatar));
        echo 'add';
      }
  }
  function ascender($pass,$id_ascendido,$id_usuario,$rol,$rolnombre){
    $sql="SELECT * FROM usuario where id_usuario=:id_usuario";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id_usuario'=>$id_usuario)); 
    $this->objetos=$query->fetchall();
    foreach ($this->objetos as $objeto) {
      $contrasena_actual = $objeto->contrasena_us;
    }
    
      if(strpos($contrasena_actual,'$2y$10$')===0){
        if(password_verify($pass,$contrasena_actual)){
        
        $sql="UPDATE usuario SET us_tipo=:tipo,,secretaria=:secretaria where id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_ascendido,':tipo'=>$rol,':secretaria'=>$rolnombre));
        echo 'ascendido';
    }
    else{
        echo 'noascendido';
    }
  }
  else{
    if($pass==$contrasena_actual){ 
      $sql="UPDATE usuario SET us_tipo=:tipo,secretaria=:secretaria where id_usuario=:id";
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':id'=>$id_ascendido,':tipo'=>$rol,':secretaria'=>$rolnombre));
    echo 'ascendido';          
}
else{
echo 'noascendido';;
}        
} 
}
  function descender($pass,$id_descendido,$id_usuario,$rol,$rolnombre){
    $sql="SELECT * FROM usuario where id_usuario=:id_usuario";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id_usuario'=>$id_usuario)); 
    $this->objetos=$query->fetchall();
    foreach ($this->objetos as $objeto) {
      $contrasena_actual = $objeto->contrasena_us;
    }
      if(strpos($contrasena_actual,'$2y$10$')===0){
        if(password_verify($pass,$contrasena_actual)){
            $sql="UPDATE usuario SET us_tipo=:tipo,secretaria=:secretaria where id_usuario=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_descendido,':tipo'=>$rol,':secretaria'=>$rolnombre));
          echo 'descendido';   
    }
    else{
      echo 'nodescendido';
    }

  }
  else{
          if($pass==$contrasena_actual){ 
            $sql="UPDATE usuario SET us_tipo=:tipo,secretaria=:secretaria where id_usuario=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_descendido,':tipo'=>$rol,':secretaria'=>$rolnombre));
          echo 'descendido';          
    }
    else{
      echo 'nodescendido';;
    }        
  } 
}
  function borrar($pass,$id_borrado,$id_usuario){
    $sql="SELECT * FROM usuario where id_usuario=:id_usuario";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id_usuario'=>$id_usuario)); 
    $this->objetos=$query->fetchall();
    foreach ($this->objetos as $objeto) {
      $contrasena_actual = $objeto->contrasena_us;
    }
      if(strpos($contrasena_actual,'$2y$10$')===0){
        if(password_verify($pass,$contrasena_actual)){
          $sql="DELETE FROM usuario where id_usuario=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':id'=>$id_borrado));
          echo 'borrado';        
        }
        else{
          echo 'noborrado';
        }        
      }
      else{
        if($pass==$contrasena_actual){  
          $sql="DELETE FROM usuario where id_usuario=:id";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':id'=>$id_borrado));
          echo 'borrado';        
        }
        else{
          echo 'noborrado';
        }        
      }   
    } 
    function devolver_avatar($id_usuario){
      $sql="SELECT avatar FROM usuario where id_usuario=:id_usuario";
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':id_usuario'=>$id_usuario)); 
      $this->objetos=$query->fetchall();
      return $this->objetos;
    }
    function rellenar_rol(){
      $sql="SELECT * FROM tipo_us order by nombre_tipo asc";
      $query = $this->acceso->prepare($sql);
      $query->execute();
      $this->objetos = $query->fetchall();
      return $this->objetos;
  }
  function rellenar_rol1(){
    $sql="SELECT * FROM tipo_us where id_tipo_us!=3 order by nombre_tipo";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchall();
    return $this->objetos;
}
function rellenar_rol_modal($id){
  $sql="SELECT * FROM tipo_us where id_tipo_us=:id order by nombre_tipo";
  $query = $this->acceso->prepare($sql);
  $query->execute(array(':id'=>$id));
  $this->objetos = $query->fetchall();
  return $this->objetos;
}
function verificar($email,$dni){
  $sql="SELECT * FROM usuario where email_us=:email and dni_us=:dni";
  $query = $this->acceso->prepare($sql);
  $query->execute(array(':email'=>$email,':dni'=>$dni));
  $this->objetos = $query->fetchall();
  if(!empty($this->objetos)){
    if($query->rowCount()==1){
      echo 'encontrado';
    }
    else{
      echo 'noencontrado';
    }
  }
  else{
    echo 'noencontrado';
  }
}

function reemplazar($codigo,$email,$dni){
  $sql="UPDATE usuario SET contrasena_us=:codigo where email_us=:email and dni_us=:dni";
  $query = $this->acceso->prepare($sql);
  $query->execute(array(':codigo'=>$codigo,':email'=>$email,':dni'=>$dni));
 
}
function ver_mail($id_usuario){
  $sql="SELECT email_us FROM usuario where id_usuario=:id";
  $query = $this->acceso->prepare($sql);
  $query->execute(array(':id' => $id_usuario));
  $this->objetos = $query->fetchall();
  return $this->objetos;

}
function cambiar_email($email,$id_usuario){
  $sql="UPDATE usuario SET email_us=:email where id_usuario=:id";
  $query = $this->acceso->prepare($sql);
  $query->execute(array(':id'=>$id_usuario,':email'=>$email));
echo 'cambiado';        
   
} 
}
?>

