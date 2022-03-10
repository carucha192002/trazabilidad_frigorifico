<?php
include 'conexion.php';
class Base{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function crear($day,$dbname,$usuario,$fecha){
        $sql="INSERT INTO backup(dia,nombre,usuario,fecha) values(:dia,:nombre,:usuario,:fecha)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':dia'=>$day,':nombre'=>$dbname,':usuario'=>$usuario,':fecha'=>$fecha)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'guardado';
        }
    }
    function buscar(){
        $sql="SELECT id_backup,dia,nombre,concat(usuario.nombre_us, usuario.apellidos_us) as usuario,fecha FROM `backup`
        join usuario on usuario=id_usuario";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscarultimo(){
        $sql="SELECT max(id_backup) as id_backup,dia,nombre,concat(usuario.nombre_us, usuario.apellidos_us) as usuario,max(fecha) as fecha FROM `backup`
        join usuario on usuario=id_usuario";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
  
}
?>