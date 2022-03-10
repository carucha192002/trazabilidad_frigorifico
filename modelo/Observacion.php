<?php
include_once 'conexion.php';
$datos= date_default_timezone_set('America/Argentina/Mendoza');
$fechahoy = date("Y-m-d");
class Observacion{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }

function buscargarronfaenadostropas(){
    $sql="SELECT id_faenados,faenados.tropa as tropa,especie,garron,peso,productor,faenas.id_matarife as matarife,faenados.fecha as fechafaena,faenas.Dte as dte,observacion_garron FROM `faenados` 
    join faenas on faenados.tropa=faenas.tropa
    WHERE observacion_garron='SI'";
    $query = $this->acceso->prepare($sql);
    $query->execute(); 
    $this->objetos=$query->fetchall();
    return $this->objetos;
}
function observacion_foto($id){
    $sql="SELECT * FROM `imagen` WHERE id_decomiso=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array('id'=>$id)); 
    $this->objetos=$query->fetchall();
    return $this->objetos;
}
function buscarpdf($id){
    $sql="SELECT id_faenados,faenados.tropa as tropa,especie,garron,peso,productor,faenas.id_matarife as matarife,faenados.fecha as fechafaena,faenas.Dte as dte,observacion_garron FROM `faenados` 
    join faenas on faenados.tropa=faenas.tropa
    WHERE observacion_garron='SI' and id_faenados=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id)); 
    $this->objetos=$query->fetchall();
    return $this->objetos;
}
function buscardatos($id){
    $sql="SELECT id_faenados,faenados.tropa as tropa,especie,garron,peso,productor,faenas.id_matarife as matarife,faenados.fecha as fechafaena,faenas.Dte as dte,observacion_garron,imagen.descripcion as descripcion,imagen.fecha_creacion as fecha, imagen.foto as foto FROM `faenados` join faenas on faenados.tropa=faenas.tropa JOIN imagen on id_faenados=id_decomiso WHERE observacion_garron='SI' and id_faenados=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id)); 
    $this->objetos=$query->fetchall();
    return $this->objetos;
}
}
?>