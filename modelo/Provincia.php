<?php
include 'conexion.php';
class Provincia{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function rellenar_provincia(){
        $sql="SELECT * FROM provincias order by nombre asc";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function rellenar_localidades($id_provincia){
        $sql="SELECT * FROM localidades where id_provincia=:id_provincia order by nombre asc";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_provincia'=>$id_provincia)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }

}
?>