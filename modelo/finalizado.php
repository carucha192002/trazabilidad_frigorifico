<?php
include_once 'conexion.php';
$datos= date_default_timezone_set('America/Argentina/Mendoza');
$fechahoy = date("Y-m-d");
class finalizado{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function buscar(){
        $sql="SELECT @ROW := @ROW + 1 as ID,especies.nombre as especie, subespeces.nombre as subespecies, enpie,ingresos.kilosenpie as kilosenpie, corral.nombre as corral, matarife.nombre as matarife,productor.nombre as productor,guia,destino.nombre as destino,numtropas, ingresos.kilosenpie/enpie as promedio,CONCAT(min(faenados.garron),'-', max(faenados.garron)) as garron, faenas.estado as totalidad,id_ingresos as identificador,min(faenados.garron) as desde,max(faenados.garron) as hasta,faenas.estado as estado,faenas.cantidad as seleccionado,ingresos.etapa as finalizado,matarife.id_matarife as id_matarife,ingresos.etiqueta as etiqueta,faenas.fecha,ingresos.conservacion as conservacion,conservacion.nombre as conservacionnombre FROM ingresos
        JOIN especies on especie=id_especies_sub
        JOIN subespeces on subespecie=id_subespecies
        JOIN corral on corral=id_corral
        JOIN matarife on ingresos.matarife=matarife.id_matarife
        JOIN productor on productor=id_productor
        JOIN destino on destino=id_destino
        JOIN faenas on id_ingresos=faenas.id_ingreso
        JOIN conservacion on ingresos.conservacion=id_conservacion
        join faenados on id_ingresos=faenados.id_ingreso
        join (SELECT @ROW := 0) t2
        WHERE ingresos.etapa='FINALIZADO' GROUP by(ingresos.id_ingresos)";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function datos($id_ingresos){
        $sql="SELECT id_faenados FROM `faenados` WHERE id_ingreso=:id;";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_ingresos)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function datos_qr($id_ingresos){
        $sql="SELECT faenados.id_faenados,faenados.tropa as tropa,garron,peso,especie,productor,faenados.estado as estado,faenas.hasta as maximo,faenas.id_matarife as nombrematarife FROM `faenados` JOIN faenas on faenados.id_ingreso=faenas.id_ingreso WHERE faenados.id_ingreso=:id;";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_ingresos)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscarpdf($id){
        $sql="SELECT id_ingresos,especies.nombre as especie, subespeces.nombre as subespecies, enpie,kilosenpie, corral.nombre as corral, matarife.nombre as matarife,productor.nombre as productor,guia,destino.nombre as destino,numtropas, kilosenpie/enpie as promedio,CONCAT(faenas.desde,'-', faenas.hasta) as garron, faenas.estado as totalidad,id_ingresos as identificador,ingresos.etapa as finalizado FROM ingresos
        JOIN especies on especie=id_especies
        JOIN subespeces on subespecie=id_subespecies
        JOIN corral on corral=id_corral
        JOIN matarife on matarife=id_matarife
        JOIN productor on productor=id_productor
        JOIN destino on destino=id_destino
        JOIN faenas on numtropas=tropa
        WHERE etapa='FINALIZADO' and id_ingresos=:id
        LIMIT 100";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function verificar($cantidad,$fecha){
        $sql="SELECT id FROM ultimo where fecha=:fecha";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':fecha'=>$fecha)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
          echo 'add';
        }
    }
    
  
        function verificarcorrales(){
            $sql="SELECT corral.nombre as corral,enpie as cantidad, especies.nombre as especie,subespeces.nombre as subespecie FROM `ingresos` 
            JOIN corral on corral=id_corral
            JOIN especies on especie=id_especies
            JOIN subespeces on subespecie=id_subespecies
            WHERE etapa='INGRESO' order by corral asc";
            $query = $this->acceso->prepare($sql);
            $query->execute(); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function facturacion($id){
            $sql="SELECT @ROW := @ROW + 1 as ID, faenados.garron as garron,faenados.peso as peso,faenados.ano as ano, destino.nombre as destino,ingresos.kilosenpie as kilos FROM ingresos
            join destino on destino=id_destino
            JOIN faenados on id_ingresos=id_ingreso
            join (SELECT @ROW := 0) t2
            WHERE etapa='FINALIZADO' and id_ingresos=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id)); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function facturacion1($id){
            $sql="SELECT @ROW := @ROW + 1 as ID, faenados.garron as garron,faenados.peso as peso,faenados.ano as ano,id_ingresos,especies.nombre as especie, subespeces.nombre as subespecies, enpie,ingresos.kilosenpie as kilosenpie, corral.nombre as corral,concat(matarife.nombre,' ', submatarife.nombre) as matarife,productor.nombre as productor,productor.establecimiento as establecimiento,guia,destino.nombre as destino,numtropas, ingresos.kilosenpie/enpie as promedio, faenas.estado as totalidad,id_ingresos as identificador,ingresos.etapa as finalizado,faenas.fecha as faenafecha,transporte.nombre as transporte,chofer.nombre as chofer,faenas.desde as desde,faenas.hasta as hasta FROM ingresos
            JOIN especies on especie=id_especies_sub
            JOIN subespeces on subespecie=id_subespecies
            JOIN corral on corral=id_corral
            JOIN matarife on matarife=id_matarife
            JOIN productor on productor=id_productor
            JOIN destino on destino=id_destino
            JOIN faenas on id_ingresos=faenas.id_ingreso
             JOIN faenados on id_ingresos=faenados.id_ingreso
             JOIN submatarife on ingresos.matarifesub_item=submatarife.id_submatarife
             JOIN transporte on llenartransporte=id_transporte
             JOIN chofer on llenarchofer=id_chofer
            WHERE ingresos.etapa='FINALIZADO' and id_ingresos=:id GROUP by(faenados.garron)";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id)); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
 
        function facturacion11($id,$fecha,$id_ingreso){
           
            $sql="SELECT @ROW := @ROW + 1 as ID, faenados.garron as garron,faenados.peso as peso,faenados.ano as ano,id_ingresos,especies.nombre as especie, subespeces.nombre as subespecies, enpie,ingresos.kilosenpie as kilosenpie, corral.nombre as corral,concat(matarife.nombre,' ', submatarife.nombre) as matarife,productor.nombre as productor,productor.establecimiento as establecimiento,guia,destino.nombre as destino,numtropas, ingresos.kilosenpie/enpie as promedio, faenas.estado as totalidad,id_ingresos as identificador,ingresos.etapa as finalizado,faenas.fecha as faenafecha,transporte.nombre as transporte,chofer.nombre as chofer,faenas.desde as desde,faenas.hasta as hasta,ingresos.tci as tci FROM ingresos
            JOIN especies on especie=id_especies_sub
            JOIN subespeces on subespecie=id_subespecies
            JOIN corral on corral=id_corral
            JOIN matarife on matarife=id_matarife
            JOIN productor on productor=id_productor
            JOIN destino on destino=id_destino
           JOIN faenas on id_ingresos=faenas.id_ingreso
              JOIN faenados on id_ingresos=faenados.id_ingreso
             JOIN submatarife on ingresos.matarifesub_item=submatarife.id_submatarife
             JOIN transporte on llenartransporte=id_transporte
             JOIN chofer on llenarchofer=id_chofer
            WHERE ingresos.etapa='FINALIZADO' and id_ingresos=:id GROUP by(faenados.garron)";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_ingreso)); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function agregarconservacion($id,$respuesta){
            $sql="UPDATE faenados SET despiece=:despiece where id_ingreso=:id and ano=year(curdate())";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':despiece'=>$respuesta));
            echo 'edit';
        }
        function agregar_barra($text){
            $sql="UPDATE faenados SET codigobarras=:codigobarras where id_faenados=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$text,':codigobarras'=>$text.'.png'));
            echo 'edit';
        }
        function agregar_qr($id,$etiqueta){
            $sql="UPDATE faenados SET etiqueta=:etiqueta where id_faenados=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':etiqueta'=>$etiqueta));
            echo 'edit';
        }
        function tipo($id_ingresos){
            $sql="SELECT numespecie as especie FROM `faenados` where id_ingreso=:id GROUP by numespecie";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_ingresos)); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function buscarconservacion1($especie){
            $sql="SELECT codigo FROM `despieces` WHERE espeice=:especie and despiece='Entero/Carcasa'";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':especie'=>$especie)); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function buscarconservacion($especie){
            $sql="SELECT codigo FROM `despieces` WHERE espeice=:especie and despiece='Entero/Carcasa'";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':especie'=>$especie)); 
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'add';
            }
            else{
           echo 'noadd';
            }
        }
        function verificardatos($id){
            $sql="SELECT despiece FROM `faenados` WHERE id_ingreso=:id group by(tropa)";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id)); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function rellenar_cuarteados($especie){
            $sql="SELECT * FROM despieces  WHERE espeice=:especie
            order by espeice asc";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':especie'=>$especie)); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
}
?>