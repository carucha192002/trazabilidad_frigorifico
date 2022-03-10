<?php
include_once 'conexion.php';
$datos= date_default_timezone_set('America/Argentina/Mendoza');
$fechahoy = date("Y-m-d");
class Listado{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function verlistado(){
        $sql="SELECT concat(matarife.nombre,' ','(',submatarife.nombre,')')as matarifesub,especies.nombre as especie, subespeces.nombre as subespecies, enpie,ingresos.kilosenpie as kilosenpie, corral.nombre as corral, matarife.nombre as matarife,productor.nombre as productor,guia,destino.nombre as destino,destino.codigo as destinocodigo, numtropas, ingresos.kilosenpie/enpie as promedio,CONCAT(faenas.desde,'-', faenas.hasta) as garron, faenas.estado as totalidad,id_ingresos as identificador,faenas.desde as desde,faenas.hasta as hasta,faenas.estado as estado,faenas.seleccionado, ingresos.matarife as id_matarife,especies.id_especies as id_especies,subespeces.codigo as codigo,faenas.id as idfaenas FROM ingresos
        JOIN especies on especie=id_especies_sub
        JOIN subespeces on subespecie=id_subespecies
        JOIN corral on corral=id_corral
        JOIN matarife on matarife=id_matarife
        JOIN productor on productor=id_productor
        JOIN destino on destino=id_destino
        JOIN faenas on id_ingresos=id_ingreso
        JOIN submatarife on matarifesub_item=id_submatarife
        WHERE ingresos.etapa='FAENA' GROUP by ingresos.id_ingresos ORDER BY faenas.desde ASC";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function verlistado_editar(){
        $sql="SELECT id_ingresos as ingresos,numtropas as tropa,enpie,faenas.desde as desde,faenas.hasta as hasta,faenas.id_matarife as matarife FROM `ingresos`
        join faenas on id_ingresos=id_ingreso
        where ingresos.etapa='FAENA'ORDER BY faenas.desde ASC";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscar(){
        $sql="SELECT @ROW := @ROW + 1 as ID,concat(matarife.nombre,' ','(',submatarife.nombre,')')as matarifesub,especies.nombre as especie, subespeces.nombre as subespecies, enpie,ingresos.kilosenpie as kilosenpie, corral.nombre as corral, matarife.nombre as matarife,productor.nombre as productor,guia,destino.nombre as destino,destino.codigo as destinocodigo, numtropas, ingresos.kilosenpie/enpie as promedio,CONCAT(faenas.desde,'-', faenas.hasta) as garron, faenas.estado as totalidad,id_ingresos as identificador,faenas.desde as desde,faenas.hasta as hasta,faenas.estado as estado,faenas.seleccionado, ingresos.matarife as id_matarife,especies.id_especies as id_especies,subespeces.codigo as codigo,ingresos.tci as tci FROM ingresos
        JOIN especies on especie=id_especies_sub
        JOIN subespeces on subespecie=id_subespecies
        JOIN corral on corral=id_corral
        JOIN matarife on matarife=id_matarife
        JOIN productor on productor=id_productor
        JOIN destino on destino=id_destino
        JOIN faenas on id_ingresos=id_ingreso
        JOIN submatarife on matarifesub_item=id_submatarife
        join (SELECT @ROW := 0) t2
        WHERE ingresos.etapa='FAENA' GROUP by ingresos.id_ingresos ORDER BY faenas.desde ASC";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscarpdf($id){
        $sql="SELECT id_ingresos,especies.nombre as especie, subespeces.nombre as subespecies, enpie,ingresos.kilosenpie as kilosenpie, corral.nombre as corral, matarife.nombre as matarife,productor.nombre as productor,guia,destino.nombre as destino,numtropas, ingresos.kilosenpie/enpie as promedio,CONCAT(faenas.desde,'-', faenas.hasta) as garron, faenas.estado as totalidad,id_ingresos as identificador FROM ingresos
        JOIN especies on especie=id_especies_sub
        JOIN subespeces on subespecie=id_subespecies
        JOIN corral on corral=id_corral
        JOIN matarife on matarife=id_matarife
        JOIN productor on productor=id_productor
        JOIN destino on destino=id_destino
        JOIN faenas on numtropas=tropa
        WHERE ingresos.etapa='FAENA' and id_ingresos=:id
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
        function buscarfaenados($id_ingresos){
            $sql="SELECT max(garron) as maximo FROM `faenados` WHERE id_ingreso=:id_ingresos  and estado='PARCIAL'";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id_ingresos'=>$id_ingresos)); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function buscarfaenadostotal($tropa){
            $sql="SELECT @ROW := @ROW + 1 as ID,especies.nombre as especie, subespeces.nombre as subespecies, enpie,ingresos.kilosenpie as kilosenpie, corral.nombre as corral, matarife.nombre as matarife,productor.nombre as productor,guia,destino.nombre as destino,numtropas, ingresos.kilosenpie/enpie as promedio,CONCAT(faenas.desde,'-', faenas.hasta) as garron, faenas.estado as totalidad,id_ingresos as identificador,faenas.desde as desde,faenas.hasta as hasta,faenas.estado as estado,faenas.seleccionado FROM ingresos
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
        function buscarfaenadosparcial($id_ingresos){
            $sql="SELECT cantidad as enpie, hasta, desde  FROM faenas WHERE id_ingreso=:id_ingresos";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id_ingresos'=>$id_ingresos)); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function buscarfaenadosparcial1($id_ingresos){
            $sql="SELECT cantidad as enpie, hasta, desde  FROM faenas WHERE id_ingreso=:id_ingresos";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id_ingresos'=>$id_ingresos)); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function reducir($fecha,$tropa,$clasificacion,$cantidad,$desde,$hasta,$vuelven,$reduccion,$comienzo,$motivo,$estado,$corral){
              $sql="INSERT INTO reducir(fecha,tropa,clasificacion,cantidad,desde,hasta,faenados,comienzo,reduccion,motivo,estado,corral) values (:fecha,:tropa,:clasificacion,:cantidad,:desde,:hasta,:faenados,:comienzo,:reduccion,:motivo,:estado,:corral);";
              $query = $this->acceso->prepare($sql);
              $query->execute(array(':fecha'=>$fecha,':tropa'=>$tropa,':clasificacion'=>$clasificacion,':cantidad'=>$cantidad,':desde'=>$desde,':hasta'=>$hasta,':faenados'=>$vuelven,':comienzo'=>$comienzo,':reduccion'=>$reduccion,':motivo'=>$motivo,':estado'=>$estado,':corral'=>$corral));
              echo 'add';
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
        function procesado($id_ingresos){
            $sql="SELECT id_faenados FROM faenados where id_ingreso=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_ingresos)); 
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'add';
            }
            else{
              
              echo 'noadd';
            }
        }
        function obtener_faena($id,$garron,$tropas){
            $sql="SELECT COUNT(id_faenados) as total FROM `faenados` WHERE salio='NO' and tropa=:tropa and garron=:garron and id_ingreso=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':garron'=>$garron,':tropa'=>$tropas));
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function obtener_faena_faltante($id,$tropas,$garron){
            $sql="SELECT garron FROM `faenados` WHERE salio='NO' and tropa=:tropa and garron=:garron and id_ingreso=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':garron'=>$garron,':tropa'=>$tropas));
            $this->objetos=$query->fetchall();
            return $this->objetos;
    
        }
        function obtener_faena_cantidad($id){
            $sql="SELECT seleccionado as cantidad FROM `faenas` WHERE id_ingreso=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id));
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function obtener_conservacion($id_ingresos){
            $sql="SELECT conservacion FROM `ingresos` WHERE id_ingresos=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_ingresos)); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
    }
        function guardarmatanza($ano,$tropa,$garron,$peso,$especie,$fecha,$productor,$estado,$fechafaena,$fecha1,$id_especies,$fechacsv,$codigo,$destinocsv,$idultimo,$tci,$id_ingresos){    
            $sql="SELECT garron FROM faenados where garron=:garron and id_ingreso=:id_ingreso and tropa=:tropa ";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':garron'=>$garron,':id_ingreso'=>$id_ingresos,':tropa'=>$tropa,)); 
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'noadd';
            }
            else{
            $sql="INSERT INTO faenados(ano,tropa,garron,peso,especie,fecha,productor,estado,fechafaena,fechaetiqueta,numespecie,fechacsv,codigocsv,destinocsv,tci,id_ingreso) values(:ano,:tropa,:garron,:peso,:especie,:fecha,:productor,:estado,:fechafaena,:fechaetiqueta,:numespecie,:fechacsv,:codigocsv,:destinocsv,:tci,:id_ingreso);";
                $query = $this->acceso->prepare($sql); 
                $query->execute(array(':ano'=>$ano,':tropa'=>$tropa,':garron'=>$garron,':peso'=>$peso,':especie'=>$especie,':fecha'=>$fecha,':productor'=>$productor,':estado'=>$estado,':fechafaena'=>$fechafaena,':fechaetiqueta'=>$fecha1,':numespecie'=>$id_especies,':fechacsv'=>$fechacsv,':codigocsv'=>$codigo,':destinocsv'=>$destinocsv,':tci'=>$tci,':id_ingreso'=>$id_ingresos)); 
              echo 'add';
        }
    }
        function buscarmatanza($id_ingresos){
            $sql="SELECT max(garron) as garron FROM faenados where id_ingreso=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_ingresos)); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
    }
    function estadomatanza($id_ingresos,$fecha){
        $sql="UPDATE ingresos SET etapa='FINALIZADO',fechafinalizado=:fechafinalizado where id_ingresos=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_ingresos,':fechafinalizado'=>$fecha)); 
        echo 'reemplazado';
}
function estadomatanzaproceso($ano,$tropa,$matarife,$fecha){
    $sql="INSERT INTO proceso(tropa,matarife,fecha,ano,estado) values (:tropa,:matarife,:fecha,:ano,:estado);";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':tropa'=>$tropa,':matarife'=>$matarife,':fecha'=>$fecha,':ano'=>$ano,':estado'=>'FINALIZADO'));        
    echo 'reemplazado';
}
function matanzaestado($id_ingresos){
    $sql="SELECT  estado FROM faenados where id_ingreso=:id and estado='FINALIZADO'";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id_ingresos)); 
    $this->objetos=$query->fetchall();
    if(!empty($this->objetos)){
        echo 'FINALIZADO';
    }
    else{
      
      echo 'PARCIAL';
    }

}
function camarasdestino($camara,$id_ingresos){
    $sql="UPDATE faenados SET camara=:camara where id_ingreso=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id_ingresos,':camara'=>$camara)); 
    echo 'reemplazado';
}
function camaraproceso($ano,$tropa,$matarife,$fecha,$camara){
    $sql="INSERT INTO proceso(tropa,matarife,fecha,ano,estado) values (:tropa,:matarife,:fecha,:ano,:estado);";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':tropa'=>$tropa,':matarife'=>$matarife,':fecha'=>$fecha,':ano'=>$ano,':estado'=>$camara));        
    echo 'reemplazado';
}
function vercamaraprocesado($id){
    $sql="SELECT id_faenados FROM faenados where id_ingreso=:id and estado='FINALIZADO'";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id)); 
    $this->objetos=$query->fetchall();
    if(!empty($this->objetos)){
        echo 'SI';
    }
    else{
      
      echo 'NO';
    }
}
function buscargarronfaenados($id_ingresos){
    $sql="SELECT id_faenados,tropa,especie,garron,peso,id_ingreso FROM `faenados` WHERE id_ingreso=:id and salio='NO'";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id_ingresos)); 
    $this->objetos=$query->fetchall();
    return $this->objetos;
}
function obtener_codigo($id_especies,$especie){
    $sql="SELECT codigo FROM `subespeces` where id_especie=:especie and categoria=:categoria";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':especie'=>$id_especies,':categoria'=>$especie)); 
    $this->objetos=$query->fetchall();
    return $this->objetos;
}
function obtener_destino($id_ingresos){
    $sql="SELECT destino.codigo as codigocsv FROM `faenados` 
    JOIN ingresos on id_ingreso=id_ingresos
    JOIN destino on ingresos.destino=id_destino
    where id_ingreso=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id_ingresos)); 
    $this->objetos=$query->fetchall();
    return $this->objetos;
}
function editargarronpeso($tropa,$garron,$peso,$peso_editar,$id){
    $sql="UPDATE faenados SET peso=:peso,garron=:garron where id_faenados=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':peso'=>$peso_editar,':id'=>$id,':garron'=>$garron,)); 
}
function buscargarronfaenadostropas(){
    $sql="SELECT id_faenados,faenados.tropa as tropa,especie,garron,peso,productor,faenas.id_matarife as matarife,faenados.fecha as fechafaena,faenas.Dte as dte,observacion_garron FROM `faenados` 
    join faenas on faenados.tropa=faenas.tropa
    WHERE  salio='NO' GROUP BY id_faenados";
    $query = $this->acceso->prepare($sql);
    $query->execute(); 
    $this->objetos=$query->fetchall();
    return $this->objetos;
}
function comparargarron($id){
    $sql="SELECT peso FROM `faenados` WHERE id_faenados=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array('id' => $id)); 
    $this->objetos=$query->fetchall();
    return $this->objetos;
}
function ultimoidfaenados(){
    $sql="SELECT max(id_faenados)+1 as id FROM `faenados` ";
    $query = $this->acceso->prepare($sql);
    $query->execute(); 
    $this->objetos=$query->fetchall();
    return $this->objetos;
}
function subir_foto($id,$nombre_avatar,$observacion_decomiso){
    $sql="INSERT INTO imagen(descripcion,foto,id_decomiso) values (:descripcion,:foto,:id_decomiso);";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':descripcion'=>$observacion_decomiso,':foto'=>$nombre_avatar,':id_decomiso'=>$id)); 
   
}
function editar($id){
    $sql="UPDATE faenados SET observacion_garron=:observacion_garron where id_faenados=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':observacion_garron'=>'SI',':id'=>$id)); 
}

function especie($id_especies){
    $sql="SELECT nombre FROM `especies` WHERE id_especies=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id_especies)); 
    $this->objetos=$query->fetchall();
    return $this->objetos;
}
function despiece($nombre_especie){
    $sql="SELECT codigo FROM `despieces` WHERE espeice=:nombre and despiece= 'Entero/Carcasa'";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre_especie)); 
    $this->objetos=$query->fetchall();
    return $this->objetos;
}
function agregar_despiece($codigo,$id_ingresos,$id_especies){
    $sql="UPDATE faenados SET despiece=:despiece where id_ingreso=:id and numespecie=:numespecie";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':despiece'=>$codigo,':id'=>$id_ingresos,':numespecie'=>$id_especies)); 
}
function conservacion($id_ingresos,$id_especies){
    $sql="SELECT conservacion FROM `ingresos` WHERE id_ingresos=:id and especie=:especie";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id_ingresos,':especie'=>$id_especies)); 
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
function ultimo_id(){
    $sql="SELECT max(id_faenados) as ultimo FROM `faenados`";
    $query = $this->acceso->prepare($sql);
    $query->execute(); 
    $this->objetos=$query->fetchall();
    return $this->objetos;
}

function traer_datos($id_ingresos){
    $sql="SELECT * FROM `ingresos` WHERE id_ingresos=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id_ingresos));
    $this->objetos=$query->fetchall();
    return $this->objetos;

}
function volver($fecha,$ano,$libro,$folio,$destino,$especie,$subespecie,$cantidad,$kilos,$muertos,$caidos,$enpie,
$kilosenpie,$conservacion,$vencimiento,$corral,$corralero,$matarife,$productor,$guia,$fechaguia,$dtamodal,$fechadtamodal,
$llenarprocedencia,$provinciamodal,$localidadmodal,$CPmodal,$llenartransporte,$llenarchofer,$dnimodal,$habilitacionmodal,
$horasdeviajemodal,$lavadomodal,$prescintomodal,$prescintomodalacoplado,$observacionmodal,$kiloscuerosmodal,$numtropas,$cargodatos,
$digestormuertos,$digestorcaidos,$etapa,$matarifesub_item,$tci){
    $sql="INSERT INTO ingresos(ano,fecha,libro,folio,destino,especie,subespecie,cantidad,kilos,muertos,caidos,enpie,kilosenpie,conservacion,vencimiento,corral,corralero,matarife,productor,guia,fechaguia,dtamodal,fechadtamodal,llenarprocedencia,provinciamodal,localidadmodal,CPmodal,llenartransporte,llenarchofer,dnimodal,habilitacionmodal,horasdeviajemodal,lavadomodal,prescintomodal,prescintomodalacoplado,observacionmodal,kiloscuerosmodal,numtropas,cargodatos,digestormuertos,digestorcaidos,etapa,matarifesub_item,tci) values (:ano,:fecha,:libro,:folio,:destino,:especie,:subespecie,:cantidad,:kilos,:muertos,:caidos,:enpie,:kilosenpie,:conservacion,:vencimiento,:corral,:corralero,:matarife,:productor,:guia,:fechaguia,:dtamodal,:fechadtamodal,:llenarprocedencia,:provinciamodal,:localidadmodal,:CPmodal,:llenartransporte,:llenarchofer,:dnimodal,:habilitacionmodal,:horasdeviajemodal,:lavadomodal,:prescintomodal,:prescintomodalacoplado,:observacionmodal,:kiloscuerosmodal,:numtropas,:cargodatos,:digestormuertos,:digestorcaidos,:etapa,:matarifesub_item,:tci);";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':ano'=>$ano,':fecha'=>$fecha,':libro'=>$libro,':folio'=>$folio,':destino'=>$destino,':especie'=>$especie,':subespecie'=>$subespecie,':cantidad'=>$cantidad,':kilos'=>$kilos,':muertos'=>$muertos,':caidos'=>$caidos,':enpie'=>$enpie,':kilosenpie'=>$kilosenpie,':conservacion'=>$conservacion,':vencimiento'=>$vencimiento,':corral'=>$corral,':corralero'=>$corralero,':matarife'=>$matarife,':productor'=>$productor,':guia'=>$guia,':fechaguia'=>$fechaguia,':dtamodal'=>$dtamodal,':fechadtamodal'=>$fechadtamodal,':llenarprocedencia'=>$llenarprocedencia,':provinciamodal'=>$provinciamodal,':localidadmodal'=>$localidadmodal,':CPmodal'=>$CPmodal,':llenartransporte'=>$llenartransporte,':llenarchofer'=>$llenarchofer,':dnimodal'=>$dnimodal,
    ':habilitacionmodal'=>$habilitacionmodal,':horasdeviajemodal'=>$horasdeviajemodal,':lavadomodal'=>$lavadomodal,':prescintomodal'=>$prescintomodal,':prescintomodalacoplado'=>$prescintomodalacoplado,':observacionmodal'=>$observacionmodal,':kiloscuerosmodal'=>$kiloscuerosmodal,':numtropas'=>$numtropas,':cargodatos'=>$cargodatos,':digestormuertos'=>$digestormuertos,':digestorcaidos'=>$digestorcaidos,':etapa'=>$etapa,':matarifesub_item'=>$matarifesub_item,':tci'=>$tci));
}
function finalizar_faena($id_ingresos,$desde){
    $sql="UPDATE faenados SET estado=:estado where id_ingreso=:id and garron=:garron";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id_ingresos,':garron'=>$desde,':estado'=>'FINALIZADO'));
}
function cambiar_ingreso($id_ingresos,$quedan){
    $sql="UPDATE ingresos SET cantidad=:cantidad,enpie=:enpie where id_ingresos=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id_ingresos,':cantidad'=>$quedan,':enpie'=>$quedan));
}
function cambiar_faena($id_ingresos,$quedan,$desde){
    $sql="UPDATE faenas SET cantidad=:cantidad,hasta=:hasta,seleccionado=:seleccionado where id_ingreso=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id_ingresos,':cantidad'=>$quedan,':hasta'=>$desde,':seleccionado'=>$quedan));
}
function promedio($id_ingresos){
    $sql="SELECT kilosenpie/cantidad as promedio FROM `ingresos` WHERE id_ingresos=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id_ingresos));
    $this->objetos=$query->fetchall();
    return $this->objetos;

}
function guardar_promedio($promedio_guardar,$id_ingresos){
    $sql="UPDATE ingresos SET kilos=:kilos,kilosenpie=:kilosenpie where id_ingresos=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id_ingresos,':kilosenpie'=>$promedio_guardar,':kilos'=>$promedio_guardar));
}
function guardar_faena($id,$cantidad,$desde,$hasta){
    $sql="UPDATE faenas SET cantidad=:cantidad,desde=:desde,hasta=:hasta,seleccionado=:seleccionado where id_ingreso=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id,':cantidad'=>$cantidad,':desde'=>$desde,':hasta'=>$hasta,':seleccionado'=>$cantidad));
}
function muertosycaidos($id){
    $sql="SELECT muertos,caidos,cantidad FROM `ingresos`where id_ingresos=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $this->objetos=$query->fetchall();
    return $this->objetos;

}
function guardar_faena_ingresos($id,$total){
    $sql="UPDATE ingresos SET enpie=:enpie,cantidad=:cantidad where id_ingresos=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id,':enpie'=>$total,':cantidad'=>$total));
}
function guardar_faena_ingresos1($id,$total,$total1){
    $sql="UPDATE ingresos SET enpie=:enpie,cantidad=:cantidad where id_ingresos=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id,':enpie'=>$total,':cantidad'=>$total1));
}
function cambiar_faena_total($id_ingresos){
    $sql="UPDATE ingresos SET etapa=:etapa where id_ingresos=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id_ingresos,':etapa'=>'INGRESO'));
}
function eliminar_faena_total($id_ingresos){
    $sql="DELETE FROM faenas where id_ingreso=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id_ingresos));      
}
}
?>