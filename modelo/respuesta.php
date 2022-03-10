<?php
include_once 'conexion.php';
class Respuesta{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function read($id_pregunta){
            $sql="SELECT respuesta.id as id,respuesta.contenido as contenido,respuesta.fecha_creacion as fecha_creacion,respuesta.estado as estado,id_pregunta, concat(usuario.nombre_us,' ',usuario.apellidos_us,'(',usuario.secretaria,')') as nombre_usuario,usuario.avatar as avatar_usuario,respuesta.respuesta as usuario FROM respuesta
            JOIN pregunta on pregunta.id=id_pregunta
            JOIN usuario on pregunta.id_usuario=usuario.id_usuario
            WHERE respuesta.id_pregunta=:id_pregunta and respuesta.estado='A'";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id_pregunta' => $id_pregunta)); 
            $this->objetos=$query->fetchAll();
            return $this->objetos;
    }
    function create($resp,$id_pregunta,$respuesta_usuario){
        $sql="INSERT INTO respuesta(contenido,id_pregunta,respuesta)VALUES (:contenido,:id_pregunta,:respuesta)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':contenido'=>$resp,':id_pregunta'=>$id_pregunta,':respuesta'=>$respuesta_usuario)); 
        $sql="UPDATE pregunta SET respuesta=:respuesta where id=:id_pregunta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':respuesta'=>'1',':id_pregunta'=>$id_pregunta)); 
    }
    function llenar_productos($id_pregunta){
        $sql="SELECT ingresos.numtropas as tropa,matarife.avatar as imagen FROM `pregunta` JOIN ingresos on pregunta.id_ingresos=ingresos.id_ingresos JOIN matarife on ingresos.matarife=id_matarife WHERE pregunta.id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_pregunta)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function llenar_productos1($id_ingresos){
        $sql="SELECT numtropas as tropas,matarife.nombre as matarife,matarife.avatar as imagen FROM `ingresos` 
        JOIN matarife on matarife=id_matarife
        WHERE id_ingresos=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_ingresos)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function productor_tropas($id_usuario){
        $sql="SELECT numtropas FROM `ingresos`
        JOIN usuario on matarife= id_matarife WHERE usuario.id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario)); 
        $this->objetos=$query->fetchAll();
        return $this->objetos;
    }
    function tropas_rellenar($id_usuario){
        $sql="SELECT numtropas as tropa,fecha FROM `ingresos` where matarife=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario)); 
        $this->objetos=$query->fetchAll();
        return $this->objetos;
    }
}
