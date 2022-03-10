<?php
include_once 'conexion.php';
class Etiquetas{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function buscar(){
        if(!empty($_POST['consulta'])){
           $consulta=$_POST['consulta'];
           $sql="SELECT ingresos.ano as ano,faenas.desde as desde,faenas.hasta as hasta,id_ingresos,especies.nombre as especie, subespeces.nombre as subespecies, enpie,ingresos.kilosenpie as kilosenpie, corral.nombre as corral, matarife.nombre as matarife,productor.nombre as productor,guia,destino.nombre as destino,numtropas, ingresos.kilosenpie/enpie as promedio, faenas.estado as totalidad,id_ingresos as identificador,ingresos.etapa as finalizado,matarife.avatar as avatar FROM ingresos JOIN especies on especie=id_especies JOIN subespeces on subespecie=id_subespecies JOIN corral on corral=id_corral JOIN matarife on matarife=id_matarife JOIN productor on productor=id_productor JOIN destino on destino=id_destino JOIN faenas on id_ingresos=faenas.id_ingreso JOIN faenados on id_ingresos=faenados.id_ingreso and ingresos.numtropas  like :consulta WHERE faenados.salio='NO' GROUP by(id_ingresos)";
           $query = $this->acceso->prepare($sql);
           $query->execute(array(':consulta'=>"%$consulta%")); 
           $this->objetos=$query->fetchall();
           return $this->objetos;
        }
        else{            
          $sql="SELECT ingresos.ano as ano,faenas.desde as desde,faenas.hasta as hasta,id_ingresos,especies.nombre as especie, subespeces.nombre as subespecies, enpie,ingresos.kilosenpie as kilosenpie, corral.nombre as corral, matarife.nombre as matarife,productor.nombre as productor,guia,destino.nombre as destino,numtropas, ingresos.kilosenpie/enpie as promedio, faenas.estado as totalidad,id_ingresos as identificador,ingresos.etapa as finalizado,matarife.avatar as avatar FROM ingresos JOIN especies on especie=id_especies JOIN subespeces on subespecie=id_subespecies JOIN corral on corral=id_corral JOIN matarife on matarife=id_matarife JOIN productor on productor=id_productor JOIN destino on destino=id_destino JOIN faenas on id_ingresos=faenas.id_ingreso JOIN faenados on id_ingresos=faenados.id_ingreso and ingresos.numtropas not like '' WHERE faenados.salio='NO' GROUP by (id_ingresos);";
          $query = $this->acceso->prepare($sql);
          $query->execute(); 
          $this->objetos=$query->fetchall();
          return $this->objetos;
        }
    }
    function agregaretiqueta($id,$id_ingresos,$ano,$guia,$especie,$subespecies,$matarife){
        $sql="UPDATE ingresos SET etiqueta=:etiqueta where id_ingresos=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_ingresos,':etiqueta'=>'etiqueta'.$ano.$id.'.png'));
        echo 'edit';
    }
    function buscarsiexisteetiqueta($id_ingresos){
        $sql="SELECT etiqueta  FROM ingresos where id_ingresos=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_ingresos)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
 
    function Etiqueta_refrigerado($id){
        $sql="SELECT faenados.garron as garron,faenados.peso as peso,faenados.ano as ano,id_ingresos,especies.nombre as especie, subespeces.nombre as subespecies, enpie,ingresos.kilosenpie as kilosenpie, corral.nombre as corral, matarife.nombre as matarife,productor.nombre as productor,guia,destino.nombre as destino,numtropas, ingresos.kilosenpie/enpie as promedio, faenas.estado as totalidad,id_ingresos as identificador,ingresos.etapa as finalizado,matarife.avatar as avatar,faenados.etiqueta as etiqueta,faenados.fechafaena as fechafaena,faenados.fechaetiqueta as fechaetiqueta,faenados.codigobarras as codigobarras FROM ingresos
        JOIN especies on especie=id_especies_sub
        JOIN subespeces on subespecie=id_subespecies
        JOIN corral on corral=id_corral
        JOIN matarife on matarife=id_matarife
        JOIN productor on productor=id_productor
        JOIN destino on destino=id_destino
        JOIN faenas on id_ingresos=faenas.id_ingreso 
         JOIN faenados on id_ingresos=faenados.id_ingreso 
         WHERE ingresos.id_ingresos=:id GROUP by(garron)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function Etiqueta_observacion($id){
        $sql="SELECT conservacion FROM `ingresos` WHERE id_ingresos=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }

    
    function Etiqueta($id){
        $sql="SELECT faenados.garron as garron,faenados.peso as peso,faenados.ano as ano,id_ingresos,especies.nombre as especie, subespeces.nombre as subespecies, enpie,ingresos.kilosenpie as kilosenpie, corral.nombre as corral, matarife.nombre as matarife,productor.nombre as productor,guia,destino.nombre as destino,numtropas, ingresos.kilosenpie/enpie as promedio, faenas.estado as totalidad,id_ingresos as identificador,ingresos.etapa as finalizado,matarife.avatar as avatar,faenados.etiqueta as etiqueta,faenados.fechafaena as fechafaena,faenados.fechaetiqueta as fechaetiqueta,faenados.codigobarras as codigobarras FROM ingresos
        JOIN especies on especie=id_especies_sub
        JOIN subespeces on subespecie=id_subespecies
        JOIN corral on corral=id_corral
        JOIN matarife on matarife=id_matarife
        JOIN productor on productor=id_productor
        JOIN destino on destino=id_destino
        JOIN faenas on id_ingresos=faenas.id_ingreso 
         JOIN faenados on id_ingresos=faenados.id_ingreso 
         WHERE ingresos.id_ingresos=:id GROUP by(garron)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
}
?>
