<?php
include_once 'conexion.php';
class Notificacion{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function create($titulo,$asunto,$pgt,$imagen,$url,$id_propietario_tienda){
        $sql="INSERT INTO notificacion(titulo,asunto,contenido,imagen,url_1,id_usuario)VALUES (:titulo,:asunto,:contenido,:imagen,:url_1,:id_usuario)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':titulo'=>$titulo,':asunto'=>$asunto,':contenido'=>$pgt,':imagen'=>$imagen,':url_1'=>$url,':id_usuario'=>$id_propietario_tienda)); 
    }
    function read_root(){
        $sql="SELECT concat(usuario.nombre_us,' ',usuario.apellidos_us) as usuario,contenido,fecha_creacion,id,pregunta.id_usuario as id_usuario,usuario.avatar as imagen,ingresos.numtropas as tropas,ingresos.id_ingresos as ingresos FROM `pregunta` 
        JOIN usuario on pregunta.id_usuario=usuario.id_usuario 
        JOIN ingresos on pregunta.id_ingresos=ingresos.id_ingresos
        WHERE pregunta.estado='A' and respuesta='0' ORDER by fecha_creacion DESC";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchAll();
        return $this->objetos;
}
    function read($id_usuario){
        $sql="SELECT * FROM `notificacion` WHERE notificacion.id_usuario=:id and notificacion.estado='A' and notificacion.estado_abierto='0' ORDER BY notificacion.fecha_creacion DESC";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id_usuario)); 
        $this->objetos=$query->fetchAll();
        return $this->objetos;
}
        function read_all_notificaciones(){
            $sql="SELECT * FROM `notificacion` WHERE notificacion.estado='A' ORDER BY notificacion.fecha_creacion DESC";
            $query = $this->acceso->prepare($sql);
            $query->execute(); 
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }
        function read_all_notificaciones_usuario($id_usuario){
            $sql="SELECT * FROM `notificacion` WHERE id_usuario=:id and notificacion.estado='A' ORDER BY notificacion.fecha_creacion DESC";
            $query = $this->acceso->prepare($sql);
            $query->execute(array('id' => $id_usuario)); 
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }
    function update_estado_abierto($id_noti){
        $sql="UPDATE notificacion SET estado_abierto=1 where id=:id_noti";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_noti'=>$id_noti)); 
}
}
