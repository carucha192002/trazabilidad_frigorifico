<?php
include 'conexion.php';
$datos= date_default_timezone_set('America/Argentina/Mendoza');
$fechahoy = date("Y-m-d");
class Reducir{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function buscar_reduccion(){
        $sql="SELECT @ROW := @ROW + 1 as ID,especies.nombre as especie, subespeces.nombre as subespecies, enpie,kilosenpie, corral.nombre as corral, matarife.nombre as matarife,productor.nombre as productor,guia,destino.nombre as destino,destino.codigo as destinocodigo,numtropas,reducir.id_reducir, kilosenpie/enpie as promedio,matarife as id_matarife ,subespeces.codigo as codigo,especies.id_especies_sub as id_especies FROM ingresos
        JOIN especies on especie=id_especies_sub
        JOIN subespeces on subespecie=id_subespecies
        JOIN corral on corral=id_corral
        JOIN matarife on matarife=id_matarife
        JOIN productor on productor=id_productor
        JOIN destino on destino=id_destino
        JOIN reducir on numtropas=tropa
        join (SELECT @ROW := 0) t2
        WHERE ingresos.etapa='REDUCCION' and reducir.etapa='A'
        LIMIT 100";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;

    }
    function buscar_reduccionfaena(){
        $sql="SELECT @ROW := @ROW + 1 as ID,especies.nombre as especie, subespeces.nombre as subespecies, enpie,kilosenpie, corral.nombre as corral, matarife.nombre as matarife,productor.nombre as productor,guia,destino.nombre as destino,destino.codigo as destinocodigo,numtropas,reducir.id_reducir, kilosenpie/enpie as promedio,matarife as id_matarife,reducir.desde as desde,reducir.hasta as hasta,subespeces.codigo as codigo,especies.id_especies_sub as id_especies FROM ingresos
        JOIN especies on especie=id_especies_sub
        JOIN subespeces on subespecie=id_subespecies
        JOIN corral on corral=id_corral
        JOIN matarife on matarife=id_matarife
        JOIN productor on productor=id_productor
        JOIN destino on destino=id_destino
        JOIN reducir on numtropas=tropa
        join (SELECT @ROW := 0) t2
        WHERE ingresos.etapa='FAENA_REDUCCION' and reducir.etapa='I'
        LIMIT 100";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscar_reduccion_existe(){
        $sql="SELECT id_reducir FROM reducir where year(fecha)=year(curdate()) and etapa='A'";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'add';
        }
        else{
          echo 'noadd';
        }
    }
    function buscar_reduccion_existe_vuelta($fecha){
        $sql="SELECT id_ingresos FROM ingresos where ano=:ano and etapa='FAENA_REDUCCION'";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':ano'=>$fecha)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'add';
        }
        else{
          echo 'noadd';
        }
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
    function verificarreduccion($tropas,$fecha){
        $sql="SELECT id_reducir FROM reducir where tropa=:tropa and year(fecha)=year(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':tropa'=>$tropas)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
          echo 'add';
        }
    }
    function verificarreduccionvolver($tropas,$fecha){
        $sql="SELECT id_reducir FROM reducir where tropa=:tropa and year(fecha)=year(curdate()) and etapa='A'";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':tropa'=>$tropas)); 
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
    function reduccionfaena($tropas,$id_reducir){
        $sql="SELECT * FROM reducir  where tropa=:tropa and year(fecha)=year(curdate()) and id_reducir=:id_reducir";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':tropa'=>$tropas,':id_reducir'=>$id_reducir)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function reduccionfaenavolver($tropas,$id_reducir){
        $sql="SELECT * FROM reducir  where tropa=:tropa and year(fecha)=year(curdate()) and id_reducir=:id_reducir";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':tropa'=>$tropas,':id_reducir'=>$id_reducir)); 
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
    function crear($fecha,$tropa,$clasificacion,$cantidad,$desde,$hasta,$estado,$seleccionado,$id_matarife){
        $sql="SELECT id FROM faenas where fecha=:fecha and cantidad=:cantidad and tropa=:tropa and desde=:desde and hasta=:hasta and clasificacion=:clasificacion";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':fecha'=>$fecha,':cantidad'=>$cantidad,':tropa'=>$tropa,':desde'=>$desde,':hasta'=>$hasta,':clasificacion'=>$clasificacion)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
        $sql="INSERT INTO faenas(fecha,cantidad,tropa,desde,hasta,clasificacion,estado,seleccionado,matarife) values (:fecha,:cantidad,:tropa,:desde,:hasta,:clasificacion,:estado,:seleccionado,:id_matarife);";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':fecha'=>$fecha,':cantidad'=>$cantidad,':tropa'=>$tropa,':desde'=>$desde,':hasta'=>$hasta,':clasificacion'=>$clasificacion,':estado'=>$estado,':seleccionado'=>$seleccionado,':id_matarife'=>$id_matarife));
          echo 'add';
        }
    }
    function crearvolver($tropa,$id_matarife){
        $sql="SELECT id FROM faenas WHERE tropa=:tropa and matarife=:id_matarife and year(fecha)=year(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':tropa'=>$tropa,':id_matarife'=>$id_matarife)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            $sql="UPDATE reducir SET etapa='I' WHERE tropa=:tropa and year(fecha)=year(curdate())" ;
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':tropa'=>$tropa));
            $sql="UPDATE ingresos SET etapa=:etapa WHERE matarife=:id_matarife and numtropas=:tropa and ano=year(curdate());";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':tropa'=>$tropa,':id_matarife'=>$id_matarife,':etapa'=>'FAENA_REDUCCION'));
            echo 'add';
        }
        else{
          
          echo 'noadd';
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
            $query->execute(array(':numtropas'=>$tropa,':etapa'=>'FAENA_REDUCCION'));
        echo 'reemplazado';
        }
        function reemplazarestadoreducir($id){
            $sql="UPDATE reducir SET etapa=:etapa where id_reducir=:id_reducir";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id_reducir'=>$id,':etapa'=>'I'));
        echo 'reemplazado';
        }
        function verificarromaneos(){
            $sql="SELECT COUNT(etapa)as cantidad FROM `ingresos` WHERE etapa='FAENA' and ano=year(curdate())";
            $query = $this->acceso->prepare($sql);
            $query->execute(); 
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
        function verificarcorralreduccion(){
            $sql="SELECT corral.nombre as corral,reduccion as cantidad,clasificacion as subespecie FROM reducir 
            JOIN corral on corral=id_corral
            order by corral asc";
            $query = $this->acceso->prepare($sql);
            $query->execute(); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function crearvolverparcial($fecha,$tropa,$clasificacion,$cantidad,$desde,$hasta,$estado,$seleccionado,$id_matarife){
            $sql="SELECT id FROM faenas WHERE tropa=:tropa and matarife=:id_matarife and year(fecha)=year(curdate())";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':tropa'=>$tropa,':id_matarife'=>$id_matarife)); 
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                $sql="INSERT INTO reducir(fecha,tropa,clasificacion,cantidad,desde,hasta,faenados,comienzo,reduccion,motivo,estado,etapa) values (:fecha,:tropa,:clasificacion,:cantidad,:desde,:hasta,:faenados,:comienzo,:reduccion,:motivo,:estado,:etapa);";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':fecha'=>$fecha,':tropa'=>$tropa,':clasificacion'=>$clasificacion,':cantidad'=>$cantidad,':desde'=>$desde,':hasta'=>$hasta,':faenados'=>$seleccionado,':comienzo'=>$hasta,':reduccion'=>$seleccionado,':motivo'=>$estado,':estado'=>$estado,':etapa'=>'A'));
                echo 'add';

            }
            else{
              
              echo 'noadd';
            }
          
        }
        function verificarcorralreducciontropa(){
            $sql="SELECT corral.nombre as corral,reduccion as cantidad,clasificacion as subespecie FROM reducir 
            JOIN corral on corral=id_corral where etapa='A'";
            $query = $this->acceso->prepare($sql);
            $query->execute(); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
}
?>