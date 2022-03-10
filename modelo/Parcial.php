<?php
include 'conexion.php';
$datos= date_default_timezone_set('America/Argentina/Mendoza');
$fechahoy = date("Y-m-d");
class Parcial{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function buscar(){
        $sql="SELECT @ROW := @ROW + 1 as ID,especies.nombre as especie, subespeces.nombre as subespecies, enpie,kilosenpie, corral.nombre as corral, matarife.nombre as matarife,productor.nombre as productor,guia,destino.nombre as destino,destino.codigo as destinocodigo,numtropas, kilosenpie/enpie as promedio,CONCAT(faenas.desde,'-', faenas.hasta) as garron, faenas.estado as totalidad,id_ingresos as identificador,faenas.desde as desde,faenas.hasta as hasta,faenas.estado as estado,faenas.seleccionado, ingresos.matarife as id_matarife,subespeces.codigo as codigo,especies.id_especies_sub as id_especies FROM ingresos
        JOIN especies on especie=id_especies_sub
        JOIN subespeces on subespecie=id_subespecies
        JOIN corral on corral=id_corral
        JOIN matarife on matarife=id_matarife
        JOIN productor on productor=id_productor
        JOIN destino on destino=id_destino
        JOIN faenas on numtropas=tropa
        join (SELECT @ROW := 0) t2
        WHERE ingresos.etapa='FAENA_PARCIAL' and ano=year(curdate()) and parcialterminado='NO'
        LIMIT 100";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;

    }
    function buscarpdf($id){
        $sql="SELECT id_ingresos,especies.nombre as especie, subespeces.nombre as subespecies, enpie,kilosenpie, corral.nombre as corral, matarife.nombre as matarife,productor.nombre as productor,guia,destino.nombre as destino,numtropas, kilosenpie/enpie as promedio,CONCAT(faenas.desde,'-', faenas.hasta) as garron, faenas.estado as totalidad,id_ingresos as identificador FROM ingresos
        JOIN especies on especie=id_especies_sub
        JOIN subespeces on subespecie=id_subespecies
        JOIN corral on corral=id_corral
        JOIN matarife on matarife=id_matarife
        JOIN productor on productor=id_productor
        JOIN destino on destino=id_destino
        JOIN faenas on numtropas=tropa
        WHERE etapa='FAENA' and id_ingresos=:id
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
    function agregar($cantidad,$fecha){
        $sql="SELECT id FROM ultimo where fecha=:fecha";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':fecha'=>$fecha)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
          $sql="INSERT INTO ultimo(fecha,cantidad) values (:fecha,:cantidad);";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':fecha'=>$fecha,':cantidad'=>'0'));
          echo 'add';
        }
    }
    function buscarid($fecha){
        $sql="SELECT id FROM ultimo where fecha=:fecha";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':fecha'=>$fecha)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function ultimoid($fecha){
        $sql="SELECT cantidad FROM ultimo where fecha=:fecha";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':fecha'=>$fecha)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function traerdatos($cantidad,$fecha,$tropas){
        $sql="SELECT id,max(ultimo) as ultimo FROM faenas where fecha=:fecha and ultimo=:ultimo and tropa=:tropa";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':fecha'=>$fecha,':ultimo'=>$cantidad,':tropa'=>$tropas)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function crear($fecha,$tropa,$clasificacion,$cantidad,$desde,$hasta,$estado,$seleccionado){
        $sql="SELECT id FROM faenas where fecha=:fecha and cantidad=:cantidad and tropa=:tropa and desde=:desde and hasta=:hasta and clasificacion=:clasificacion";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':fecha'=>$fecha,':cantidad'=>$cantidad,':tropa'=>$tropa,':desde'=>$desde,':hasta'=>$hasta,':clasificacion'=>$clasificacion)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
        $sql="INSERT INTO faenas(fecha,cantidad,tropa,desde,hasta,clasificacion,estado,seleccionado) values (:fecha,:cantidad,:tropa,:desde,:hasta,:clasificacion,:estado,:seleccionado);";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':fecha'=>$fecha,':cantidad'=>$cantidad,':tropa'=>$tropa,':desde'=>$desde,':hasta'=>$hasta,':clasificacion'=>$clasificacion,':estado'=>$estado,':seleccionado'=>$seleccionado));
          echo 'add';
        }
    }
    function reemplazar($id,$cantidad,$fecha){
            $sql="UPDATE ultimo SET fecha=:fecha,cantidad=:cantidad where id=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':fecha'=>$fecha,':cantidad'=>$cantidad));
        }
        function reemplazarestado($tropa){
            $sql="UPDATE ingresos SET etapa=:etapa where numtropas=:numtropas";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':numtropas'=>$tropa,':etapa'=>'FAENA'));
        echo 'reemplazado';
        }
        function verificarparciales(){
            $sql="SELECT COUNT(etapa)as cantidad FROM `ingresos` WHERE etapa='FAENA_PARCIAL' and ano=year(curdate())";
            $query = $this->acceso->prepare($sql);
            $query->execute(); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function verificarfinalizados(){
            $sql="SELECT COUNT(etapa)as cantidad FROM `ingresos` WHERE etapa='FINALIZADO' and ano=year(curdate())";
            $query = $this->acceso->prepare($sql);
            $query->execute(); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function verreduccion($tropa){
            $sql="SELECT reducir.fecha as fecha, tropa,clasificacion,reducir.cantidad as cantidad,desde,hasta,faenados,reduccion,motivo,reducir.estado as estado,reducir.corral as corral,ingresos.fecha as fechaingreso FROM `reducir` 
            join ingresos on tropa=numtropas
            WHERE tropa=:tropa and year(reducir.fecha)=year(curdate())";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':tropa'=>$tropa)); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
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
        function buscarfaenados($tropa){
            $sql="SELECT max(garron) as maximo FROM `faenados` WHERE tropa=:tropa and ano=year(curdate()) and estado='PARCIAL'";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':tropa'=>$tropa)); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function buscarfaenadostotal($tropa){
            $sql="SELECT @ROW := @ROW + 1 as ID,especies.nombre as especie, subespeces.nombre as subespecies, enpie,kilosenpie, corral.nombre as corral, matarife.nombre as matarife,productor.nombre as productor,guia,destino.nombre as destino,numtropas, kilosenpie/enpie as promedio,CONCAT(faenas.desde,'-', faenas.hasta) as garron, faenas.estado as totalidad,id_ingresos as identificador,faenas.desde as desde,faenas.hasta as hasta,faenas.estado as estado,faenas.seleccionado FROM ingresos
            JOIN especies on especie=id_especies
            JOIN subespeces on subespecie=id_subespecies
            JOIN corral on corral=id_corral
            JOIN matarife on matarife=id_matarife
            JOIN productor on productor=id_productor
            JOIN destino on destino=id_destino
            JOIN faenas on numtropas=tropa
            join (SELECT @ROW := 0) t2
            WHERE tropa=:tropa and ingresos.ano=year(curdate())
            LIMIT 100";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':tropa'=>$tropa)); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function buscarfaenadosparcial($tropa){
            $sql="SELECT @ROW := @ROW + 1 as ID, enpie,faenas.hasta as hasta, corral.nombre as corral,numtropas,max(faenados.garron) as desde  FROM ingresos
            JOIN corral on corral=id_corral
            JOIN matarife on matarife=id_matarife
            JOIN faenados on numtropas=faenados.tropa
            JOIN faenas on numtropas=faenas.tropa
            join (SELECT @ROW := 0) t2
            WHERE faenas.tropa=:tropa and ingresos.ano=year(curdate())
            LIMIT 100";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':tropa'=>$tropa)); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function reducir($fecha,$tropa,$clasificacion,$cantidad,$desde,$hasta,$vuelven,$reduccion,$comienzo,$motivo,$estado,$corral){
            $sql="SELECT id_reducir FROM reducir where fecha=:fecha and tropa=:tropa and clasificacion=:clasificacion and cantidad=:cantidad and desde=:desde and hasta=:hasta";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':fecha'=>$fecha,':tropa'=>$tropa,':clasificacion'=>$clasificacion,':cantidad'=>$cantidad,':desde'=>$desde,':hasta'=>$hasta)); 
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'noadd';
            }
            else{
              $sql="INSERT INTO reducir(fecha,tropa,clasificacion,cantidad,desde,hasta,faenados,comienzo,reduccion,motivo,estado,corral) values (:fecha,:tropa,:clasificacion,:cantidad,:desde,:hasta,:faenados,:comienzo,:reduccion,:motivo,:estado,:corral);";
              $query = $this->acceso->prepare($sql);
              $query->execute(array(':fecha'=>$fecha,':tropa'=>$tropa,':clasificacion'=>$clasificacion,':cantidad'=>$cantidad,':desde'=>$desde,':hasta'=>$hasta,':faenados'=>$vuelven,':comienzo'=>$comienzo,':reduccion'=>$reduccion,':motivo'=>$motivo,':estado'=>$estado,':corral'=>$corral));
              echo 'add';
            }
        }
        function reducirparcial($fecha,$tropa,$clasificacion,$cantidad,$desde,$hasta,$vuelven,$reduccion,$comienzo,$motivo,$estado,$corral){
            $sql="SELECT id_reducir FROM reducir where fecha=:fecha and tropa=:tropa and clasificacion=:clasificacion and cantidad=:cantidad and desde=:desde and hasta=:hasta";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':fecha'=>$fecha,':tropa'=>$tropa,':clasificacion'=>$clasificacion,':cantidad'=>$cantidad,':desde'=>$desde,':hasta'=>$hasta)); 
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'noadd';
            }
            else{
              
              echo 'add';
            }
        }   
        function reemplazarestadoingresos($fecha,$tropa,$corral,$comienzo,$reduccion){
            $sql="SELECT id_ingresos FROM ingresos where ano=:ano and numtropas=:tropa";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':ano'=>$fecha,':tropa'=>$tropa)); 
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'add';
                $sql="UPDATE ingresos SET etapa='REDUCCION',corral=:corral where numtropas=:tropa and ano=:ano";
                $query=$this->acceso->prepare($sql);
                $query->execute(array(':ano'=>$fecha,':tropa'=>$tropa,':corral'=>$corral));
                $sql="UPDATE faenas SET estado='REDUCCION TOTAL',desde=:desde,seleccionado=:seleccionado where tropa=:tropa and year(fecha)=year(curdate())";
                $query=$this->acceso->prepare($sql);
                $query->execute(array(':tropa'=>$tropa,':desde'=>$comienzo,':seleccionado'=>$reduccion));
            }
            
            else{
              
              echo 'noadd';
            }
        }
        function procesoreducciontotal($fecha,$tropa,$matarife,$ano){
            $sql="INSERT INTO proceso(tropa,matarife,fecha,ano,estado) values (:tropa,:matarife,:fecha,:ano,:estado);";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':tropa'=>$tropa,':matarife'=>$matarife,':fecha'=>$fecha,':ano'=>$ano,':estado'=>'REDUCCION_TOTAL'));        
            echo 'noadd';
        
        }
        function procesoreduccionparcial($fecha,$tropa,$matarife,$ano){
            $sql="INSERT INTO proceso(tropa,matarife,fecha,ano,estado) values (:tropa,:matarife,:fecha,:ano,:estado);";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':tropa'=>$tropa,':matarife'=>$matarife,':fecha'=>$fecha,':ano'=>$ano,':estado'=>'REDUCCION_PARCIAL'));        
            echo 'noadd';
        
        }
        function reemplazarestadoingresosparcial($fecha,$tropa,$corral,$comienzo,$reduccion){
            $sql="SELECT id_ingresos FROM ingresos where ano=:ano and numtropas=:tropa";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':ano'=>$fecha,':tropa'=>$tropa)); 
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'add';
                $sql="UPDATE ingresos SET etapa='REDUCCION',corral=:corral where numtropas=:tropa and ano=:ano";
                $query=$this->acceso->prepare($sql);
                $query->execute(array(':ano'=>$fecha,':tropa'=>$tropa,':corral'=>$corral));
                $sql="UPDATE faenas SET estado='REDUCCION PARCIAL',desde=:desde,seleccionado=:seleccionado where tropa=:tropa and year(fecha)=year(curdate())";
                $query=$this->acceso->prepare($sql);
                $query->execute(array(':tropa'=>$tropa,':desde'=>$comienzo,':seleccionado'=>$reduccion));
            }
            else{
              
              echo 'noadd';
            }
        }
        function procesado($fecha,$tropa){
            $sql="SELECT id_faenados FROM faenados where ano=:ano and tropa=:tropa";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':ano'=>$fecha,':tropa'=>$tropa)); 
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'add';
            }
            else{
              
              echo 'noadd';
            }
        }
        function verfaenasparcial($tropa){
            $sql="SELECT id FROM `faenas` 
            join ingresos on tropa=numtropas
            WHERE tropa=:tropa and year(faenas.fecha)=year(curdate()) and ingresos.etapa='FAENA_PARCIAL'";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':tropa'=>$tropa)); 
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'add';
            }
            else{
              
              echo 'noadd';
            }
        }
        function guardarmatanza ($ano,$tropa,$garron,$peso,$especie,$fecha,$productor,$estado,$fechafaena,$fecha1,$id_especies,$fechacsv,$codigo,$destinocsv,$idultimo ){
            $sql="INSERT INTO faenados(ano,tropa,garron,peso,especie,fecha,productor,estado,etiqueta,fechafaena,fechaetiqueta,numespecie,fechacsv,codigocsv,destinocsv,codigobarras) values(:ano,:tropa,:garron,:peso,:especie,:fecha,:productor,:estado,:etiqueta,:fechafaena,:fechaetiqueta,:numespecie,:fechacsv,:codigocsv,:destinocsv,:codigobarras);";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':ano'=>$ano,':tropa'=>$tropa,':garron'=>$garron,':peso'=>$peso,':especie'=>$especie,':fecha'=>$fecha,':productor'=>$productor,':estado'=>$estado,':etiqueta'=>'etiqueta'.$tropa.$ano.$garron.$peso.'.png',':fechafaena'=>$fechafaena,':fechaetiqueta'=>$fecha1,':numespecie'=>$id_especies,':fechacsv'=>$fechacsv,':codigocsv'=>$codigo,':destinocsv'=>$destinocsv,':codigobarras'=>$idultimo.'.png')); 
              echo 'add';
        }
    
    function estadomatanza($ano,$tropa){
        $sql="UPDATE ingresos SET etapa='FINALIZADO' where ano=:ano and numtropas=:tropa";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':ano'=>$ano,':tropa'=>$tropa)); 
        echo 'reemplazado';
}
function estadomatanzaproceso($ano,$tropa,$matarife,$fecha){
    $sql="INSERT INTO proceso(tropa,matarife,fecha,ano,estado) values (:tropa,:matarife,:fecha,:ano,:estado);";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':tropa'=>$tropa,':matarife'=>$matarife,':fecha'=>$fecha,':ano'=>$ano,':estado'=>'FINALIZADO'));        
    echo 'reemplazado';
}

function matanzaestado($tropa,$desde,$hasta){
    $sql="SELECT parcialterminado as estado FROM faenas where tropa=:tropa and desde=:desde and hasta=:hasta";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':tropa'=>$tropa,':desde'=>$desde,':hasta'=>$hasta)); 
    $this->objetos=$query->fetchall();
    return $this->objetos;

}
function guardardatosfinalizados($desde,$hasta,$tropa){
    $sql="UPDATE faenas SET parcialterminado='SI' where year(fecha)=year(curdate()) and tropa=:tropa and desde=:desde and hasta=:hasta";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':tropa'=>$tropa,':desde'=>$desde,':hasta'=>$hasta)); 
    echo 'reemplazado';  

}
function buscarestadosfaenas($tropa){
    $sql="SELECT count(id)+1 as total FROM faenas where year(fecha)=year(curdate()) and tropa=:tropa and parcialterminado='SI'";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':tropa'=>$tropa)); 
    $this->objetos=$query->fetchall();
    return $this->objetos;

}
function cantidadbuscarestadosfaenas($tropa){
    $sql="SELECT count(id) as total FROM faenas where year(fecha)=year(curdate()) and tropa=:tropa";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':tropa'=>$tropa)); 
    $this->objetos=$query->fetchall();
    return $this->objetos;

}
function totalparafaenar($tropa){
    $sql="SELECT cantidad-SUM(seleccionado) as total  FROM faenas where year(fecha)=year(curdate()) and tropa=:tropa";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':tropa'=>$tropa)); 
    $this->objetos=$query->fetchall();
    return $this->objetos;

}
function procesadofaenados($tropa){
    $sql="SELECT  max(garron)+1 as total FROM faenados WHERE tropa=:tropa and year(fecha)=year(curdate())";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':tropa'=>$tropa)); 
    $this->objetos=$query->fetchall();
    return $this->objetos;

}

}
?>