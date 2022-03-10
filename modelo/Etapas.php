<?php
include 'conexion.php';
class Etapas{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }

function rellenar_etapas(){
        $sql="SELECT COUNT(id_ingresos)as cantidad FROM `ingresos` WHERE etapa='INGRESO' and ano=year(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function procesarfaena(){
        $sql="SELECT COUNT(id_ingresos)as cantidad FROM `ingresos` WHERE etapa='FAENA'";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function reduciretapas(){
        $sql="SELECT COUNT(id_ingresos)as cantidad FROM `ingresos` WHERE etapa='REDUCCION'and ano=year(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
}
?>