<?php
include_once 'conexion.php';
class Pregunta{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function read($id_ingresos){
            $sql="SELECT pregunta.id as id,
            contenido, pregunta.fecha_creacion as fecha_creacion,pregunta.respuesta as estado_respuesta,
            usuario.id_usuario as id_usuario,concat(usuario.nombre_us,' ',usuario.apellidos_us,'(',tipo_us.nombre_tipo,')') as usuario,usuario.avatar as avatar
            FROM pregunta 
            JOIN usuario on pregunta.id_usuario=usuario.id_usuario
            JOIN tipo_us on usuario.us_tipo=id_tipo_us
            WHERE id_ingresos=:id_ingresos and pregunta.estado='A' ORDER BY pregunta.fecha_creacion DESC";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id_ingresos' => $id_ingresos)); 
            $this->objetos=$query->fetchAll();
            return $this->objetos;
    }
    function create($pgt,$id_ingresos,$id_usuario){
        $sql="INSERT INTO pregunta(contenido,id_ingresos,id_usuario)VALUES (:contenido,:id_ingresos,:id_usuario)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':contenido'=>$pgt,':id_ingresos'=>$id_ingresos,':id_usuario'=>$id_usuario)); 
    }
function read_propietario_pregunta($id_pregunta){
    $sql="SELECT pregunta.id_usuario as id FROM `pregunta` WHERE id=:id_pregunta and estado='A'";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id_pregunta' => $id_pregunta)); 
    $this->objetos=$query->fetchAll();
    return $this->objetos;
}
function productor_root(){
    $sql="SELECT concat(nombre_us,' ', apellidos_us) as nombre,id_usuario,avatar FROM `usuario` WHERE us_tipo=3";
    $query = $this->acceso->prepare($sql);
    $query->execute(); 
    $this->objetos=$query->fetchAll();
    return $this->objetos;
}

}
